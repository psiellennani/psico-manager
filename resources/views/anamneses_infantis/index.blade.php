{{-- resources/views/anamnese-infantil/index.blade.php --}}
@extends('layouts.app')

@section('pageTitle', isset($item) ? 'Editar Anamnese Infantil' : 'Nova Anamnese Infantil')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white p-6 sm:p-10 text-center">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black mb-1">
            {{ isset($item) ? 'Editar' : 'Preencher' }} Anamnese Infantil
        </h1>
        <p class="text-lg sm:text-xl font-light">Paciente: <strong class="font-bold">{{ $paciente->nome }}</strong></p>
    </div>

    <form id="anamneseForm" action="{{ $item
    ? route('anamnese-infantil.update', ['paciente' => $paciente->id, 'anamnese_infantil' => $item->id])
    : route('anamnese-infantil.store', ['paciente' => $paciente->id]) }}"
        method="POST">

        @csrf
        @if($item)
        @method('PUT')
        @endif

        <section class="bg-gradient-to-r from-blue-50 to-cyan-50 p-6 sm:p-8 rounded-2xl border-2 border-blue-200">
            <h2 class="text-2xl sm:text-3xl font-bold text-blue-800 mb-6 border-b-2 border-blue-300 pb-3">
                📝 1. Identificação da Criança e Família
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 sm:gap-6">

                <!-- NOME -->
                <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome completo da criança *</label>
                    <input type="text" name="paciente[nome]"
                        value="{{ old('paciente.nome', $paciente->nome) }}"
                        class="w-full px-4 py-2 border border-blue-300 rounded-lg">
                </div>

                <!-- DATA DE NASCIMENTO -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento *</label>
                    <input type="date" name="paciente[data_nascimento]"
                        value="{{ old('paciente.data_nascimento', $paciente->data_nascimento) }}"
                        class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- IDADE (ANAMNESE) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Idade atual</label>
                    <input type="text" name="idade"
                        value="{{ old('idade', $item->idade ?? '') }}"
                        placeholder="Ex: 7 anos e 2 meses"
                        class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- SEXO (ANAMNESE) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sexo *</label>
                    <div class="flex items-center gap-6 mt-1">
                        <label class="flex items-center text-base">
                            <input type="radio" name="sexo" value="MASC"
                                {{ old('sexo', $item->sexo ?? '') == 'MASC' ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600">
                            <span class="ml-2">Masculino</span>
                        </label>

                        <label class="flex items-center text-base">
                            <input type="radio" name="sexo" value="FEM"
                                {{ old('sexo', $item->sexo ?? '') == 'FEM' ? 'checked' : '' }}
                                class="w-5 h-5 text-pink-600">
                            <span class="ml-2">Feminino</span>
                        </label>
                    </div>
                </div>

                <!-- ENDEREÇO -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium">Endereço</label>
                    <input type="text" name="paciente[endereco]"
                        value="{{ old('paciente.endereco', $paciente->endereco) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- CIDADE -->
                <div>
                    <label class="block text-sm font-medium">Cidade</label>
                    <input type="text" name="paciente[cidade]"
                        value="{{ old('paciente.cidade', $paciente->cidade) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- CEP -->
                <div>
                    <label class="block text-sm font-medium">CEP</label>
                    <input type="text" name="paciente[cep]"
                        value="{{ old('paciente.cep', $paciente->cep) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- CELULAR -->
                <div>
                    <label class="block text-sm font-medium">Celular Responsável</label>
                    <input type="text" name="paciente[telefone]"
                        value="{{ old('paciente.telefone', $paciente->telefone) }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- ESTADO CIVIL (ANAMNESE) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium">Estado civil dos pais</label>
                    <select name="estado_civil_pais" class="mt-1 w-full px-4 py-2 border rounded-lg text-base">
                        <option value="">Selecione...</option>
                        <option value="casados" {{ old('estado_civil_pais', $item->estado_civil_pais ?? '')=='casados' ? 'selected' : '' }}>Casados</option>
                        <option value="uniao_estavel" {{ old('estado_civil_pais', $item->estado_civil_pais ?? '')=='uniao_estavel' ? 'selected' : '' }}>União Estável</option>
                        <option value="separados" {{ old('estado_civil_pais', $item->estado_civil_pais ?? '')=='separados' ? 'selected' : '' }}>Separados/Divorciados</option>
                        <option value="nunca_viveram_juntos" {{ old('estado_civil_pais', $item->estado_civil_pais ?? '')=='nunca_viveram_juntos' ? 'selected' : '' }}>Nunca viveram juntos</option>
                    </select>
                </div>

                <!-- MORA COM -->
                <div>
                    <label class="block text-sm font-medium">Mora com</label>
                    <input type="text" name="mora_com"
                        placeholder="Mãe, pai, avós..."
                        value="{{ old('mora_com', $item->mora_com ?? '') }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>
            </div>

            <!-- MÃE E PAI -->
            <div class="grid md:grid-cols-2 gap-6 mt-6">

                <!-- MÃE -->
                <div class="bg-pink-100 p-4 rounded-xl border border-pink-300">
                    <h3 class="text-lg font-bold text-pink-900 mb-3">Mãe</h3>

                    <input type="text" name="nome_mae"
                        placeholder="Nome completo"
                        value="{{ old('nome_mae', $item->nome_mae ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg mb-2">

                    <input type="text" name="profissao_mae"
                        placeholder="Profissão"
                        value="{{ old('profissao_mae', $item->profissao_mae ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg mb-2">

                    <label class="block text-xs font-medium">Data de Nasc.</label>
                    <input type="date" name="data_nascimento_mae"
                        value="{{ old('data_nascimento_mae', $item->data_nascimento_mae ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg">
                </div>

                <!-- PAI -->
                <div class="bg-blue-100 p-4 rounded-xl border border-blue-300">
                    <h3 class="text-lg font-bold text-blue-900 mb-3">Pai</h3>

                    <input type="text" name="nome_pai"
                        placeholder="Nome completo"
                        value="{{ old('nome_pai', $item->nome_pai ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg mb-2">

                    <input type="text" name="profissao_pai"
                        placeholder="Profissão"
                        value="{{ old('profissao_pai', $item->profissao_pai ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg mb-2">

                    <label class="block text-xs font-medium">Data de Nasc.</label>
                    <input type="date" name="data_nascimento_pai"
                        value="{{ old('data_nascimento_pai', $item->data_nascimento_pai ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg">
                </div>
            </div>

            <!-- EMERGÊNCIA -->
            <div class="grid md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label class="block text-sm font-medium">CPF do Responsável</label>
                    <input type="text" name="cpf_responsavel"
                        value="{{ old('cpf_responsavel', $item->cpf_responsavel ?? '') }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium">Contato de Emergência</label>
                    <input type="text" name="contato_emergencia"
                        value="{{ old('contato_emergencia', $item->contato_emergencia ?? '') }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium">Falar com (Emergência)</label>
                    <input type="text" name="emergencia_falar_com"
                        value="{{ old('emergencia_falar_com', $item->emergencia_falar_com ?? '') }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>
            </div>

            <!-- ESCOLA -->
            <div class="grid md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label class="block text-sm font-medium">Escola</label>
                    <input type="text" name="escola"
                        value="{{ old('escola', $item->escola ?? '') }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium">Série/Ano</label>
                    <input type="text" name="serie_ano"
                        value="{{ old('serie_ano', $item->serie_ano ?? '') }}"
                        class="mt-1 w-full px-4 py-2 border rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium">Desempenho Escolar</label>
                    <select name="desempenho_escolar" class="mt-1 w-full px-4 py-2 border rounded-lg text-base">
                        <option value="">Selecione...</option>
                        <option value="Otimo" {{ old('desempenho_escolar', $item->desempenho_escolar ?? '')=='Otimo' ? 'selected' : '' }}>Ótimo</option>
                        <option value="Bom" {{ old('desempenho_escolar', $item->desempenho_escolar ?? '')=='Bom' ? 'selected' : '' }}>Bom</option>
                        <option value="Regular" {{ old('desempenho_escolar', $item->desempenho_escolar ?? '')=='Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Dificuldade" {{ old('desempenho_escolar', $item->desempenho_escolar ?? '')=='Dificuldade' ? 'selected' : '' }}>Com Dificuldade</option>
                    </select>
                </div>
            </div>
        </section>
        ---

        <section class="bg-gradient-to-r from-red-50 to-pink-50 p-6 sm:p-8 rounded-2xl border-2 border-red-300">
            <h2 class="text-2xl sm:text-3xl font-bold text-red-800 mb-6 border-b-2 border-red-300 pb-3">
                🗣️ 2. Queixa Principal / Motivo da Consulta
            </h2>
            <label class="block text-sm font-medium text-gray-700 mb-1">Motivos (o que está acontecendo, desde quando, etc.)</label>
            <textarea name="motivos" rows="6" class="w-full px-4 py-3 text-base border-2 border-red-300 rounded-lg">{{ old('motivos', $item->motivos ?? '') }}</textarea>

            <div class="grid md:grid-cols-3 gap-6 mt-6">
                <div><label class="block text-sm font-medium">Início dos sintomas</label><input type="text" name="inicio_sintomas" value="{{ old('inicio_sintomas', $item->inicio_sintomas ?? '') }}" class="mt-1 w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium">Idade que começaram os problemas</label><input type="text" name="idade_problemas" value="{{ old('idade_problemas', $item->idade_problemas ?? '') }}" class="mt-1 w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium">Quem encaminhou?</label><input type="text" name="quem_encaminhou" value="{{ old('quem_encaminhou', $item->quem_encaminhou ?? '') }}" class="mt-1 w-full px-4 py-2 border rounded-lg"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div><label class="block text-sm font-medium">Hipótese da família sobre o problema</label><textarea name="hipotese_familia" rows="3" class="mt-1 w-full px-4 py-2 border rounded-lg">{{ old('hipotese_familia', $item->hipotese_familia ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Atitude da família frente à situação</label><textarea name="atitude_familiar" rows="3" class="mt-1 w-full px-4 py-2 border rounded-lg">{{ old('atitude_familiar', $item->atitude_familiar ?? '') }}</textarea></div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium">Expectativas em relação ao tratamento</label>
                <textarea name="expectativas" rows="3" class="mt-1 w-full px-4 py-2 border rounded-lg">{{ old('expectativas', $item->expectativas ?? '') }}</textarea>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium">Ambiente onde os problemas ocorrem mais</label>
                <input type="text" name="ambiente_ocorre" value="{{ old('ambiente_ocorre', $item->ambiente_ocorre ?? '') }}" class="mt-1 w-full px-4 py-2 border rounded-lg">
            </div>
        </section>

        ---

        <section class="bg-gradient-to-r from-teal-50 to-cyan-50 p-6 sm:p-8 rounded-2xl border-2 border-teal-400">
            <h2 class="text-2xl sm:text-3xl font-bold text-teal-800 mb-6 border-b-2 border-teal-300 pb-3">
                🤰 3. Gestação e Parto
            </h2>

            <div class="grid md:grid-cols-3 gap-6 mb-6">
                <div>
                    <p class="text-base font-medium mb-2">Gestação planejada?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="gestacao_planejada" value="Sim" {{ old('gestacao_planejada', $item->gestacao_planejada ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-teal-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="gestacao_planejada" value="Não" {{ old('gestacao_planejada', $item->gestacao_planejada ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-teal-600"> Não</label>
                    </div>
                </div>
                <div>
                    <p class="text-base font-medium mb-2">Gestação tranquila?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="gestacao_tranquila" value="Sim" {{ old('gestacao_tranquila', $item->gestacao_tranquila ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-teal-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="gestacao_tranquila" value="Não" {{ old('gestacao_tranquila', $item->gestacao_tranquila ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-teal-600"> Não</label>
                    </div>
                </div>
                <div>
                    <p class="text-base font-medium mb-2">Pré-natal completo?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="pre_natal_completo" value="Sim" {{ old('pre_natal_completo', $item->pre_natal_completo ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-teal-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="pre_natal_completo" value="Não" {{ old('pre_natal_completo', $item->pre_natal_completo ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-teal-600"> Não</label>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div><label class="block text-sm font-medium">Complicações na gestação</label><textarea name="complicacoes_gestacao" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('complicacoes_gestacao', $item->complicacoes_gestacao ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Uso de substâncias (álcool, cigarro, medicamentos)</label><textarea name="uso_substancias" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('uso_substancias', $item->uso_substancias ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Acontecimentos relevantes durante a gestação</label><textarea name="acontecimentos_gestacao" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('acontecimentos_gestacao', $item->acontecimentos_gestacao ?? '') }}</textarea></div>
            </div>

            <h3 class="text-xl font-bold text-teal-900 mt-8 mb-4">Detalhes do Parto</h3>
            <div class="grid md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium">Tipo de parto</label>
                    <select name="tipo_parto" class="mt-1 w-full px-4 py-2 border rounded-lg text-base">
                        <option value="">Selecione</option>
                        <option value="Normal" {{ old('tipo_parto', $item->tipo_parto ?? '') == 'Normal' ? 'selected' : '' }}>Normal</option>
                        <option value="Cesárea" {{ old('tipo_parto', $item->tipo_parto ?? '') == 'Cesárea' ? 'selected' : '' }}>Cesárea</option>
                        <option value="Fórceps" {{ old('tipo_parto', $item->tipo_parto ?? '') == 'Fórceps' ? 'selected' : '' }}>Fórceps</option>
                        <option value="Outro" {{ old('tipo_parto', $item->tipo_parto ?? '') == 'Outro' ? 'selected' : '' }}>Outro</option>
                    </select>
                </div>
                <div><label class="block text-sm font-medium">Duração do parto</label><input type="text" name="duracao_parto" value="{{ old('duracao_parto', $item->duracao_parto ?? '') }}" class="mt-1 w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium">Acompanhante</label><input type="text" name="acompanhante_parto" value="{{ old('acompanhante_parto', $item->acompanhante_parto ?? '') }}" class="mt-1 w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium">Peso ao nascer (kg)</label><input type="number" step="0.01" name="peso_nascimento" value="{{ old('peso_nascimento', $item->peso_nascimento ?? '') }}" class="mt-1 w-full px-4 py-2 border rounded-lg"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mt-6">
                <div><label class="block text-sm font-medium">APGAR (Pontuação)</label><input type="text" name="apgar" value="{{ old('apgar', $item->apgar ?? '') }}" class="mt-1 w-full px-4 py-2 border rounded-lg"></div>
                <div>
                    <label class="block text-sm font-medium">Foi prematuro?</label>
                    <div class="flex gap-4 mt-2">
                        <label class="text-sm"><input type="radio" name="prematuro" value="1" {{ old('prematuro', $item->prematuro ?? '') == '1' ? 'checked' : '' }} class="w-4 h-4 text-teal-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="prematuro" value="0" {{ old('prematuro', $item->prematuro ?? '') == '0' ? 'checked' : '' }} class="w-4 h-4 text-teal-600"> Não</label>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                <div><label class="block text-sm font-medium">Problemas ao nascer (icterícia, UTI, etc.)</label><textarea name="problemas_ao_nascer" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('problemas_ao_nascer', $item->problemas_ao_nascer ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Amamentação (tempo, dificuldades)</label><textarea name="amamentacao" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('amamentacao', $item->amamentacao ?? '') }}</textarea></div>
            </div>
        </section>

        ---

        <section class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 sm:p-8 rounded-3xl border-2 border-green-400">
            <h2 class="text-2xl sm:text-3xl font-bold text-green-900 mb-6 border-b-2 border-green-300 pb-3">
                🏃 4. Desenvolvimento Motor e Linguagem
            </h2>

            <h3 class="text-xl font-bold text-green-800 mb-4">Desenvolvimento Motor</h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium">Sentou sozinho (mês)</label>
                    <input type="text" name="mes_sentou" placeholder="Ex: 7 meses" value="{{ old('mes_sentou', $item->mes_sentou ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium">Engatinhou (mês)</label>
                    <input type="text" name="mes_engatinhou" placeholder="Ex: 9 meses" value="{{ old('mes_engatinhou', $item->mes_engatinhou ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium">Andou sozinho (mês)</label>
                    <input type="text" name="mes_andou" placeholder="Ex: 13 meses" value="{{ old('mes_andou', $item->mes_andou ?? '') }}"
                        class="w-full px-4 py-2 border rounded-lg">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label class="block text-sm font-medium">Coordenação Motora Fina</label>
                    <select name="coord_motora_fina" class="mt-1 w-full px-4 py-2 border rounded-lg text-base">
                        <option value="">Selecione...</option>
                        <option value="Adequada" {{ old('coord_motora_fina', $item->coord_motora_fina ?? '') == 'Adequada' ? 'selected' : '' }}>Adequada</option>
                        <option value="Dificuldade Leve" {{ old('coord_motora_fina', $item->coord_motora_fina ?? '') == 'Dificuldade Leve' ? 'selected' : '' }}>Dificuldade Leve</option>
                        <option value="Atraso Moderado" {{ old('coord_motora_fina', $item->coord_motora_fina ?? '') == 'Atraso Moderado' ? 'selected' : '' }}>Atraso Moderado</option>
                        <option value="Atraso Severo" {{ old('coord_motora_fina', $item->coord_motora_fina ?? '') == 'Atraso Severo' ? 'selected' : '' }}>Atraso Severo</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Coordenação Motora Grossa</label>
                    <select name="coord_motora_grossa" class="mt-1 w-full px-4 py-2 border rounded-lg text-base">
                        <option value="">Selecione...</option>
                        <option value="Adequada" {{ old('coord_motora_grossa', $item->coord_motora_grossa ?? '') == 'Adequada' ? 'selected' : '' }}>Adequada</option>
                        <option value="Dificuldade Leve" {{ old('coord_motora_grossa', $item->coord_motora_grossa ?? '') == 'Dificuldade Leve' ? 'selected' : '' }}>Dificuldade Leve</option>
                        <option value="Atraso Moderado" {{ old('coord_motora_grossa', $item->coord_motora_grossa ?? '') == 'Atraso Moderado' ? 'selected' : '' }}>Atraso Moderado</option>
                        <option value="Atraso Severo" {{ old('coord_motora_grossa', $item->coord_motora_grossa ?? '') == 'Atraso Severo' ? 'selected' : '' }}>Atraso Severo</option>
                    </select>
                </div>
            </div>

            <h3 class="text-xl font-bold text-green-800 mt-8 mb-4">Desenvolvimento da Linguagem</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Primeiras palavras (idade e quais)</label>
                    <textarea name="primeiras_palavras" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('primeiras_palavras', $item->primeiras_palavras ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Formação de frases (idade e complexidade)</label>
                    <textarea name="formacao_frases" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('formacao_frases', $item->formacao_frases ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Problemas na linguagem (trocas, gagueira, etc.)</label>
                    <textarea name="problemas_linguagem" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('problemas_linguagem', $item->problemas_linguagem ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Compreensão da linguagem</label>
                    <textarea name="compreensao" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('compreensao', $item->compreensao ?? '') }}</textarea>
                </div>
            </div>
        </section>

        ---

        <section class="bg-gradient-to-r from-orange-50 to-amber-50 p-6 sm:p-8 rounded-3xl border-2 border-orange-400">
            <h2 class="text-2xl sm:text-3xl font-bold text-orange-900 mb-6 border-b-2 border-orange-300 pb-3">
                🤝 5. Comportamento e Socialização
            </h2>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium">Relacionamento com outras crianças</label>
                    <select name="relacionamento_criancas" class="mt-1 w-full px-4 py-2 border rounded-lg text-base">
                        <option value="">Selecione...</option>
                        <option value="Facil" {{ old('relacionamento_criancas', $item->relacionamento_criancas ?? '') == 'Facil' ? 'selected' : '' }}>Fácil/Bom</option>
                        <option value="Timidez" {{ old('relacionamento_criancas', $item->relacionamento_criancas ?? '') == 'Timidez' ? 'selected' : '' }}>Tímido/Com Dificuldade</option>
                        <option value="Isolamento" {{ old('relacionamento_criancas', $item->relacionamento_criancas ?? '') == 'Isolamento' ? 'selected' : '' }}>Isolamento/Dificuldade Severa</option>
                        <option value="Agressividade" {{ old('relacionamento_criancas', $item->relacionamento_criancas ?? '') == 'Agressividade' ? 'selected' : '' }}>Com Agressividade</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Relacionamento com adultos</label>
                    <select name="relacionamento_adultos" class="mt-1 w-full px-4 py-2 border rounded-lg text-base">
                        <option value="">Selecione...</option>
                        <option value="Facil" {{ old('relacionamento_adultos', $item->relacionamento_adultos ?? '') == 'Facil' ? 'selected' : '' }}>Fácil/Bom</option>
                        <option value="Timidez" {{ old('relacionamento_adultos', $item->relacionamento_adultos ?? '') == 'Timidez' ? 'selected' : '' }}>Tímido/Com Dificuldade</option>
                        <option value="Desafio" {{ old('relacionamento_adultos', $item->relacionamento_adultos ?? '') == 'Desafio' ? 'selected' : '' }}>Com Desafio/Oposição</option>
                    </select>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 mb-6">
                <div>
                    <p class="text-base font-medium mb-2">Agressividade?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="agressividade" value="Sim" {{ old('agressividade', $item->agressividade ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-orange-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="agressividade" value="Não" {{ old('agressividade', $item->agressividade ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-orange-600"> Não</label>
                    </div>
                </div>
                <div>
                    <p class="text-base font-medium mb-2">Birras frequentes?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="birras" value="Sim" {{ old('birras', $item->birras ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-orange-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="birras" value="Não" {{ old('birras', $item->birras ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-orange-600"> Não</label>
                    </div>
                </div>
                <div>
                    <p class="text-base font-medium mb-2">Desobediência?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="desobediencia" value="Sim" {{ old('desobediencia', $item->desobediencia ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-orange-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="desobediencia" value="Não" {{ old('desobediencia', $item->desobediencia ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-orange-600"> Não</label>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div><label class="block text-sm font-medium">Medos (descreva)</label><textarea name="medos" rows="3" class="mt-1 w-full px-4 py-2 border rounded-lg">{{ old('medos', $item->medos ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Reação a mudanças na rotina/ambiente</label><textarea name="reacao_mudancas" rows="3" class="mt-1 w-full px-4 py-2 border rounded-lg">{{ old('reacao_mudancas', $item->reacao_mudancas ?? '') }}</textarea></div>
            </div>
        </section>

        ---

        <section class="bg-gradient-to-r from-indigo-50 to-blue-50 p-6 sm:p-8 rounded-3xl border-2 border-indigo-400">
            <h2 class="text-2xl sm:text-3xl font-bold text-indigo-900 mb-6 border-b-2 border-indigo-300 pb-3">
                🌙 6. Sono
            </h2>
            <div class="grid md:grid-cols-4 gap-6 mb-6">
                <div>
                    <p class="text-base font-medium mb-2">Dorme bem?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="dorme_bem" value="Sim" {{ old('dorme_bem', $item->dorme_bem ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="dorme_bem" value="Não" {{ old('dorme_bem', $item->dorme_bem ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600"> Não</label>
                    </div>
                </div>
                <div>
                    <p class="text-base font-medium mb-2">Dorme sozinho?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="dorme_sozinho" value="Sim" {{ old('dorme_sozinho', $item->dorme_sozinho ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="dorme_sozinho" value="Não" {{ old('dorme_sozinho', $item->dorme_sozinho ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600"> Não</label>
                    </div>
                </div>
                <div>
                    <p class="text-base font-medium mb-2">Cama individual?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="dorme_em_cama_individual" value="Sim" {{ old('dorme_em_cama_individual', $item->dorme_em_cama_individual ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="dorme_em_cama_individual" value="Não" {{ old('dorme_em_cama_individual', $item->dorme_em_cama_individual ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600"> Não</label>
                    </div>
                </div>
                <div>
                    <p class="text-base font-medium mb-2">Ronca?</p>
                    <div class="flex gap-4">
                        <label class="text-sm"><input type="radio" name="ronca" value="Sim" {{ old('ronca', $item->ronca ?? '') == 'Sim' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600"> Sim</label>
                        <label class="text-sm"><input type="radio" name="ronca" value="Não" {{ old('ronca', $item->ronca ?? '') == 'Não' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600"> Não</label>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div><label class="block font-medium text-sm">Como é o sono? (agitação, despertares, sonambulismo)</label><textarea name="sono_como" rows="3" class="mt-1 w-full px-4 py-2 border rounded-lg">{{ old('sono_como', $item->sono_como ?? '') }}</textarea></div>
                <div><label class="block font-medium text-sm">Hábitos de sono (rituais, objetos de apego, telas)</label><textarea name="habitos_sono" rows="3" class="mt-1 w-full px-4 py-2 border rounded-lg">{{ old('habitos_sono', $item->habitos_sono ?? '') }}</textarea></div>
            </div>
        </section>

        ---

        <section class="bg-gradient-to-r from-rose-50 to-red-50 p-6 sm:p-8 rounded-3xl border-2 border-rose-400">
            <h2 class="text-2xl sm:text-3xl font-bold text-rose-900 mb-6 border-b-2 border-rose-300 pb-3">
                🏥 7. Saúde
            </h2>
            <div class="space-y-4">
                <div><label class="block text-sm font-medium">Doenças crônicas ou atuais</label><textarea name="doencas" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('doencas', $item->doencas ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Alergias</label><textarea name="alergias" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('alergias', $item->alergias ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Convulsões / Desmaios</label><textarea name="convulsoes_desmaios" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('convulsoes_desmaios', $item->convulsoes_desmaios ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Internações</label><textarea name="internacoes" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('internacoes', $item->internacoes ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Medicações em uso</label><textarea name="medicacoes" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('medicacoes', $item->medicacoes ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Cirurgias</label><textarea name="cirurgias" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('cirurgias', $item->cirurgias ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Histórico familiar de transtornos (TDAH, TEA, depressão, etc.)</label><textarea name="historico_familiar_transtornos" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('historico_familiar_transtornos', $item->historico_familiar_transtornos ?? '') }}</textarea></div>
            </div>
        </section>

        ---

        <section class="bg-gradient-to-r from-amber-50 to-orange-50 p-6 sm:p-8 rounded-3xl border-2 border-amber-500">
            <h2 class="text-2xl sm:text-3xl font-bold text-amber-900 mb-6 border-b-2 border-amber-300 pb-3">
                🎨 8. Atividades, Rotina e Outras Informações
            </h2>
            <div class="space-y-4">
                <div><label class="block text-sm font-medium">Brincadeiras preferidas</label><textarea name="brincadeiras_preferidas" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('brincadeiras_preferidas', $item->brincadeiras_preferidas ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Com quem brinca</label><textarea name="com_quem_brinca" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('com_quem_brinca', $item->com_quem_brinca ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Tempo de tela (horas/dia)</label><input type="text" name="tempo_tela_horas" value="{{ old('tempo_tela_horas', $item->tempo_tela_horas ?? '') }}" class="w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium">Pratica esportes / atividades físicas</label><textarea name="pratica_esportes" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('pratica_esportes', $item->pratica_esportes ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Tarefas domésticas / responsabilidades</label><textarea name="tarefas_domesticas" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('tarefas_domesticas', $item->tarefas_domesticas ?? '') }}</textarea></div>

                <h3 class="text-xl font-bold text-amber-800 pt-4">Outras Informações</h3>
                <div><label class="block text-sm font-medium">Traumas (acidentes, perdas, luto)</label><textarea name="traumas" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('traumas', $item->traumas ?? '') }}</textarea></div>
                <div><label class="block text-sm font-medium">Situações de violência (presenciada ou sofrida)</label><textarea name="violencia" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('violencia', $item->violencia ?? '') }}</textarea></div>

                {{-- Corrigido o nome do campo para 'mudancas_recentes' --}}
                <div><label class="block text-sm font-medium">Mudanças recentes na família (mudança de casa, separação, novo irmão)</label><textarea name="mudancas_recentes" rows="2" class="w-full px-4 py-2 border rounded-lg">{{ old('mudancas_recentes', $item->mudancas_recentes ?? '') }}</textarea></div>

                <div><label class="block text-sm font-medium text-lg text-gray-900 mt-4">Observações e Informações Adicionais (Livres)</label><textarea name="outras_informacoes" rows="6" class="w-full px-4 py-3 text-base border-4 border-gray-400 rounded-lg">{{ old('outras_informacoes', $item->outras_informacoes ?? '') }}</textarea></div>
            </div>
        </section>
  <div class="fixed bottom-4 right-4 z-50">
        <button type="submit" id="submitButton" class="px-6 py-3 bg-purple-600 text-white font-bold text-lg rounded-full shadow-2xl hover:bg-purple-700 transition duration-300 transform hover:scale-105 w-60 h-16 flex items-center justify-center">
            {{ isset($item) ? 'Salvar Alterações' : 'Finalizar Anamnese' }}
        </button>
    </div>
    </form>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('anamneseForm');
        
        // Define as mensagens baseadas no estado da variável PHP
        const isEditing = {{ isset($item) ? 'true' : 'false' }};
        
        const titleText = isEditing ? 'Confirmação de Alterações' : 'Finalizar o Registro?';
        const textContent = isEditing 
            ? 'Você confirma que deseja SALVAR as modificações feitas na anamnese?' 
            : 'Ao finalizar, o formulário será enviado. Tem certeza de que todos os dados estão corretos?';
        const confirmButtonText = isEditing ? 'Sim, Salvar' : 'Sim, Finalizar';

        form.addEventListener('submit', function(event) {
            // 1. Interrompe a submissão padrão do formulário
            event.preventDefault(); 
            
            Swal.fire({
                title: titleText,
                text: textContent,
                icon: 'question', // Ícone de pergunta
                showCancelButton: true,
                confirmButtonColor: '#8B5CF6', // Cor roxa do Tailwind (purple-600)
                cancelButtonColor: '#6B7280', // Cor cinza
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                // 2. Se o usuário confirmar (clicar em 'Sim, ...')
                if (result.isConfirmed) {
                    // 3. Força a submissão do formulário
                    form.submit();
                }
            });
        });
    });
</script>
<script>
// Auto-save da anamnese — versão CANTO SUPERIOR DIREITO (a mais clean que existe)
const KEY = `anamnese_${{ $paciente->id }}_{{ $item->id ?? 'nova' }}`;
const form = document.getElementById('anamneseForm');

// === BARRA DISCRETA NO CANTO SUPERIOR DIREITO ===
const barra = document.createElement('div');
Object.assign(barra.style, {
    position: 'fixed',
    top: '86px',
    right: '68px',
    background: 'rgba(239, 248, 255, 1)',
    backdropFilter: 'blur(12px)',
    border: '1px solid #e5e7eb',
    color: '#374151',
    padding: '10px 16px',
    borderRadius: '12px',
    fontSize: '14px',
    fontWeight: '500',
    display: 'none',
    alignItems: 'center',
    gap: '10px',
    zIndex: '9999',
    boxShadow: '0 4px 20px rgba(0,0,0,0.08)',
    transition: 'all 0.3s ease',
    maxWidth: '320px'
});

barra.innerHTML = `
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2">
        <path d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
    </svg>
    <span id="msg">Rascunho carregado</span>
    <button id="descartar" type="button" title="Descartar rascunho" style="
        margin-left: 8px;
        padding: 4px 8px;
        background: #fee2e2;
        color: #991b1b;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        opacity: 0.9;
    ">×</button>
`;

document.body.appendChild(barra);

const msg = barra.querySelector('#msg');
const btnX = barra.querySelector('#descartar');

btnX.onclick = () => {
    if (confirm('Descartar o rascunho e começar do zero?')) {
        localStorage.removeItem(KEY);
        form.reset();
        barra.style.opacity = '0';
        barra.style.transform = 'translateY(-10px)';
        setTimeout(() => barra.style.display = 'none', 300);
    }
};

// Função para mostrar a barra (com auto-hide após 4s)
const mostrar = (texto) => {
    msg.textContent = texto;
    barra.style.display = 'flex';
    barra.style.opacity = '1';
    barra.style.transform = 'translateY(0';

    // Auto-esconde após 4 segundos (mas volta ao digitar)
    clearTimeout(barra.hideTimer);
    barra.hideTimer = setTimeout(() => {
        barra.style.opacity = '0';
        barra.style.transform = 'translateY(-10px)';
        setTimeout(() => barra.style.display = 'none', 300);
    }, 4000);
};

// ===================================
// 1. RESTAURA
document.addEventListener('DOMContentLoaded', () => {
    const salvo = localStorage.getItem(KEY);
    if (!salvo) return;

    let dados;
    try { dados = JSON.parse(salvo); } catch { localStorage.removeItem(KEY); return; }

    if (Date.now() - (dados._timestamp || 0) > 24 * 3600000) {
        localStorage.removeItem(KEY);
        return;
    }

    // Restaura os campos
    Object.keys(dados).forEach(k => {
        if (k === '_timestamp') return;
        form.querySelectorAll(`[name="${k}"]`).forEach(el => {
            if (el.type === 'radio' || el.type === 'checkbox') {
                el.checked = Array.isArray(dados[k]) ? dados[k].includes(el.value) : el.value === dados[k];
            } else el.value = dados[k] ?? '';
        });
    });

    mostrar('Rascunho restaurado');
});

// ===================================
// 2. SALVA automaticamente
let timer;
form.addEventListener('input', () => {
    clearTimeout(timer);
    timer = setTimeout(() => {
        const dados = Object.fromEntries(new FormData(form));
        dados._timestamp = Date.now();
        localStorage.setItem(KEY, JSON.stringify(dados));
        mostrar('Salvo automaticamente');
    }, 1000);
});

// ===================================
// 3.submit → remove tudo
form.addEventListener('submit', () => {
    setTimeout(() => {
        localStorage.removeItem(KEY);
        barra.style.display = 'none';
    }, 1000);
});
</script>
@endpush