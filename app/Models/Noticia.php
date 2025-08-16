<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'slug',
        'titulo',
        'conteudo',
        'imagem',
        'created_by',
        'updated_by',
    ];

}
