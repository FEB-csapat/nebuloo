<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "username" => "required|string|min:4|max:25|unique:users|alpha_num",
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-ZÁÉŐÚÜŰÓÖÜÍ])(?=.*?[a-zóöüúőáéí])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'notify_by_email' => 'boolean'
        ];
    }
}
