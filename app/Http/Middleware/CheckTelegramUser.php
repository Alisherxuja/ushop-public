<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTelegramUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $password = env('APP_DEBUG') ? 'access_123456' : env('TELEGRAM_ACCESS', 'access_123456');
        app()->setLocale($request->header('language', 'ru'));
        if (get_tmAuth() != $password) {
            return error_out([], 422, 'Tm auth not found or wrong');
        }
        return $next($request);
    }
}
