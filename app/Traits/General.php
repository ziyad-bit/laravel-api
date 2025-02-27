<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait General
{
    public function returnError(string $msg,int $statusCode):JsonResponse
    {
        return response()->json([
            'message' => $msg,
        ], $statusCode);
    }

    public function returnSuccess(string $msg=null,string $key =null,$value=null,int $statusCode = 200):JsonResponse
    {
        $data=[
            'message' => $msg,
            $key => $value,
        ];

        if ($msg === null) {
            unset($data['msg']);
        }

        if ($key === null) {
            unset($data[$key]);
        }

        return response()->json($data, $statusCode);
    }
}
