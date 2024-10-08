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
        Schema::create('sobrenos', function (Blueprint $table) {
            $table->id();
            $table->binary('banner_principal')->nullable();
            $table->binary('banner_principal_mobile')->nullable();
            $table->binary('imagem_missao')->nullable();
            $table->text('missao');
            $table->text('sobre');
            $table->text('no_que_acreditamos');
            $table->text('atividades');
            $table->text('recursos');
            $table->text('sede');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sobrenos');
    }
};
