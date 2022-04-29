<?php


namespace App\Http\Middleware;

use Closure;

class Paycom
{
    public function handle($request, Closure $next): \Illuminate\Http\Response
    {
        $authorization = $request->header('Authorization');
        try {
            $auth = explode(" ", $authorization)[1];
            $self_auth = base64_encode(config('paycom.login') . ':' . config('paycom.secret_key'));
            if ($self_auth === $auth)
                return $next($request);
        } catch (\Exception $e) {
        }
        return paycom_error();
    }
}
