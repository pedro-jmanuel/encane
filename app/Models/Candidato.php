<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidato extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "nome_completo",
        "email",
        "telefone",
        "imagem",
        "resumo",
        "curriculo",
        "area_id",
        "created_by",
        "updated_by",
     ];
}
