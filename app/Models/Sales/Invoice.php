<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'sales_invoices';

    protected $fillable = [
        "sales_order_id",
        "invoice_date",
        "payment_status",
        "total_paid",
        "balance_due"
     ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'sales_order_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }

    public function creditNotes()
    {
        return $this->hasMany(CreditNote::class, 'sales_invoice_id');
    }

    public function hasCreditNote(): bool
    {
        return $this->creditNotes()->exists();
    }

     public function getTotalPaid(): float
    {
        return $this->payments()->sum('amount');
    }

  
    public function isFullyPaid(): bool
    {
        return $this->balance_due == 0;
    }

    public static function status(){
        return [
        [
            'label' =>'Rascunho',
            'value' =>'DRAFT',
            'help'  =>'Rascunho, ainda não é documento fiscal válido',
            'span_class' =>'badge bg-secondary'
        ],
        [
            'label' =>'Emitida',
            'value' =>'ISSUED',
            'help'  =>'Fatura emitida, aguardando pagamento',
            'span_class' =>'badge bg-warning'
        ],
        [
            'label' =>'Cancelado',
            'value' =>'CANCELLED',
            'help'  =>'Fatura anulada',
            'span_class' =>'badge bg-danger'
        ],
         [
            'label' =>'Não Pago',
            'value' =>'UNPAID',
            'help'  =>'Já devia ter sido pago, mas não foi',
            'span_class' =>'badge bg-dark'
        ],
        [
            'label' =>'Parcialmente paga',
            'value' =>'PARTIALLY_PAID',
            'help'  =>'Parcialmente paga',
            'span_class' =>'badge bg-info'
        ],
        [
            'label' =>'Pago',
            'value' =>'PAID',
            'help'  =>'Totalmente paga',
            'span_class' =>'badge bg-success'
        ]
    ];
    }
}
