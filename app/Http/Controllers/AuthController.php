<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {
        return AuthService::signup($request);
    }

    public function signin(SigninRequest $request)
    {
        return AuthService::signin($request);
    }

    public function logout(Request $request)
    {
        return AuthService::logout($request);
    }

    public function me(Request $request)
    {
        return AuthService::me($request);
    }
}
