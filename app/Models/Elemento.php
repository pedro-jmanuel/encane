<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Elemento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
       "identificador",
       "titulo",
       "conteudo",
       "imagem",
       "pagina_id",
       "created_by",
       "updated_by",
    ];


    public static function existe($titulo){
        return Elemento::where("identificador",Str::slug($titulo,'_'))->exists();
    }

}
