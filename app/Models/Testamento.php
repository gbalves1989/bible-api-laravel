<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testamento extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function livros()
    {
        return $this->hasMany(Livro::class);
    }
}
