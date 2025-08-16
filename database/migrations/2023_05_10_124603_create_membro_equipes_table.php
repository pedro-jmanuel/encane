<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membro_equipes', function (Blueprint $table) {
            $table->id();
            $table->string("nome_completo");
            $table->string("imagem");
            $table->string("cargo");
            $table->string("linkedin")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->string("twitter")->nullable();
            $table->foreignIdFor(User::class,"created_by")->nullable();
            $table->foreignIdFor(User::class,"updated_by")->nullable();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('membro_equipes');
    }
};
