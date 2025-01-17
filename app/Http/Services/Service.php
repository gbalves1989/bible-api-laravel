<?php

namespace App\Http\Services;

use Illuminate\Foundation\Http\FormRequest;

interface Service
{
    public static function store(FormRequest $request);
    public static function index();
    public static function show(string $id);
    public static function update(FormRequest $request, string $id);
    public static function destroy(string $id);
}
