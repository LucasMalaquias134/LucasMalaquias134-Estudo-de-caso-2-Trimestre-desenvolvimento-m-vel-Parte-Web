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
            $table->string('nome');
            $table->string('sobrenome')->nullable();
            $table->string('telefone')->unique();
            $table->string('empresa')->nullable();
            $table->string('descricao')->nullable();
            $table->string('imagem');
            $table->timestamps();

            $table->foreignId('users_id')->constrained('users');
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
