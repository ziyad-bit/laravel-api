<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|min:4|max:40',
            'description' => 'required|string|min:4|max:250',
            'photo'       => $this->method()==='POST' ? 'required':'' . '|image|mimes:jpg,gif,jpeg,png,webp|max:14',
            'price'       => 'required|numeric',
            'status'      => 'required|numeric',
            'category_id' => 'required|numeric',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name'        => filter_var($this->name       ,FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'description' => filter_var($this->description,FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        ]);
    }
}
