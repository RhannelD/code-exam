<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signin(SigninRequest $request)
    {
        if ( Auth::attempt($request->validated()) ) {
            return response()->noContent();
        }
        
        throw ValidationException::withMessages([
            'email_address' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function signout()
    {
        return Auth::logout();
    }
}
