@extends('layouts.app')
@section('title', 'Prontuário - ' . $paciente->nome)

@section('content')
<div class="max-w-5xl mx-auto p-6"
     x-data="{ modalAberto: {{ session()->pull('abrir_modal_sessao') ? 'true' : 'false' }} }">

    <!-- Cabeçalho -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Prontuário de {{ $paciente->nome }}</h1>
            <p class="text-gray-600 mt-1">Total de sessões: <span class="font-semibold">{{ $sessoes->count() }}</span></p>
        </div>

        <button @click="modalAberto = true"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg transition">
            Nova Sessão
        </button>
    </div>

    <!-- Mensagem de sucesso ou aviso -->
    @if(session('success'))
    <div class="mb-6 p-5 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('warning'))
    <div class="mb-6 p-5 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-xl">
        {{ session('warning') }}
    </div>
    @endif

    <!-- Lista de sessões -->
    <div id="lista-sessoes" class="space-y-8">
        @forelse($sessoes as $sessao)
        @include('sessoes.sessao-item', compact('sessao', 'paciente'))
        @empty
        <div class="text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
            <p class="text-gray-500 text-lg mb-6">Nenhuma sessão registrada ainda.</p>
            <button @click="modalAberto = true"
                class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition">
                Criar a primeira sessão
            </button>
        </div>
        @endforelse
    </div>
    
@include('sessoes.modal-create')
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection