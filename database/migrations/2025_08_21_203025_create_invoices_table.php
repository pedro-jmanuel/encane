<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->unique()->constrained('sales_orders')->cascadeOnDelete();
            $table->dateTime('invoice_date');
            $table->enum('payment_status', ['DRAFT', 'ISSUED','UNPAID', 'PAID','PARTIALLY_PAID','CANCELLED'])->default('DRAFT');
            /* 
                Estados possíveis para Invoice:
                    draft → rascunho, ainda não é documento fiscal válido.
                    issued (ou open) → fatura emitida, aguardando pagamento.
                    paid → totalmente paga.
                    unpaid → já devia ter sido pago, mas não foi
                    partially_paid → parcialmente paga.
                    cancelled (ou void) → fatura anulada.

            */
            $table->decimal('total_paid', 15, 2)->default(0);
            $table->decimal('balance_due', 15, 2)->default(0); // balance_due serve para acompanhar quanto ainda falta pagar em uma fatura, caso pague parcialmente.
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
