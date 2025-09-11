<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'sales_customers';
    
    protected $fillable = [
        "name",
        "email",
        "address",
        "tax_number",
        "phone"
     ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'sales_customer_id');
    }
    
}
