<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sessao;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;

class SessaoController extends Controller
{
    // Listar todas as sessões de um paciente
    public function index(Paciente $paciente)
    {
        $sessoes = $paciente->sessoes()
            ->with('registros.profissional', 'profissional')
            ->orderBy('data_sessao', 'desc')
            ->get();

        return view('prontuario.index', compact('paciente', 'sessoes'));
    }

    // Criar nova sessão
    public function store(Request $request, Paciente $paciente)
    {
        $request->validate([
            'data_sessao' => 'required|date',
            'conteudo'    => 'nullable|string',
        ]);

        Sessao::create([
            'paciente_id'     => $paciente->id,
            'profissional_id' => Auth::id(),
            'data_sessao'     => $request->data_sessao,
            'conteudo'        => $request->conteudo,
        ]);

        return redirect()->route('prontuario.index', $paciente->id)
            ->with('success', 'Sessão criada com sucesso!');
    }

    // Mostrar formulário de edição
    public function edit(Sessao $sessao)
    {
        return view('sessoes.edit', compact('sessao'));
    }

    // Atualizar sessão
    public function update(Request $request, Sessao $sessao)
    {
        $request->validate([
            'data_sessao' => 'required|date',
            'conteudo'    => 'nullable|string',
        ]);

        $sessao->update([
            'data_sessao' => $request->data_sessao,
            'conteudo'    => $request->conteudo,
        ]);

        return redirect()->route('prontuario.index', $sessao->paciente_id)
            ->with('success', 'Sessão atualizada com sucesso!');
    }

    // Deletar sessão
    public function destroy(Sessao $sessao)
    {
        $paciente_id = $sessao->paciente_id;
        $sessao->delete();

        return redirect()->route('prontuario.index', $paciente_id)
            ->with('success', 'Sessão excluída com sucesso!');
    }
}
