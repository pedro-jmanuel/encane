<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $table = 'sales_taxes';

    protected $fillable = [
        "type",
        "code",
        "percentage",
        "amount",
        "description",
    ];

}
