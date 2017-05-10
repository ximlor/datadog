<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function city(Request $request)
    {
        $repository = app('App\Repositories\Config');
        $district = $repository->district() ?? [];
        return compact('district');
    }
}
