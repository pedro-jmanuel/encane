<?php

use App\Models\Servico;
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
        Schema::create('solicitacao_servicos', function (Blueprint $table) {
            $table->id();
            $table->string("nome_completo");
            $table->string("email");
            $table->string("telefone");
            $table->boolean("is_atendido")->default(false);
            $table->longText("mensagem");
            $table->foreignIdFor(Servico::class);
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
        Schema::dropIfExists('solicitacao_servicos');
    }
};
