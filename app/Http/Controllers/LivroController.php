<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Http\Requests\LivroUploadRequest;
use App\Http\Services\LivroService;

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
    public function store(LivroRequest $request)
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
    public function update(LivroRequest $request, string $id)
    {
        return LivroService::update($request, $id);
    }

    public function upload(LivroUploadRequest $request, string $id)
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
