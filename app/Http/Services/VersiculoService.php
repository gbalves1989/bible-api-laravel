<?php

namespace App\Http\Services;

use App\Http\Repositories\LivroRepository;
use App\Http\Repositories\VersiculoRepository;
use App\Http\Resources\VersiculoResource;
use Illuminate\Foundation\Http\FormRequest;

class VersiculoService implements Service
{
    public static function store(FormRequest $request)
    {
        $validation = $request->validated();

        $livro = LivroRepository::show($request['livro_id']);

        if (!$livro) {
            return response()->json([
                    'status_code' => 404,
                    'error' => true,
                    'message' => 'Livro não foi encontrado.',
                    'data' => []
                ], 404,
                [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        $versiculo = VersiculoRepository::store($request);

        return response()->json([
                'status_code' => 201,
                'error' => false,
                'message' => 'Versiculo cadastrado com sucesso.',
                'data' => [
                    'versiculo' => $versiculo,
                    'links' => [
                        [
                            'rel' => 'Informações de um versículo',
                            'type' => 'GET',
                            'link' => route('versiculo.show', $versiculo->id)
                        ],
                        [
                            'rel' => 'Atualizar um versículo',
                            'type' => 'PUT',
                            'link' => route('versiculo.update', $versiculo->id)
                        ],
                        [
                            'rel' => 'Remover um versículo',
                            'type' => 'DELETE',
                            'link' => route('versiculo.destroy', $versiculo->id)
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
        $versiculos = VersiculoResource::collection(VersiculoRepository::index());

        return response()->json([
            'status_code' => 200,
            'error' => false,
            'message' => 'Lista de versiculos retornado com sucesso.',
            'data' => $versiculos
        ], 200,
        [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8',
            'Accept' => 'application/json'
        ]);
    }

    public static function show(string $id)
    {
        $versiculo = VersiculoRepository::show($id);

        if (!$versiculo) {
            return response()->json([
                    'status_code' => 404,
                    'error' => true,
                    'message' => 'Versiculo não foi encontrado.',
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
                'message' => 'Versiculo encontrado com sucesso.',
                'data' => [
                    'versiculo' => $versiculo,
                    'links' => [
                        [
                            'rel' => 'Atualizar um versículo',
                            'type' => 'PUT',
                            'link' => route('versiculo.update', $versiculo->id)
                        ],
                        [
                            'rel' => 'Remover um versículo',
                            'type' => 'DELETE',
                            'link' => route('versiculo.destroy', $versiculo->id)
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

        $versiculo = VersiculoRepository::show($id);

        if (!$versiculo) {
            return response()->json([
                    'status_code' => 404,
                    'error' => true,
                    'message' => 'Versiculo não foi encontrado.',
                    'data' => []
                ], 404,
                [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        $livro = LivroRepository::show($request['livro_id']);

        if (!$livro) {
            return response()->json([
                    'status_code' => 404,
                    'error' => true,
                    'message' => 'Livro não foi encontrado.',
                    'data' => []
                ], 404,
                [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        $versiculo = VersiculoRepository::update($request, $versiculo);

        return response()->json([
                'status_code' => 202,
                'error' => false,
                'message' => 'Versiculo atualizado com sucesso.',
                'data' => [
                    'versiculo' => $versiculo,
                    'links' => [
                        [
                            'rel' => 'Informações de um versículo',
                            'type' => 'GET',
                            'link' => route('versiculo.show', $versiculo->id)
                        ],
                        [
                            'rel' => 'Remover um versículo',
                            'type' => 'DELETE',
                            'link' => route('versiculo.destroy', $versiculo->id)
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
        $versiculo = VersiculoRepository::show($id);

        if (!$versiculo) {
            return response()->json([
                    'status_code' => 404,
                    'error' => true,
                    'message' => 'Versiculo não foi encontrado.',
                    'data' => []
                ], 404,
                [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        VersiculoRepository::destroy($id);

        return response()->json([
                'status_code' => 204,
                'error' => false,
                'message' => 'Versiculo excluído com sucesso.',
                'data' => [
                    'versiculo' => $versiculo
                ]
            ], 200,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }
}
