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
        "price", // TODO:  Adicionar coluna preço de compra/custo
        "tax_rate",
        "item_type",
        "category_id"
     ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'item_id');
    }

    public function attributes()
    {
        return $this->hasMany(ItemAttribute::class, 'item_id');
    }
}
