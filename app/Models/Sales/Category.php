<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'sales_categories'; 

    protected $fillable = [
        "name",
        "description",
        "code"
     ];

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
