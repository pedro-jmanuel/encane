<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizacao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        "nome",
        "endereco",
        "logo",
        "telefone_1",
        "telefone_2",
        "email"	,
        "resumo",
        "sobre",
        "created_by",
        "updated_by"
    ];

}
