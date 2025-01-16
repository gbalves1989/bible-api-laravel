<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'posicao', 'abreviacao', 'capa'];

    protected $hidden = ['testamento_id', 'created_at', 'updated_at'];

    public function testamento()
    {
        return $this->belongsTo(Testamento::class);
    }

    public function versiculos()
    {
        return $this->hasMany(Versiculo::class);
    }
}
