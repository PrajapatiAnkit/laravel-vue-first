<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|min:1:max:100',
            'email' => "required|email|min:1|max:50|unique:users,email,{$this->userId},id",
            'contact' => 'required|string|min:1|max:10',
            'password' => 'nullable|string|min:6|max:100',
        ];
    }
}
