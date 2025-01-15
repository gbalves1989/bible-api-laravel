<?php

namespace App\Http\Services;

use App\Http\Repositories\LivroRepository;
use App\Http\Repositories\VersiculoRepository;
use Illuminate\Http\Request;

class VersiculoService implements Service
{
    public static function store(Request $request)
    {
        $validated = $request->validate([
            'capitulo' => 'required',
            'versiculo' => 'required',
            'texto' => 'required',
            'livro_id' => 'required'
        ],[
            'capitulo.required' => 'Capítulo do versiculo deve ser informado.',
            'versiculo.required' => 'Versículo do versiculo deve ser informado.',
            'texto.required' => 'Texto do versiculo deve ser informado.',
            'livro_id.required' => 'Livro do versiculo deve ser informado.'
        ]);

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
        $versiculos = VersiculoRepository::index();

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
                'data' => $versiculo
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
            'capitulo' => 'required',
            'versiculo' => 'required',
            'texto' => 'required',
            'livro_id' => 'required'
        ],[
            'capitulo.required' => 'Capítulo do versiculo deve ser informado.',
            'versiculo.required' => 'Versículo do versiculo deve ser informado.',
            'texto.required' => 'Texto do versiculo deve ser informado.',
            'livro_id.required' => 'Livro do versiculo deve ser informado.'
        ]);
        
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
                'data' => $versiculo
            ], 200, 
            [
                'Content-Type' => 'application/json;charset=UTF-8', 
                'Charset' => 'utf-8',
                'Accept' => 'application/json'
            ]);
    }
}