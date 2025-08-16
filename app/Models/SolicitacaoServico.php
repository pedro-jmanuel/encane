<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitacaoServico extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome_completo',
        'email',
        'telefone',
        'is_atendido',
        'servico_id',
        'mensagem',
        'created_by',
        'updated_by',
    ];
}
