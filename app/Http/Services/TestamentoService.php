<?php

namespace App\Http\Services;

use App\Http\Repositories\LivroRepository;
use App\Http\Repositories\TestamentoRepository;
use Illuminate\Http\Request;

class TestamentoService implements Service
{
    public static function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|unique:testamentos|max:255',
        ],[
            'nome.required' => 'Nome do testamento deve ser informado.',
            'nome.unique' => 'Nome do testamento já está cadastrado.'
        ]);

        $testamento = TestamentoRepository::store($request);

        return response()->json([
                'status_code' => 201,
                'error' => false, 
                'message' => 'Testamento cadastrado com sucesso.',
                'data' => $testamento
            ], 201, 
            [
                'Content-Type' => 'application/json;charset=UTF-8', 
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function index()
    {
        $testamentos = TestamentoRepository::index();

        return response()->json([
                'status_code' => 200,
                'error' => false, 
                'message' => 'Lista de testamentos retornado com sucesso.',
                'data' => $testamentos
            ], 200, 
            [
                'Content-Type' => 'application/json;charset=UTF-8', 
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function show(string $id)
    {
        $testamento = TestamentoRepository::show($id);

        if (!$testamento) {
            return response()->json([
                    'status_code' => 404,
                    'error' => true, 
                    'message' => 'Testamento não foi encontrado.',
                    'data' => []
                ], 404, 
                [
                    'Content-Type' => 'application/json;charset=UTF-8', 
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        return response()->json([
                'status_code' => 200,
                'error' => false, 
                'message' => 'Testamento encontrado com sucesso.',
                'data' => [
                    'testamento' => $testamento,
                    'livros' => $testamento->livros
                ]
            ], 200, 
            [
                'Content-Type' => 'application/json;charset=UTF-8', 
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nome' => 'required|unique:testamentos|max:255',
        ],[
            'nome.required' => 'Nome do testamento deve ser informado.',
            'nome.unique' => 'Nome do testamento já está cadastrado.'
        ]);
        
        $testamento = TestamentoRepository::show($id);

        if (!$testamento) {
            return response()->json([
                    'status_code' => 404,
                    'error' => true, 
                    'message' => 'Testamento não foi encontrado.',
                    'data' => []
                ], 404, 
                [
                    'Content-Type' => 'application/json;charset=UTF-8', 
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        $testamento = TestamentoRepository::update($request, $testamento);

        return response()->json([
                'status_code' => 202,
                'error' => false, 
                'message' => 'Testamento atualizado com sucesso.',
                'data' => $testamento
            ], 202, 
            [
                'Content-Type' => 'application/json;charset=UTF-8', 
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function destroy(string $id)
    {
        $testamento = TestamentoRepository::show($id);

        if (!$testamento) {
            return response()->json([
                    'status_code' => 404,
                    'error' => true, 
                    'message' => 'Testamento não foi encontrado.',
                    'data' => []
                ], 404, 
                [
                    'Content-Type' => 'application/json;charset=UTF-8', 
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        $livros = LivroRepository::showByTestamento($id);

        if ($livros) {
            return response()->json([
                    'status_code' => 400,
                    'error' => true, 
                    'message' => 'Testamento possui livros cadastrados.',
                    'data' => []
                ], 400, 
                [
                    'Content-Type' => 'application/json;charset=UTF-8', 
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        TestamentoRepository::destroy($id);

        return response()->json([
                'status_code' => 204,
                'error' => false, 
                'message' => 'Testamento excluído com sucesso.',
                'data' => $testamento
            ], 200, 
            [
                'Content-Type' => 'application/json;charset=UTF-8', 
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }
}