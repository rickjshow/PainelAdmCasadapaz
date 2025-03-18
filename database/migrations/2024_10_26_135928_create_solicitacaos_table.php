<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitacaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->unsignedBigInteger('vaga'); // Modificando para chave estrangeira
            $table->string('status')->default('pendente');
            $table->text('mensagem_resposta')->nullable();
            $table->string('aprovacao')->nullable();
            $table->timestamps();

            // Definindo a chave estrangeira
            $table->foreign('vaga')->references('id')->on('vagas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitacaos', function (Blueprint $table) {
            // Remover a chave estrangeira antes de apagar a tabela
            $table->dropForeign(['vaga']);
        });

        Schema::dropIfExists('solicitacaos');
    }
};
