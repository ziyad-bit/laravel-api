<?php

namespace App\Traits;

trait ResourceMsg
{
    public function with($request)
    {
        $req_method = $request->method();

        $data = [];

        if ($req_method !== "GET") {
            $data['message']=$req_method === "POST" ? 'you successfully created record' : 'you successfully updated the record';
        }

        return $data;
    }
}
