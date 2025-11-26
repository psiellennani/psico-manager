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
        Schema::create('sessoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->cascadeOnDelete();
            $table->foreignId('profissional_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('consulta_id')->nullable()->constrained()->nullOnDelete();
            $table->text('conteudo')->nullable(); // texto principal da sessão
            $table->timestamp('data_sessao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessaos');
    }
};
