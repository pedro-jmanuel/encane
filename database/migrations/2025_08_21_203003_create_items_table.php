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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->decimal('cost', 15, 2)->default(0);

            $table->decimal('purchase_tax', 5, 2)->default(0); // percentagem
            $table->decimal('sales_tax', 5, 2)->default(0); // percentagem

            $table->decimal('purchase_tax_amount', 5, 2)->default(0); 
            $table->decimal('sales_tax_amount', 5, 2)->default(0);

            $table->enum('purchase_tax_type', ['IVA', '15', 'NS']);
            $table->enum('sales_tax_type', ['IVA', '15', 'NS']);

            $table->enum('purchase_tax_code', ['NOR', 'ISE', 'OUT']); 
            $table->enum('sales_tax_code',['NOR', 'ISE', 'OUT']);

            $table->enum('item_type', ['PRODUCT', 'SERVICE']);

            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('sales_categories')
                  ->nullOnDelete();


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
        Schema::dropIfExists('sales_items');
    }
};
