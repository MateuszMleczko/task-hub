<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\Http\Exception\TooManyRequestsException;
use Cake\Http\FlashMessage;
use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Turns a throttled request into the form it came from, with a flash message.
 *
 * Without this the rate limiters hand the visitor a bare error page, which tells
 * somebody who simply mistyped their password nothing about what to do next.
 * Wrapped around the limiters, so it sees the exception they throw.
 */
class RateLimitFlashMiddleware implements MiddlewareInterface
{
    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (TooManyRequestsException $exception) {
            (new FlashMessage($request->getAttribute('session')))->error(
                __('Too many attempts. Please try again in {0} min.', $this->minutesToWait($exception)),
            );

            return (new Response())
                ->withStatus(302)
                ->withLocation($request->getUri()->getPath());
        }
    }

    /**
     * Whole minutes left of the lockout, read from the `Retry-After` header the
     * rate limiter puts on the exception. Never less than one, so the message
     * never tells somebody to come back in zero minutes.
     *
     * @param \Cake\Http\Exception\TooManyRequestsException $exception The caught exception.
     * @return int
     */
    private function minutesToWait(TooManyRequestsException $exception): int
    {
        $retryAfter = (int)($exception->getHeaders()['Retry-After'] ?? 0);

        return max(1, (int)ceil($retryAfter / 60));
    }
}
