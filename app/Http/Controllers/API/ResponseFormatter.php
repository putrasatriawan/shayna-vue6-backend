<?php

namespace App\Http\Controllers\API;

use Symfony\Component\VarDumper\Cloner\Data;

class  ResponseFormatter
{
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null
        ],

        'data' => null
    ];

    //fungsi data sucess 

    public static function success($data = null, $message = null)
    {
        //menyimpan variable $response $meta $massage ke protected static 
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;


        //return ke jeson
        return response()->json(self::$response, self::$response['meta']['code']);
    }

    //fungsi data error 
    //jika error akan output nya 400 $code = 400
    public static function error($data = null, $message = null, $code = 400)
    {
        //menyimpan variable $response $meta $massage ke protected static 
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;



        //return ke jeson
        return response()->json(self::$response, self::$response['meta']['code']);
    }
}