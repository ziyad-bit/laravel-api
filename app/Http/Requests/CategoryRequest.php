<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'        => ['required','min:4','max:50', $this->method()=="PUT"?Rule::unique('category')->ignore($this->category->id) : Rule::unique('category')],
            'description' => 'required|string|min:4|max:100',
            'photo'       => $this->method()=='POST'?'required':'' . '|image|mimes:jpg,gif,jpeg,png,webp|max:14',
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
