<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface Service
{
    public static function store(Request $request);
    public static function index();
    public static function show(string $id);
    public static function update(Request $request, string $id);
    public static function destroy(string $id);
}