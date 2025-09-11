<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'sales_invoices';

    protected $fillable = [
        "sales_order_id",
        "invoice_date",
        "payment_status",
        "total_paid",
        "balance_due"
     ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'sales_order_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }
}
