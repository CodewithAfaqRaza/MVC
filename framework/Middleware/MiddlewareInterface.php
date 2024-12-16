<?php

namespace  Framework\Http\Middleware;

use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Http\Middleware\RequestHandler;

interface MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(Request $request, RequestHandler $handler): Response;
}