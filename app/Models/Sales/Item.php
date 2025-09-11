<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'sales_items';

    protected $fillable = [
        "name",
        "description",
        "price", // TODO:  Adicionar coluna preço de compra/custo
        "cost",
        "purchase_tax",
        "sales_tax",
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
