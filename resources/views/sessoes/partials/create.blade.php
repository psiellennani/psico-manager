{{-- resources/views/sessoes/partials/create.blade.php --}}
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
                        @if(session('data_sessao'))
                            • {{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', session('data_sessao'))->format('d/m/Y \à\s H:i') }}
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

                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-3">Data e Hora da Sessão</label>
                    <input type="datetime-local" name="data_sessao" required
                           value="{{ old('data_sessao', session('data_sessao', now()->format('Y-m-d\TH:i'))) }}"
                           class="w-full px-5 py-4 text-lg rounded-xl border-2 border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                </div>

                <div>
                    <label class="block text-lg font-semibold text-gray-700 mb-3">Relato da Sessão</label>
                    <textarea name="conteudo" rows="22" required 
                              placeholder="Escreva com calma tudo o que aconteceu na sessão..."
                              class="w-full px-6 py-5 text-lg rounded-xl border-2 border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 resize-none font-medium">{{ old('conteudo') }}</textarea>
                </div>

                <div class="flex flex-wrap gap-4 justify-end pt-8 border-t">
                    <a href="{{ route('prontuario.index', $paciente) }}"
                       class="px-8 py-4 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition">
                        Cancelar
                    </a>
                    <button type="submit" name="acao" value="salvar_continuar"
                            class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition">
                        Salvar e Continuar
                    </button>
                    <button type="submit" name="acao" value="salvar_finalizar"
                            class="px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition">
                        Salvar e Finalizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection