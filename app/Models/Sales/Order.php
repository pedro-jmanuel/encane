<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sales_orders';

    protected $fillable = [
        "sales_customer_id",
        "order_date",
        "due_date",
        "status",
        "total_amount"
     ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'sales_customer_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'sales_order_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'sales_order_id');
    }

    public function hasInvoice(): bool
    {
        return $this->invoice()->exists();
    }

    public static function status(){
        return  [
        [
            'label' => 'Rascunho',
            'value' => 'DRAFT',
            'help'  => 'Pedido ainda não confirmado',
            'span_class' => 'badge bg-secondary'
        ],
        [
            'label' => 'Pendente',
            'value' => 'PENDING',
            'help'  => 'Confirmado, aguardando emissão de fatura',
            'span_class' => 'badge bg-warning'
        ],
        [
            'label' => 'Cancelado',
            'value' => 'CANCELLED',
            'help'  => 'Pedido anulado',
            'span_class' => 'badge bg-danger'
        ],
        [
            'label' => 'Completo',
            'value' => 'COMPLETED',
            'help'  => 'Pedido finalizado (entregue)',
            'span_class' => 'badge bg-success'
        ]
    ];

    }

}
