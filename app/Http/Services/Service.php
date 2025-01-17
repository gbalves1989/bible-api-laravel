<?php

namespace App\Http\Services;

use App\Http\Requests\TestamentoRequest;
use App\Http\Requests\VersiculoRequest;

interface Service
{
    public static function store(VersiculoRequest|TestamentoRequest $request);
    public static function index();
    public static function show(string $id);
    public static function update(VersiculoRequest|TestamentoRequest $request, string $id);
    public static function destroy(string $id);
}
