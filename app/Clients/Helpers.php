<?php


namespace App\Clients;


class Helpers
{
    public static function randomString(int $length = 16): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $text = '';
        for ($i = 0; $i < $length; $i++) {
            $text .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $text;
    }

    public static function code($key): int
    {
        $code = env('APP_DEBUG') ? 123456 : mt_rand(100000, 999999);
        \Cache::forget($key);
        \Cache::add($key, $code, 3600);
        return $code;
    }


}
