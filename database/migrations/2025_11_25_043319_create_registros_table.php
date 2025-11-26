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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sessao_id')->nullable()->constrained('sessoes')->nullOnDelete(); // opcional
            $table->foreignId('profissional_id')->constrained('users')->cascadeOnDelete();
            $table->enum('tipo', ['evolucao', 'anotacao', 'feedback', 'interconsulta']);
            $table->text('conteudo');
            $table->timestamp('data_registro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
