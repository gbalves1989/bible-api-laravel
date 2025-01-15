<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Repository
{
    public static function store(Request $request);
    public static function index();
    public static function show(string $id);
    public static function update(Request $request, Model $model);
    public static function destroy(string $id);
}