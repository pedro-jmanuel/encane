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
        Schema::create('sales_credit_note_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sales_credit_note_id')
                  ->constrained('sales_credit_notes')
                  ->onDelete('cascade'); // Se apagar a nota, apaga os itens

            $table->foreignId('sales_item_id')
                  ->constrained('sales_items')
                  ->onDelete('restrict'); // Não deixa apagar item em uso
            
            $table->decimal('purchase_tax', 5, 2)->default(0); // percentagem
            $table->decimal('sales_tax', 5, 2)->default(0); // percentagem

            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 15, 2);

            $table->decimal('discount', 15, 2)->default(0);

            $table->decimal('subtotal', 15, 2);

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
        Schema::dropIfExists('sales_credit_note_items');
    }
};
