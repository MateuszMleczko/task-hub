<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use App\Middleware\HostHeaderMiddleware;
use App\Middleware\LocaleMiddleware;
use App\Middleware\RateLimitFlashMiddleware;
use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Event\EventManagerInterface;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\Middleware\RateLimitMiddleware;
use Cake\Http\ServerRequest;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 *
 * @extends \Cake\Http\BaseApplication<\App\Application>
 */
class Application extends BaseApplication implements AuthenticationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        $this->addPlugin('Authentication');

        // By default, does not allow fallback classes.
        FactoryLocator::add('Table', (new TableLocator())->allowFallbackClass(false));
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))

            // Pick the locale before anything else, so even responses produced
            // without a controller come out in the visitor's language.
            ->add(new LocaleMiddleware())

            // Validate Host header to prevent Host Header Injection attacks.
            // In production, ensures App.fullBaseUrl is configured and validates
            // the incoming Host header against it.
            ->add(new HostHeaderMiddleware())

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance.
            // See https://github.com/CakeDC/cakephp-cached-routing
            ->add(new RoutingMiddleware($this))

            // Parse various types of encoded request bodies so that they are
            // available as array through $request->getData()
            // https://book.cakephp.org/5/en/controllers/middleware.html#body-parser-middleware
            ->add(new BodyParserMiddleware())

            // Throttle the two forms worth brute forcing. Placed before the
            // authentication middleware, so a refused attempt never reaches the
            // deliberately slow password hashing.
            ->add(new RateLimitFlashMiddleware())
            ->add($this->ipRateLimit())
            ->add($this->resetEmailRateLimit())

            ->add(new AuthenticationMiddleware($this))

            // Cross Site Request Forgery (CSRF) Protection Middleware
            // https://book.cakephp.org/5/en/security/csrf.html#cross-site-request-forgery-csrf-middleware
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
                'secure' => (bool)Configure::read('httpsOnly'),
            ]));

        return $middlewareQueue;
    }

    /**
     * Per IP throttle for the login and password reset forms.
     *
     * @return \Cake\Http\Middleware\RateLimitMiddleware
     */
    private function ipRateLimit(): RateLimitMiddleware
    {
        return new RateLimitMiddleware([
            'headers' => false,
            'skipCheck' => fn(ServerRequest $request): bool => $this->throttledAction($request) === null,
            'limiterResolver' => fn(ServerRequest $request): ?string => $this->throttledAction($request),
            /*
             * The cache key is a hash of the identifier alone, so the action name has
             * to be part of it - otherwise both forms would share a single counter.
             *
             * REMOTE_ADDR rather than the middleware's own IP lookup, which reads
             * `X-Forwarded-For` straight off the request: anyone can send a fresh
             * value with every attempt and get an empty bucket each time. Behind a
             * proxy, swap this for a header the proxy itself overwrites.
             */
            'identifierCallback' => fn(ServerRequest $request): string => sprintf(
                '%s:%s',
                $this->throttledAction($request),
                $request->getServerParams()['REMOTE_ADDR'] ?? 'unknown',
            ),
            'limiters' => [
                'login' => ['limit' => 10, 'window' => 900],
                'forgotPassword' => ['limit' => 5, 'window' => 3600],
            ],
            'message' => 'Too many attempts. Please try again later.',
        ]);
    }

    /**
     * Throttle on the address typed into the password reset form, so nobody can
     * flood somebody else's inbox by sending the request from many addresses.
     *
     * @return \Cake\Http\Middleware\RateLimitMiddleware
     */
    private function resetEmailRateLimit(): RateLimitMiddleware
    {
        return new RateLimitMiddleware([
            'headers' => false,
            'limit' => 3,
            'window' => 3600,
            'skipCheck' => fn(ServerRequest $request): bool => $this->throttledAction($request) !== 'forgotPassword'
                || !$request->getData('email'),
            'identifierCallback' => fn(ServerRequest $request): string => 'reset-email:'
                . mb_strtolower(trim((string)$request->getData('email'))),
            'message' => 'Too many attempts. Please try again later.',
        ]);
    }

    /**
     * Name of the throttled action this request targets, or null when it targets
     * neither of them.
     *
     * @param \Cake\Http\ServerRequest $request The request.
     * @return string|null
     */
    private function throttledAction(ServerRequest $request): ?string
    {
        if ($request->getMethod() !== 'POST') {
            return null;
        }

        $params = $request->getAttribute('params', []);
        if (($params['controller'] ?? null) !== 'Users') {
            return null;
        }

        $action = $params['action'] ?? null;

        return in_array($action, ['login', 'forgotPassword'], true) ? $action : null;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/5/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
        // Allow your Tables to be dependency injected
        //$container->delegate(new \Cake\ORM\Locator\TableContainer());
    }

    /**
     * Register custom event listeners here
     *
     * @param \Cake\Event\EventManagerInterface $eventManager
     * @return \Cake\Event\EventManagerInterface
     * @link https://book.cakephp.org/5/en/core-libraries/events.html#registering-listeners
     */
    public function events(EventManagerInterface $eventManager): EventManagerInterface
    {
        // $eventManager->on(new SomeCustomListenerClass());

        return $eventManager;
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $fields = [
            'username' => 'email',
            'password' => 'password',
        ];

        $service = new AuthenticationService([
            'unauthenticatedRedirect' => '/users/login',
            'queryParam' => 'redirect',
            'authenticators' => [
                'Authentication.Session',
                'Authentication.Form' => [
                    'fields' => $fields,
                    'loginUrl' => '/users/login',
                    'identifier' => [
                        'className' => 'Authentication.Password',
                        'fields' => $fields,
                    ],
                ],
            ],
        ]);

        return $service;
    }
}
