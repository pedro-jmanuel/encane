<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/* Serve para guardar características opcionais e dinâmicas de um item

Pensa no seguinte: no nosso sistema de faturação, a tabela items representa produtos/serviços genéricos (ex: "Camiseta", "Hospedagem de Site", "Pacote de Internet").

Mas muitas vezes, cada item pode ter variações ou detalhes extras que não justificam criar colunas fixas na tabela principal.
👉 É aí que entram os Item Attributes (atributos do item).

*/

class ItemAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'sales_item_attributes';

    protected $fillable = [
        "sales_item_id",
        "attribute_name",
        "attribute_value",
     ];


    public function item()
    {
        return $this->belongsTo(Item::class, 'sales_item_id');
    }

}
