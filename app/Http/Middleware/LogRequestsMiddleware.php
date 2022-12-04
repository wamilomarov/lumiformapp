<?php

namespace App\Http\Middleware;

use App\Services\RequestLogService;
use Closure;
use Illuminate\Http\Request;

class LogRequestsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var RequestLogService $service */
        $service = app(RequestLogService::class);
        $service->store($request);

        return $next($request);
    }
}
