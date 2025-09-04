<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
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
