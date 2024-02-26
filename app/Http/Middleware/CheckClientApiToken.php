<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckClientApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = config('api_tokens.token');

        if ($request->header('Api-Token') !== $token) {
            return \response()->json([
                'message' => 'Forbidden!'
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
