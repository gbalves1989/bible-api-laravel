<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Http\Request;

class AuthRepository
{
    public static function store(Request $request)
    {
        return User::create($request->all());
    }

    public static function showByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}