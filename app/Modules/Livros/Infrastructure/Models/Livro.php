<?php

namespace App\Modules\Livros\Infrastructure\Models;


use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        'nome',
        'autor',
        'descricao',
        'ja_leu',
        'paginas',
        'genero',
        'isbn',
    ];
}
