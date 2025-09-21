<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNoteItem extends Model
{
    use HasFactory;

    protected $table = 'sales_credit_note_items'; 

    protected $fillable = [
        "sales_credit_note_id",
        "sales_item_id",
        "purchase_tax",
        "sales_tax",
        "quantity",
        "unit_price",
        "discount",
        "subtotal"
     ];

     /**
     * Relacionamento com a nota de crédito.
     */
    public function creditNote()
    {
        return $this->belongsTo(CreditNote::class, 'credit_note_id');
    }

    /**
     * Relacionamento com o item (produto/artigo).
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'sales_item_id');
    }
}
