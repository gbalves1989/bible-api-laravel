<?php

namespace App\Http\Repositories;

use App\Models\Testamento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TestamentoRepository implements Repository
{
    public static function store(Request $request)
    {
        return Testamento::create($request->all());
    }

    public static function index()
    {
        return Testamento::all();
    }

    public static function show(string $id)
    {
        return Testamento::find($id);
    }

    public static function update(Request $request, Model $model)
    {
        $model->update($request->all());

        return $model;
    }

    public static function destroy(string $id)
    {
        Testamento::destroy($id);
    }
}