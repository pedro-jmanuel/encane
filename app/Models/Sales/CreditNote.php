<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    use HasFactory;

     protected $table = 'sales_credit_notes'; 

     protected $fillable = [
        "sales_invoice_id",
        "credit_number",
        "date",
        "reason",
        "status",
        "total_amount"
     ];



    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'sales_invoice_id');
    }

    public function creditNoteItems()
    {
        return $this->hasMany(CreditNoteItem::class, 'sales_credit_note_id');
    }

}
