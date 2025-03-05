<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonResponseApiMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Get the response after the request has been processed
        $response = $next($request);

        // If the response is not a JSON response, convert it to JSON
        if (! $response instanceof \Illuminate\Http\JsonResponse) {
            return response()->json([
                'message' => $response->getContent(),
            ], $response->status());
        }

        return $response;
    }
}
