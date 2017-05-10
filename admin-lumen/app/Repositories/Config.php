<?php

namespace App\Repositories;

class Config
{
    public function district()
    {
        $curl = app('curl');
        $result = $curl->to('http://restapi.amap.com/v3/config/district')
            ->withData([
                'key' => config('amap.key_web'),
            ])
            ->get();

        return json_decode($result, true);
    }
}