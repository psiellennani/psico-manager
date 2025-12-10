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
        Schema::create('anamneses_infantis', function (Blueprint $table) {
            $table->id(); // <- OBRIGATÓRIO
            $table->foreignId('paciente_id')
                ->unique() // <- GARANTE QUE SÓ EXISTE UMA POR PACIENTE
                ->constrained('pacientes')
                ->onDelete('cascade');
            // IDENTIFICAÇÃO
            $table->string('idade')->nullable();
            $table->string('sexo')->nullable();
            $table->string('estado_civil_pais')->nullable();
            $table->string('nome_mae')->nullable();
            $table->string('profissao_mae')->nullable();
            $table->date('data_nascimento_mae')->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('profissao_pai')->nullable();
            $table->date('data_nascimento_pai')->nullable();
            $table->string('cpf_responsavel')->nullable();
            $table->string('contato_emergencia')->nullable();
            $table->string('emergencia_falar_com')->nullable();
            $table->string('mora_com')->nullable();
            $table->string('escola')->nullable();
            $table->string('serie_ano')->nullable();
            $table->string('desempenho_escolar')->nullable();


            // QUEIXA / MOTIVO
            $table->text('motivos')->nullable();
            $table->string('inicio_sintomas')->nullable();
            $table->string('idade_problemas')->nullable();
            $table->text('hipotese_familia')->nullable();
            $table->text('atitude_familiar')->nullable();
            $table->text('expectativas')->nullable();
            $table->string('quem_encaminhou')->nullable();
            $table->string('ambiente_ocorre')->nullable();


            // GESTAÇÃO
            $table->string('gestacao_planejada')->nullable();
            $table->string('gestacao_tranquila')->nullable();
            $table->string('pre_natal_completo')->nullable();
            $table->text('complicacoes_gestacao')->nullable();
            $table->text('uso_substancias')->nullable();
            $table->text('acontecimentos_gestacao')->nullable();

            // PARTO
            $table->string('tipo_parto')->nullable();
            $table->string('duracao_parto')->nullable();
            $table->string('acompanhante_parto')->nullable();
            $table->decimal('peso_nascimento', 5, 2)->nullable();
            $table->string('apgar')->nullable();
            $table->boolean('prematuro')->nullable();
            $table->text('problemas_ao_nascer')->nullable();
            $table->text('amamentacao')->nullable();


            // DESENVOLVIMENTO MOTOR
            $table->string('mes_sentou')->nullable();
            $table->string('mes_engatinhou')->nullable();
            $table->string('mes_andou')->nullable();
            $table->string('coord_motora_fina')->nullable();
            $table->string('coord_motora_grossa')->nullable();


            // LINGUAGEM
            $table->text('primeiras_palavras')->nullable();
            $table->text('formacao_frases')->nullable();
            $table->text('problemas_linguagem')->nullable();
            $table->text('compreensao')->nullable();


            // COMPORTAMENTO / SOCIALIZAÇÃO
            $table->string('relacionamento_criancas')->nullable();
            $table->string('relacionamento_adultos')->nullable();
            $table->string('agressividade')->nullable();
            $table->string('birras')->nullable();
            $table->string('desobediencia')->nullable();
            $table->text('medos')->nullable();
            $table->text('reacao_mudancas')->nullable();


            // SONO
            $table->string('dorme_bem')->nullable();
            $table->text('sono_como')->nullable();
            $table->text('habitos_sono')->nullable();
            $table->string('dorme_sozinho')->nullable();
            $table->string('dorme_em_cama_individual')->nullable();
            $table->string('ronca')->nullable();


            // SAÚDE
            $table->text('doencas')->nullable();
            $table->text('alergias')->nullable();
            $table->text('convulsoes_desmaios')->nullable();
            $table->text('internacoes')->nullable();
            $table->text('medicacoes')->nullable();
            $table->text('cirurgias')->nullable();
            $table->text('historico_familiar_transtornos')->nullable();


            // ATIVIDADES / ROTINA
            $table->text('brincadeiras_preferidas')->nullable();
            $table->text('com_quem_brinca')->nullable();
            $table->string('tempo_tela_horas')->nullable();
            $table->text('pratica_esportes')->nullable();
            $table->text('tarefas_domesticas')->nullable();


            // OUTRAS
            $table->text('traumas')->nullable();
            $table->text('violencia')->nullable();
            $table->text('mudancas_recentes')->nullable();
            $table->text('outras_informacoes')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamneses_infantis');
    }
};
