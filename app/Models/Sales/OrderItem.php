<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    
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
        return $this->belongsTo(Order::class, 'sales_order_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'sales_item_id');
    }

}
