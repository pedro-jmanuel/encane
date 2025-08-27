<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'sales_items';

    protected $fillable = [
        "name",
        "description",
        "price",
        "tax_rate",
        "item_type",
        "category_id"
     ];
}
