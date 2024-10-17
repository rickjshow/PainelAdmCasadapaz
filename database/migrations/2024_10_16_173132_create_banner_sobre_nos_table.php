<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banner_sobre_nos', function (Blueprint $table) {
            $table->id();
            $table->binary('banner_principal')->nullable();
            $table->binary('banner_principal_mobile')->nullable();
            $table->binary('imagem_missao')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE banner_sobre_nos MODIFY banner_principal LONGBLOB');
        DB::statement('ALTER TABLE banner_sobre_nos MODIFY banner_principal_mobile LONGBLOB');
        DB::statement('ALTER TABLE banner_sobre_nos MODIFY imagem_missao LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_sobre_nos');
    }
};
