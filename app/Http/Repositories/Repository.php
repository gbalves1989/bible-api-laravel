<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

interface Repository
{
    public static function store(FormRequest $request);
    public static function index();
    public static function show(string $id);
    public static function update(FormRequest $request, Model $model);
    public static function destroy(string $id);
}
