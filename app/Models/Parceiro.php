<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parceiro extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'sigla',
        'nome',
        'logotipo',
        'link_site',
        'sobre',
        'created_by',
        'updated_by',
    ];
}
