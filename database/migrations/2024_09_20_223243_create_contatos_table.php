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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('contato');
            $table->string('whatsapp', 20);
            $table->string('instagram', 50);
            $table->string('fanpage', 50);
            $table->string('endereco_sede,', 100);
            $table->string('endereco_bazar',100);
            $table->string('instagram_bazar', 50);
            $table->string('email', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};
