<?php

namespace App\Http\Controllers;

use App\Http\Services\VersiculoService;
use Illuminate\Http\Request;

class VersiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VersiculoService::index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return VersiculoService::store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return VersiculoService::show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return VersiculoService::update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return VersiculoService::destroy($id);
    }
}
