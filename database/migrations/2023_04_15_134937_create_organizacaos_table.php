<?php

use App\Models\User;
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
        Schema::create('organizacaos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nome")->nullable();
            $table->string("logo")->nullable();
            $table->string("telefone_1")->nullable();
            $table->string("telefone_2")->nullable();
            $table->string("endereco")->nullable();
            $table->string("email")->nullable();
            $table->longText("resumo")->nullable();
            $table->longText("sobre");
            $table->foreignIdFor(User::class,"created_by")->nullable();
            $table->foreignIdFor(User::class,"updated_by")->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizacaos');
    }
};
