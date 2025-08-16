<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plano extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'nome',
        'alvo',
        'preco',
        'moeda',
        'recursos',
        'created_by',
        'updated_by',
    ];

}
