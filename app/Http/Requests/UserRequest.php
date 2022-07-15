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
            'full_name' => "required|max:255|unique:users,full_name,{$this->user_id},id",
            'email_address' => "required|max:255|email|unique:users,email_address,{$this->user_id},id",
            'nominated_password' => "required|max:8",
            'confirmed_password' => "required|max:8|same:nominated_password",
        ];
    }
}
