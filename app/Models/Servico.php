<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servico extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable=[
        'slug',
        'titulo',
        'imagem',
        'conteudo',
        'created_by',
        'updated_by',
    ];

}
