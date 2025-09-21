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
        Schema::create('sales_credit_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_invoice_id')
                  ->constrained('sales_invoices')
                  ->onDelete('cascade'); // Se apagar a invoice, apaga as notas associadas

            $table->date('date')->default(now());      // Data da emissão
            $table->string('reason')->nullable();      // Motivo da emissão

            $table->enum('status', ['DRAFT', 'ISSUID', 'CANCELLED'])->default('DRAFT');

            $table->decimal('total_amount', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_credit_notes');
    }
};
