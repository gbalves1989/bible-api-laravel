<?php

namespace App\Http\Services;

use App\Http\Repositories\LivroRepository;
use App\Http\Repositories\TestamentoRepository;
use App\Http\Repositories\VersiculoRepository;
use App\Http\Resources\LivroResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class LivroService implements Service
{
    public static function store(FormRequest $request)
    {
        $validation = $request->validated();

        $testamento = TestamentoRepository::show($request['testamento_id']);

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

        $livro = LivroRepository::store($request);

        return response()->json([
                'status_code' => 201,
                'error' => false,
                'message' => 'Livro cadastrado com sucesso.',
                'data' => [
                    'livro' => $livro,
                    'links' => [
                        [
                            'rel' => 'Informações de um livro',
                            'type' => 'GET',
                            'link' => route('livro.show', $livro->id)
                        ],
                        [
                            'rel' => 'Atualizar um livro',
                            'type' => 'PUT',
                            'link' => route('livro.update', $livro->id)
                        ],
                        [
                            'rel' => 'Atualizar a capa de um livro',
                            'type' => 'PATCH',
                            'link' => route('livro.upload', $livro->id)
                        ],
                        [
                            'rel' => 'Remover um testamento',
                            'type' => 'DELETE',
                            'link' => route('livro.destroy', $livro->id)
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
        $livros = LivroResource::collection(LivroRepository::index());

        return response()->json([
            'status_code' => 200,
            'error' => false,
            'message' => 'Lista de livros retornado com sucesso.',
            'data' => $livros
        ], 200,
        [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8',
            'Accept' => 'application/json'
        ]);
    }

    public static function show(string $id)
    {
        $livro = LivroRepository::show($id);

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

        return response()->json([
                'status_code' => 200,
                'error' => false,
                'message' => 'Livro encontrado com sucesso.',
                'data' => [
                    'livro' => $livro,
                    'links' => [
                        [
                            'rel' => 'Atualizar um livro',
                            'type' => 'PUT',
                            'link' => route('livro.update', $livro->id)
                        ],
                        [
                            'rel' => 'Atualizar a capa de um livro',
                            'type' => 'PATCH',
                            'link' => route('livro.upload', $livro->id)
                        ],
                        [
                            'rel' => 'Remover um livro',
                            'type' => 'DELETE',
                            'link' => route('livro.destroy', $livro->id)
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

        $livro = LivroRepository::show($id);

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

        $testamento = TestamentoRepository::show($request['testamento_id']);

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

        $livro = LivroRepository::update($request, $livro);

        return response()->json([
                'status_code' => 202,
                'error' => false,
                'message' => 'Livro atualizado com sucesso.',
                'data' => [
                    'livro' => $livro,
                    'links' => [
                        [
                            'rel' => 'Informações de um livro',
                            'type' => 'GET',
                            'link' => route('livro.show', $livro->id)
                        ],
                        [
                            'rel' => 'Atualizar a capa de um livro',
                            'type' => 'PATCH',
                            'link' => route('livro.upload', $livro->id)
                        ],
                        [
                            'rel' => 'Remover um livro',
                            'type' => 'DELETE',
                            'link' => route('livro.destroy', $livro->id)
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

    public static function upload(FormRequest $request, string $id)
    {
        $validation = $request->validated();

        $livro = LivroRepository::show($id);

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

        if ($livro->capa != '' || $livro->capa != null) {
            Storage::disk('public')->delete($livro->capa);
        }

        $path = $request->capa->store('capa_livro', 'public');

        $livro = LivroRepository::upload($path, $livro);

        return response()->json([
                'status_code' => 202,
                'error' => false,
                'message' => 'Capa atualizada com sucesso.',
                'data' => [
                    'livro' => $livro,
                    'links' => [
                        [
                            'rel' => 'Informações de um livro',
                            'type' => 'GET',
                            'link' => route('livro.show', $livro->id)
                        ],
                        [
                            'rel' => 'Atualizar um livro',
                            'type' => 'PUT',
                            'link' => route('livro.update', $livro->id)
                        ],
                        [
                            'rel' => 'Remover um livro',
                            'type' => 'DELETE',
                            'link' => route('livro.destroy', $livro->id)
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
        $livro = LivroRepository::show($id);

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

        $versiculos = VersiculoRepository::showByLivro($id);

        if ($versiculos) {
            return response()->json([
                    'status_code' => 400,
                    'error' => true,
                    'message' => 'Livro possui versiculos cadastrados.',
                    'data' => []
                ], 400,
                [
                    'Content-Type' => 'application/json;charset=UTF-8',
                    'Charset' => 'utf-8',
                    'Accept' => 'application/json'
                ]);
        }

        if ($livro->capa != '' || $livro->capa != null) {
            Storage::disk('public')->delete($livro->capa);
        }

        LivroRepository::destroy($id);

        return response()->json([
                'status_code' => 204,
                'error' => false,
                'message' => 'Livro excluído com sucesso.',
                'data' => [
                    'livro' => $livro
                ]
            ], 200,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }
}
