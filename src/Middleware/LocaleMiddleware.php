<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\I18n\I18n;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Selects the active I18n locale from the browser's Accept-Language header.
 *
 * Polish (`pl`) browsers get `pl_PL`, everything else falls back to `en_US`.
 *
 * Lives in the middleware queue rather than in a controller callback, so that
 * responses produced before a controller ever runs - an error page, or the
 * redirect from RateLimitFlashMiddleware - are translated as well.
 */
class LocaleMiddleware implements MiddlewareInterface
{
    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $acceptLanguage = $request->getHeaderLine('Accept-Language');
        I18n::setLocale(str_starts_with(strtolower($acceptLanguage), 'pl') ? 'pl_PL' : 'en_US');

        return $handler->handle($request);
    }
}
