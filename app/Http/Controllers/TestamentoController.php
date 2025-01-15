<?php

namespace App\Http\Controllers;

use App\Http\Services\TestamentoService;
use Illuminate\Http\Request;

class TestamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TestamentoService::index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return TestamentoService::store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return TestamentoService::show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return TestamentoService::update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return TestamentoService::destroy($id);
    }
}
