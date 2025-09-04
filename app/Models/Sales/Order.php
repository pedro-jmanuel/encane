<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'sales_orders';

    protected $fillable = [
        "sales_customer_id",
        "order_date",
        "due_date",
        "status",
        "total_amount"
     ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'sales_customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'sales_order_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'sales_order_id');
    }

}
