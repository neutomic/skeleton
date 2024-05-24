<?php

declare(strict_types=1);

namespace App\Middleware;

use Neu\Component\Http\Message\RequestInterface;
use Neu\Component\Http\Message\ResponseInterface;
use Neu\Component\Http\Runtime\Context;
use Neu\Component\Http\Runtime\Handler\HandlerInterface;
use Neu\Component\Http\Runtime\Middleware\MiddlewareInterface;

/**
 * An example middleware that adds a header to the response.
 */
final readonly class ExampleMiddleware implements MiddlewareInterface
{
    /**
     * Process the incoming request.
     */
    public function process(Context $context, RequestInterface $request, HandlerInterface $next): ResponseInterface
    {
        $response = $next->handle($context, $request);

        return $response->withHeader('X-Example-Middleware', 'Hello, World!');
    }
}
