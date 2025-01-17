<?php

namespace App\Http\Services;

use App\Http\Repositories\AuthRepository;
use App\Http\Resources\AuthResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public static function signup(FormRequest $request)
    {
        $validation = $request->validated();

        $user = AuthRepository::store($request);

        $token = $user->createToken($request->name);

        return response()->json([
                'status_code' => 201,
                'error' => false,
                'message' => 'Usuário cadastrado com sucesso.',
                'data' => [
                    'user' => $user,
                    'token' => $token->plainTextToken
                ]
            ], 201,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function signin(FormRequest $request)
    {
        $validation = $request->validated();

        $user = AuthRepository::showByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                    'status_code' => 401,
                    'error' => true,
                    'message' => 'Credenciais inválidas.',
                    'data' => []
                ], 401,
                [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        $token = $user->createToken($user->name);

        return response()->json([
                'status_code' => 201,
                'error' => false,
                'message' => 'Usuário logado com sucesso.',
                'data' => [
                    'user' => $user,
                    'token' => $token->plainTextToken
                ]
            ], 201,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status_code' => 200,
            'error' => true,
            'message' => 'Usuário deslogado com sucesso.',
            'data' => []
        ], 200,
        [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8',
            'Accept' => 'application/json'
        ]);
    }

    public static function me(Request $request)
    {
        $user = $request->user();
        return response()->json([
                'status_code' => 200,
                'error' => false,
                'message' => 'Informações do usuário retornadas com sucesso.',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email
                    ]
                ]
            ], 200,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }
}
