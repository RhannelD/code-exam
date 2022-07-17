<?php

namespace App\Http\Requests;

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
            'user_id' => '',
            'role_id' => "required|exists:roles,id",
            'full_name' => "required|max:255|unique:users,full_name,{$this->user_id},id",
            'email_address' => "required|max:255|email|unique:users,email_address,{$this->user_id},id",
            'nominated_password' => "required_if:user_id,null|exclude_if:nominated_password,null|min:8",
            'confirmed_password' => "required_if:user_id,null|nullable|required_with:nominated_password|same:nominated_password|exclude",
        ];
    }

    public function attributes()
    {
        return [
            'role_id' => 'role',
            'nominated_password' => 'password',
        ];
    }

    public function messages()
    {
        return [
            'nominated_password.required_if' => 'The password field is required',
            'confirmed_password.required_if' => 'The confirmed password field is required',
        ];
    }
}
