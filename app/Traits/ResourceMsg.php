<?php

namespace App\Traits;

trait ResourceMsg
{
    public function with($request)
    {
        $req_method = $request->method();

        $data = [
            'message' => $req_method === "POST" ? 'you successfully created it' : 'you successfully updated it',
        ];

        if ($req_method === "GET") {
            unset($data['message']);
        }

        return $data;
    }
}
