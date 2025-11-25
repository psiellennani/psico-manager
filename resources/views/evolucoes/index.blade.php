@extends('layouts.app')
@section('title', 'Prontuário - ' . $paciente->nome)

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-8">

    <!-- TÍTULO -->
    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Prontuário de {{ $paciente->nome }}
        </h1>
        <p class="text-gray-500">Registro clínico completo</p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-100 border border-green-300 text-green-700 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORM PARA NOVO REGISTRO -->
    <div class="bg-white p-6 rounded-2xl shadow border space-y-6">

        <h2 class="text-lg font-semibold text-gray-700 mb-1">Novo Registro</h2>

        <form action="{{ route('evolucoes.store', $paciente->id) }}" method="POST" class="space-y-6">
            @csrf

            <!-- BOTÕES DE TIPO -->
            <input type="hidden" name="tipo" id="tipoSelecionado" value="evolucao">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

                <button type="button" id="btn-evolucao"
                    onclick="selectTipo('evolucao')"
                    class="tipo-btn p-4 rounded-xl border bg-blue-50 ring-2 ring-blue-400 flex flex-col items-center gap-1 text-blue-700">
                    <span class="font-semibold">Evolução</span>
                </button>

                <button type="button" id="btn-anotacao"
                    onclick="selectTipo('anotacao')"
                    class="tipo-btn p-4 rounded-xl border hover:bg-yellow-50 flex flex-col items-center gap-1">
                    <span class="font-semibold text-gray-700">Anotação</span>
                </button>

                <button type="button" id="btn-interconsulta"
                    onclick="selectTipo('interconsulta')"
                    class="tipo-btn p-4 rounded-xl border hover:bg-purple-50 flex flex-col items-center gap-1">
                    <span class="font-semibold text-gray-700">Interconsulta</span>
                </button>

                <button type="button" id="btn-feedback"
                    onclick="selectTipo('feedback')"
                    class="tipo-btn p-4 rounded-xl border hover:bg-green-50 flex flex-col items-center gap-1">
                    <span class="font-semibold text-gray-700">Feedback</span>
                </button>

            </div>

            <!-- DATA -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Data</label>
                <input type="datetime-local" name="data_registro"
                    class="mt-1 w-full rounded-xl border-gray-300 focus:ring focus:ring-blue-200"
                    value="{{ now()->format('Y-m-d\TH:i') }}">
            </div>

            <!-- CONTEÚDO -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Conteúdo</label>
                <textarea name="conteudo" rows="5"
                    class="mt-1 w-full rounded-xl border-gray-300 focus:ring focus:ring-blue-200"></textarea>
            </div>

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl shadow transition">
                Salvar Registro
            </button>
        </form>
    </div>

    <!-- LISTA DE EVOLUÇÕES -->
    <div class="space-y-4">
        @foreach($evolucoes as $ev)
            <div class="bg-white p-6 rounded-2xl shadow border">

                <!-- HEADER -->
                <div class="flex justify-between items-center">

                    <!-- TIPO COMO TAG -->
                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                        @if($ev->tipo === 'evolucao') bg-blue-100 text-blue-700
                        @elseif($ev->tipo === 'anotacao') bg-yellow-100 text-yellow-700
                        @elseif($ev->tipo === 'interconsulta') bg-purple-100 text-purple-700
                        @elseif($ev->tipo === 'feedback') bg-green-100 text-green-700
                        @endif
                    ">
                        {{ ucfirst($ev->tipo) }}
                    </span>

                    <!-- BOTÕES -->
                    <div class="flex gap-2">
                        <a href="{{ route('evolucoes.edit', $ev->id) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 text-xs">
                            Editar
                        </a>

                        <form method="POST" action="{{ route('evolucoes.destroy', $ev->id) }}">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 text-xs">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>

                <!-- CONTEÚDO -->
                <p class="text-gray-800 mt-3 whitespace-pre-line leading-relaxed">
                    {{ $ev->conteudo }}
                </p>

                <!-- RODAPÉ -->
                <div class="text-xs text-gray-500 mt-3">
                    Registrado em {{ date('d/m/Y H:i', strtotime($ev->data_registro)) }}
                    • por {{ $ev->profissional->name }}
                </div>
            </div>
        @endforeach
    </div>

</div>

<script>
function selectTipo(tipo) {
    document.getElementById("tipoSelecionado").value = tipo;

    document.querySelectorAll(".tipo-btn").forEach(btn => {
        btn.classList.remove("ring-2", "ring-blue-400", "bg-blue-50", "text-blue-700");
    });

    const btn = document.getElementById("btn-" + tipo);
    btn.classList.add("ring-2", "ring-blue-400", "bg-blue-50", "text-blue-700");
}
</script>

@endsection
