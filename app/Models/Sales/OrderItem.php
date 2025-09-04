<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'sales_order_items';

    protected $fillable = [
        "sales_order_id",
        "sales_item_id",
        "quantity",
        "unit_price",
        "discount",
        "subtotal"
     ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
