<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Response;

class CommonController extends Controller
{
    /*
     * This function clears the cache and other things
     */
    public function cacheClear()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');
        return Response::json(['message' => 'Cache cleared !']);
    }

}
