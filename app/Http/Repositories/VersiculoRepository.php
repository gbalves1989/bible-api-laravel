<?php

namespace App\Http\Repositories;

use App\Models\Versiculo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class VersiculoRepository implements Repository
{
    public static function store(FormRequest $request)
    {
        return Versiculo::create($request->all());
    }

    public static function index()
    {
        return Versiculo::with('livro')->get();
    }

    public static function show(string $id)
    {
        return Versiculo::where('id', '=', $id)
            ->with('livro')
            ->first();
    }

    public static function showByLivro(string $id)
    {
        return Versiculo::where('livro_id', '=', $id)
            ->with('livro')
            ->first();
    }

    public static function update(Request $request, Model $model)
    {
        $model->update($request->all());

        return $model;
    }

    public static function destroy(string $id)
    {
        Versiculo::destroy($id);
    }
}
