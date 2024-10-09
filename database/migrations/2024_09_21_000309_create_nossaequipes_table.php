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
        Schema::create('nossaequipes', function (Blueprint $table) {
            $table->id();
            $table->binary('foto');
            $table->string('nome');
            $table->string('cargo');
            $table->string('profissao');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE nossaequipes MODIFY foto LONGBLOB');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nossaequipes');
    }
};
