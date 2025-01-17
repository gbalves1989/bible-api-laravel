<?php

namespace App\Http\Repositories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LivroRepository implements Repository
{
    public static function store(Request $request)
    {
        return Livro::create($request->all());
    }

    public static function index()
    {
        return Livro::with(['testamento', 'versiculos'])->get();
    }

    public static function show(string $id)
    {
        return Livro::where('id', '=', $id)
            ->with(['testamento', 'versiculos'])
            ->get();
    }

    public static function showByTestamento(string $id)
    {
        return Livro::where('testamento_id', '=', $id)->first();
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
