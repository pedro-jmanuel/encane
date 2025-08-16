<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagina extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'nome',
        'identificador',
        'route'
    ];

    public static function allElementos($nome_pagina){
        $pagina = Pagina::where("identificador",$nome_pagina)->get()->first();
        if ($pagina == NULL) {
            return [];
        } else {
            $dados     = [];
            $elementos = Elemento::where("pagina_id",$pagina->id)->get();
            foreach ($elementos as $elemento) {
                $dados["tag_" . $elemento->identificador] = $elemento;
            }
            return $dados;
        }
    }

}
