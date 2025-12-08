<div x-data="registroForm()" class="p-4 sm:p-6">
    <form id="registroForm" action="{{ route('registros.store', [$sessao->paciente_id, $sessao->id]) }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="sessao_id" value="{{ $sessao->id }}">

        <!-- Seleção de tipo -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
            @foreach(\App\Models\Registro::$tipos as $t)
                <label class="cursor-pointer group">
                    <input type="radio" name="tipo" value="{{ $t }}" x-model="tipo" class="hidden">
                    <div @click="tipo = '{{ $t }}'; $nextTick(() => $refs.texto.focus())"
                         :class="tipo === '{{ $t }}' ? activeClasses('{{ $t }}') : inactiveClasses()"
                         class="flex flex-col items-center justify-center gap-2 p-3 sm:p-4 rounded-xl border-2 transition-all hover:scale-[1.01] hover:shadow-md">
                        <span x-html="icone('{{ $t }}')" class="w-6 h-6 sm:w-7 sm:h-7"></span>
                        <span style="font-size: 10px !important; line-height: 1 !important; display: block !important;"
                              class="font-bold text-center truncate w-full sm:text-[9px] md:text-[10px] lg:text-xs">
                            {{ ucfirst(str_replace('_', ' ', $t)) }}
                        </span>
                    </div>
                </label>
            @endforeach
        </div>

        <!-- Texto -->
        <div x-transition x-show="tipo">
            <textarea x-ref="texto" name="conteudo" rows="3" required placeholder="Descreva o registro da sessão..."
                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 text-sm resize-none"></textarea>
        </div>

        <!-- Botão com loading imediato -->
        <button type="submit" x-show="tipo"
                @click.prevent="
                    Swal.fire({title:'Salvando...',allowOutsideClick:false,allowEscapeKey:false,didOpen:()=>Swal.showLoading()});
                    $el.closest('form').submit();
                "
                class="w-full py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold flex items-center justify-center gap-3 shadow-md hover:shadow-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Adicionar Registro
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('registroForm', () => ({
            tipo: '',
            icone(t) {
                const i = {
                    evolucao: '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                    anotacao: '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M4 4h16v12H5.17L4 18.83V4m5-2h6a2 2 0 012 2v10a2 2 0 01-2 2H9l-4 4v-4H5a2 2 0 01-2-2V6a2 2 0 012-2h4z"/></svg>',
                    interconsulta: '<svg fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a1 1 0 100 2 3 3 0 013 3 1 1 0 102 0 5 5 0 00-5-5zm0 8a1 1 0 100 2 1 1 0 000-2z"/></svg>',
                    feedback: '<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 10-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414L10 10.586 8.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>'
                };
                return i[t] || '';
            },
            activeClasses(t) {
                const c = {
                    evolucao: 'bg-blue-50 border-blue-400 text-blue-700 shadow-lg shadow-blue-100',
                    anotacao: 'bg-amber-50 border-amber-400 text-amber-700 shadow-lg shadow-amber-100',
                    interconsulta: 'bg-purple-50 border-purple-400 text-purple-700 shadow-lg shadow-purple-100',
                    feedback: 'bg-green-50 border-green-400 text-green-700 shadow-lg shadow-green-100',
                };
                return `${c[t] || c.feedback} ring-4 ring-white`;
            },
            inactiveClasses() { return 'bg-gray-50 border-gray-200 text-gray-500 hover:border-gray-300 hover:bg-gray-100'; }
        }));
    });
</script>