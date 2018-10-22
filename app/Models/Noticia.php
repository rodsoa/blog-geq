<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $fillable = [
        'titulo',
        'autor',
        'categoria',
        'palavras_chaves',
        'conteudo'
    ];
}
