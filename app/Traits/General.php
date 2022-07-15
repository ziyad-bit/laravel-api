<?php

namespace App\Traits;

trait General
{
    public function returnError($msg, $statusCode)
    {
        return response()->json([
            'msg' => $msg,
        ], $statusCode);
    }

    public function returnSuccess($msg=null, $key = null, $value = null, $statusCode = 200)
    {
        $data=[
            'msg' => $msg,
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
