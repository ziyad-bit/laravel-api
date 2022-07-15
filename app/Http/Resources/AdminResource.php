<?php

namespace App\Http\Resources;

use App\Traits\ResourceMsg;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    use ResourceMsg;

    public static $wrap='admin';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $req_method = $request->method();

        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'created_at' => $this->when($req_method === "POST" || $req_method === "GET", $this->created_at),
            'updated_at' => $this->when($req_method === "PUT" , $this->updated_at),
        ];
    }
}
