<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'sales_payments';

     protected $fillable = [
        "invoice_id",
        "payment_date",
        "amount",
        "method",
        "reference_number",
     ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public static function methods(){
        return [
        [
            'label' =>'Dinheiro',
            'value' =>'CASH',
            'help'  =>'',
            'span_class' =>''
        ],
         [
            'label' =>'Transfêrencia',
            'value' =>'TRANSFER',
            'help'  =>'',
            'span_class' =>''
        ], 
         [
            'label' =>'Cartão Multicaixa',
            'value' =>'CARD',
            'help'  =>'',
            'span_class' =>''
        ], 
         [
            'label' =>'Mobile Money',
            'value' =>'MOBILE_MONEY',
            'help'  =>'',
            'span_class' =>''
        ], 
    ];
    }

}
