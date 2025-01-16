<?php

namespace App\Http\Repositories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LivroRepository implements Repository
{
    public static function store(Request $request)
    {
        return Livro::create($request->all());
    }

    public static function index()
    {
        return Livro::all();
    }

    public static function show(string $id)
    {
        return Livro::find($id);
    }

    public static function showByTestamento(string $id)
    {
        return Livro::where('testamento_id', '=', $id);
    }

    public static function update(Request $request, Model $model)
    {
        $model->update($request->all());

        return $model;
    }

    public static function upload(string $path, Model $model)
    {
        $model->update(['capa' => $path]);

        return $model;
    }

    public static function destroy(string $id)
    {
        Livro::destroy($id);
    }
}