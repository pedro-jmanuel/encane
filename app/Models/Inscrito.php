<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscrito extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'nome_completo',
        'email',
        'is_activo',
        'created_by',
        'updated_by',
    ];

}
