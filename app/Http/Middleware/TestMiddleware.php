<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $role): Response
    {
        if ($role == "alissar") {
            return $next($request);
        } else {
            return response()->json([
                'message' => "error",
                "data" => []
            ]);
        }
    }

    public function terminate(Request $request, Response $response){
        Log::info("from teminate",[
            'request_url' => $request->getBaseUrl()
        ]);
    }
}
