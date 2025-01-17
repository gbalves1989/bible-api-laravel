<?php

namespace App\Http\Services;

use App\Http\Repositories\LivroRepository;
use App\Http\Repositories\TestamentoRepository;
use App\Http\Repositories\VersiculoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivroService implements Service
{
    public static function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|max:255',
            'posicao' => 'required',
            'abreviacao' => 'required',
            'testamento_id' => 'required'
        ],[
            'nome.required' => 'Nome do livro deve ser informado.',
            'posicao.required' => 'Posição do livro deve ser informado.',
            'abreviacao.required' => 'Abreviação do livro deve ser informado.',
            'testamento_id.required' => 'Testamento do livro deve ser informado.'
        ]);

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
        $livro = LivroRepository::show($livro->id);

        return response()->json([
                'status_code' => 201,
                'error' => false,
                'message' => 'Livro cadastrado com sucesso.',
                'data' => $livro
            ], 201,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function index()
    {
        $livros = LivroRepository::index();

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
                'data' => $livro
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
            'nome' => 'required|max:255',
            'posicao' => 'required',
            'abreviacao' => 'required',
            'testamento_id' => 'required'
        ],[
            'nome.required' => 'Nome do livro deve ser informado.',
            'posicao.required' => 'Posição do livro deve ser informado.',
            'abreviacao.required' => 'Abreviação do livro deve ser informado.',
            'testamento_id.required' => 'Testamento do livro deve ser informado.'
        ]);

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

        $livro = LivroRepository::update($request, $id);
        $livro = LivroRepository::show($livro->id);

        return response()->json([
                'status_code' => 202,
                'error' => false,
                'message' => 'Livro atualizado com sucesso.',
                'data' => $livro
            ], 202,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }

    public static function upload(Request $request, string $id)
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

        if ($livro->capa != '' || $livro->capa != null) {
            Storage::disk('public')->delete($livro->capa);
        }

        $path = $request->capa->store('capa_livro', 'public');

        $livro = LivroRepository::upload($path, $livro);

        return response()->json([
                'status_code' => 202,
                'error' => false,
                'message' => 'Capa atualizada com sucesso.',
                'data' => $livro
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
                'data' => $livro
            ], 200,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }
}
