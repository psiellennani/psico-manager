<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class AnamneseInfantil extends Model
{

    protected $table = 'anamneses_infantis';

    protected $fillable = [
        'paciente_id',
        'idade',
        'sexo',
        'estado_civil_pais',
        'nome_mae',
        'profissao_mae',
        'data_nascimento_mae',
        'nome_pai',
        'profissao_pai',
        'data_nascimento_pai',
        'cpf_responsavel',
        'contato_emergencia',
        'emergencia_falar_com',
        'mora_com',
        'escola',
        'serie_ano',
        'desempenho_escolar',
        'motivos',
        'inicio_sintomas',
        'idade_problemas',
        'hipotese_familia',
        'atitude_familiar',
        'expectativas',
        'quem_encaminhou',
        'ambiente_ocorre',
        'gestacao_planejada',
        'gestacao_tranquila',
        'pre_natal_completo',
        'complicacoes_gestacao',
        'uso_substancias',
        'acontecimentos_gestacao',
        'tipo_parto',
        'duracao_parto',
        'acompanhante_parto',
        'peso_nascimento',
        'apgar',
        'prematuro',
        'problemas_ao_nascer',
        'amamentacao',
        'mes_sentou',
        'mes_engatinhou',
        'mes_andou',
        'coord_motora_fina',
        'coord_motora_grossa',
        'primeiras_palavras',
        'formacao_frases',
        'problemas_linguagem',
        'compreensao',
        'relacionamento_criancas',
        'relacionamento_adultos',
        'agressividade',
        'birras',
        'desobediencia',
        'medos',
        'reacao_mudancas',
        'dorme_bem',
        'sono_como',
        'habitos_sono',
        'dorme_sozinho',
        'dorme_em_cama_individual',
        'ronca',
        'doencas',
        'alergias',
        'convulsoes_desmaios',
        'internacoes',
        'medicacoes',
        'cirurgias',
        'historico_familiar_transtornos',
        'brincadeiras_preferidas',
        'com_quem_brinca',
        'tempo_tela_horas',
        'pratica_esportes',
        'tarefas_domesticas',
        'traumas',
        'violencia',
        'mudancas_recentes',
        'outras_informacoes'
    ];




    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
