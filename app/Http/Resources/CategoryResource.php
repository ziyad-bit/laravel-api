<?php

namespace App\Http\Resources;

use App\Traits\ResourceMsg;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    use ResourceMsg;

    public static $wrap='category';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'photo'       => $this->photo,
        ];
    }
}
