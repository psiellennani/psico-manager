{{-- resources/views/sessoes/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Nova Sessão - ' . $paciente->nome)

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Cabeçalho -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Nova Sessão</h1>
                    <p class="text-blue-100 text-lg mt-2">
                        {{ $paciente->nome }} 
                        @if(isset($consulta))
                            • {{ $consulta->inicio->format('d/m/Y \à\s H:i') }}
                        @endif
                    </p>
                </div>
                <a href="{{ route('prontuario.index', $paciente) }}" 
                   class="text-blue-100 hover:text-white underline text-sm">
                    ← Voltar ao prontuário
                </a>
            </div>
        </div>

        <div class="p-8">
            @if(session('success'))
                <div class="mb-6 p-5 bg-green-100 border border-green-300 text-green-700 rounded-xl text-center font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('sessoes.store', $paciente) }}" method="POST" class="space-y-8">
                @csrf

                <!-- Data e Hora -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-3">Data e Hora da Sessão</label>
                        <input type="datetime-local" name="data_sessao" required
                               value="{{ old('data_sessao', $dataSessao ?? now()->format('Y-m-d\TH:i')) }}"
                               class="w-full px-5 py-4 text-lg rounded-xl border-2 border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        @error('data_sessao') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Relato da Sessão -->
                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-3">
                        Relato da Sessão
                    </label>
                    <textarea 
                        name="conteudo" 
                        rows="20" 
                        required 
                        placeholder="Descreva tudo o que aconteceu nesta sessão...&#10;Você pode escrever com calma, usar parágrafos, bullet points, etc.&#10;&#10;Exemplo:&#10;- Paciente chegou pontualmente&#10;- Relatou melhora no sono&#10;- Trabalhou técnica de respiração..."
                        class="w-full px-6 py-5 text-lg rounded-xl border-2 border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 resize-none font-medium">{{ old('conteudo') }}</textarea>
                    @error('conteudo') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6 border-t">
                    <a href="{{ route('prontuario.index', $paciente) }}"
                       class="px-8 py-4 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl text-center transition">
                        Cancelar
                    </a>
                    <button type="submit" name="acao" value="salvar_continuar"
                            class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition">
                        Salvar e Continuar Editando
                    </button>
                    <button type="submit" name="acao" value="salvar_finalizar"
                            class="px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition">
                        Salvar e Finalizar Sessão
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection