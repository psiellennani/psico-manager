<div class="flex justify-between items-start gap-4 pb-4 border-b border-gray-200 last:border-0">
    <div class="flex-1">
        <span class="inline-block px-3 py-1.5 text-xs font-bold rounded-full
            @switch($registro->tipo)
                @case('evolucao')       bg-blue-100 text-blue-800
                    @break
                @case('anotacao')       bg-yellow-100 text-yellow-800
                    @break
                @case('interconsulta')  bg-purple-100 text-purple-800
                    @break
                @case('feedback')       bg-green-100 text-green-800
                    @break
                @default                bg-gray-100 text-gray-700
            @endswitch">
            {{ ucfirst($registro->tipo) }}
        </span>

        <p class="mt-2 text-gray-800 whitespace-pre-line leading-relaxed">{{ $registro->conteudo }}</p>

        <p class="text-xs text-gray-500 mt-2">
            {{ $registro->data_registro->format('d/m/Y H:i') }}
            • {{ $registro->profissional->name }}
        </p>
    </div>

    <div class tarifa flex gap-2">
        <a href="{{ route('registros.edit', $registro->id) }}"
           class="px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-medium rounded transition">
            Editar
        </a>
        <form action="{{ route('registros.destroy', $registro->id) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Excluir este registro permanentemente?')"
                    class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded transition">
                Excluir
            </button>
        </form>
    </div>
</div>