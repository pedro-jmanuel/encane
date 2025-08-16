<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembroEquipe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'imagem',
        'nome_completo',
        'cargo',
        'linkedin',
        'facebook',
        'instagram',
        'twitter',
        'created_by',
        'updated_by',
    ];

}
