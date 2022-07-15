<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'user_id' => "required|exists:users,id|unique:roles,user_id,{$this->role_id},id",
            'role_name' => "required|max:255",
            'role_description' => "required|max:255",
        ];
    }

    public function attributes()
    {
        return [
            'user_id' => 'user'
        ];
    }
}
