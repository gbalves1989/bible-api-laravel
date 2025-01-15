<?php

namespace App\Http\Services;

use App\Http\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public static function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ],[
            'name.required' => 'Nome do usuário deve ser informado.',
            'email.email' => 'Informe um e-mail válido.',
            'email.required' => 'E-mail do usuário deve ser informado.',
            'email.unique' => 'E-mail já está cadastrado.',
            'password.required' => 'Senha do usuário deve ser informado.',
            'password.confirmed' => 'Confirmação de senha inválido.',
        ]);

        $user = AuthRepository::store($request);

        $token = $user->createToken($request->name);

        return response()->json([
                'status_code' => 201,
                'error' => false, 
                'message' => 'Usuário cadastrado com sucesso.',
                'token' => $token->plainTextToken,
                'data' => $user
            ], 201, 
            [
                'Content-Type' => 'application/json;charset=UTF-8', 
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function signin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ],[
            'email.email' => 'Informe um e-mail válido.',
            'email.required' => 'E-mail do usuário deve ser informado.',
            'email.exists' => 'E-mail não cadastrado.',
            'password.required' => 'Senha do usuário deve ser informado.',
        ]);

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
                'message' => 'Usuário cadastrado com sucesso.',
                'token' => $token->plainTextToken,
                'data' => $user
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
}