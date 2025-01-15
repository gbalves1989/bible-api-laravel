<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        return AuthService::signup($request);
    }

    public function signin(Request $request)
    {
        return AuthService::signin($request);
    }

    public function logout(Request $request)
    {
        return AuthService::logout($request);
    }
}
