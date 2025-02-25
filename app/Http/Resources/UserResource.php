<?php

namespace App\Http\Resources;

use App\Traits\ResourceMsg;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use ResourceMsg;

    public static $wrap='user';
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
            'photo'      => $this->when($this->photo !== null , $this->photo),
            'created_at' => $this->when($req_method === "POST" || $req_method === "GET" , $this->created_at),
            'updated_at' => $this->when($req_method === "PUT" || $req_method === "GET", $this->updated_at),
        ];
    }
}
