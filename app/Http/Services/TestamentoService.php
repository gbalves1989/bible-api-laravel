<?php

namespace App\Http\Services;

use App\Http\Repositories\LivroRepository;
use App\Http\Repositories\TestamentoRepository;
use App\Http\Resources\TestamentoResource;
use Illuminate\Foundation\Http\FormRequest;

class TestamentoService implements Service
{
    public static function store(FormRequest $request)
    {
        $validation = $request->validated();

        $testamento = TestamentoRepository::store($request);

        return response()->json([
                'status_code' => 201,
                'error' => false,
                'message' => 'Testamento cadastrado com sucesso.',
                'data' => [
                    'testamento' => $testamento,
                    'links' => [
                        [
                            'rel' => 'Informações de um testamento',
                            'type' => 'GET',
                            'link' => route('testamento.show', $testamento->id)
                        ],
                        [
                            'rel' => 'Atualizar um testamento',
                            'type' => 'PUT',
                            'link' => route('testamento.update', $testamento->id)
                        ],
                        [
                            'rel' => 'Remover um testamento',
                            'type' => 'DELETE',
                            'link' => route('testamento.destroy', $testamento->id)
                        ]
                    ]
                ]
            ], 201,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function index()
    {
        $testamentos = TestamentoResource::collection(TestamentoRepository::index());

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
                    'links' => [
                        [
                            'rel' => 'Atualizar um testamento',
                            'type' => 'PUT',
                            'link' => route('testamento.update', $testamento->id)
                        ],
                        [
                            'rel' => 'Remover um testamento',
                            'type' => 'DELETE',
                            'link' => route('testamento.destroy', $testamento->id)
                        ]
                    ]
                ]
            ], 200,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function update(FormRequest $request, string $id)
    {
        $validation = $request->validated();

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
                'data' => [
                    'testamento' => $testamento,
                    'links' => [
                        [
                            'rel' => 'Informações de um testamento',
                            'type' => 'GET',
                            'link' => route('testamento.show', $testamento->id)
                        ],
                        [
                            'rel' => 'Remover um testamento',
                            'type' => 'DELETE',
                            'link' => route('testamento.destroy', $testamento->id)
                        ]
                    ]
                ]
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
                'data' => [
                    'testamento' => $testamento
                ]
            ], 200,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }
}
