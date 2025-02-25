<?php

namespace App\Http\Resources;

use App\Traits\ResourceMsg;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    use ResourceMsg;
    
    public static $wrap='item';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $req_method=$request->method();

        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'status'      => $this->status === 1 ?'new':'used',
            'price'       => $this->price,
            'admin'       => new AdminResource($this->admin),
            'photo'       => $this->photo,
            'category'    => new CategoryResource($this->category),
            'created_at' => $this->when($req_method === "POST" || $req_method === "GET" , $this->created_at),
            'updated_at' => $this->when($req_method === "PUT" , $this->updated_at),
        ]; 
    }
}
