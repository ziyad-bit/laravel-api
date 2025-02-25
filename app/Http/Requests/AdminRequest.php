<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name'     => 'required|string|min:4|max:20',
            'email'    => ['required','email','min:10','max:50',  Rule::unique('admins')->ignore($this->admin)],
            'password' => $this->method() == 'put'?'nullable':'required'. '|string|min:8|max:50',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name'     => filter_var($this->name       ,FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'email'    => filter_var($this->email      ,FILTER_SANITIZE_EMAIL),
            'password' => filter_var($this->password   ,FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ]);
    }
}
