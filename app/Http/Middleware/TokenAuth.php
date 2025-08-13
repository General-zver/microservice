<?php

namespace App\Http\Middleware;

use App\Services\AuthTokensService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuth
{

    public function handle(Request $request, Closure $next): Response
    {
        $authTokensService = app()->make(AuthTokensService::class);
        $token = str_replace('Bearer ', '', $request->header('Authorization'));


        if ($authTokensService->checkToken($token)) {
            return $next($request);
        }

        return response()->json([
            'error' => 'Access to this resource is denied.',
        ], 403);
    }
}
