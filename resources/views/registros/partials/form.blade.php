<form action="{{ route('registros.store', $paciente->id) }}" method="POST" class="space-y-4">
    @csrf
    <input type="hidden" name="sessao_id" value="{{ $sessao->id }}">

    <div class="flex flex-wrap gap-2">
        @foreach(\App\Models\Registro::$tipos as $tipo)
            <button type="button"
                    onclick="document.getElementById('tipo-{{ $sessao->id }}').value='{{ $tipo }}';
                             this.closest('div').querySelectorAll('button').forEach(b=>b.classList.remove('ring-2','ring-blue-600','bg-blue-50'));
                             this.classList.add('ring-2','ring-blue-600','bg-blue-50');"
                    class="px-4 py-2 text-xs font-medium rounded-full border transition {{ $loop->first ? 'ring-2 ring-blue-600 bg-blue-50' : 'hover:bg-gray-200' }}">
                {{ ucfirst($tipo) }}
            </button>
        @endforeach
    </div>

    <input type="hidden" id="tipo-{{ $sessao->id }}" name="tipo" value="evolucao">

    <textarea name="conteudo" rows="3" required placeholder="Digite o registro..."
              class="w-full px-4 py-3 rounded-xl border focus:ring-2 focus:ring-blue-500"></textarea>

    <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition">
        Adicionar Registro
    </button>
</form>