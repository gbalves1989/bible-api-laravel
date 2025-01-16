<?php

namespace App\Http\Controllers;

use App\Http\Services\LivroService;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LivroService::index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return LivroService::store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return LivroService::show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return LivroService::update($request, $id);
    }

    public function upload(Request $request, string $id)
    {
        return LivroService::upload($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return LivroService::destroy($id);
    }
}
