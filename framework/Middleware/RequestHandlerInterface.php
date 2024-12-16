<?php
namespace Framework\Http\Middleware;

use Framework\Http\Request;
use Framework\Http\Response;

    interface RequestHandlerInterface
{
    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     */
    public function handle(Request $request): Response;


}