{{-- resources/views/prontuario/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Prontuário - ' . $paciente->nome)

@section('content')
<div class="max-w-5xl mx-auto p-6 space-y-8">

    <!-- Cabeçalho + Botão Nova Sessão (agora é LINK) -->
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Prontuário de {{ $paciente->nome }}</h1>
            <p class="text-gray-500 mt-1">Registro clínico completo</p>
            <p class="text-gray-500">Total de sessões: {{ $sessoes->count() }}</p>
        </div>

        <a href="{{ route('sessoes.create', $paciente) }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nova Sessão
        </a>
    </div>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="p-5 bg-green-100 border border-green-300 text-green-700 rounded-xl shadow-sm text-center font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Lista de Sessões -->
    <div class="space-y-8 mt-8">
        @forelse($sessoes as $sessao)
            @include('sessoes.sessao-item', compact('sessao', 'paciente'))
        @empty
            <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
                <p class="text-gray-500 text-lg mb-6">Nenhuma sessão registrada ainda.</p>
                <a href="{{ route('sessoes.create', $paciente) }}"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Criar a primeira sessão
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection