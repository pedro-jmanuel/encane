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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
                $table->foreignId('sales_customer_id')->constrained('sales_customers')->cascadeOnDelete();
                $table->dateTime('order_date');
                $table->dateTime('due_date')->nullable();
                $table->enum('status', ['DRAFT','PENDING','CANCELLED','COMPLETED'])->default('DRAFT');
                /* 
                    Estados possíveis para Order
                        draft → pedido ainda não confirmado.
                        pending (ou confirmed) → confirmado, aguardando emissão de fatura.
                        cancelled → pedido anulado.
                        completed → pedido finalizado (entregue).
                */
                $table->decimal('total_amount', 15, 2)->default(0);
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
        Schema::dropIfExists('sales_orders');
    }
};
