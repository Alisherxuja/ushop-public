<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        if (!\Cache::has('uuid')) {
            \Cache::set('uuid', \Str::uuid());
        }
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
