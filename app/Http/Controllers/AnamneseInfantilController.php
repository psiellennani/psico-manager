<?php

namespace App\Http\Controllers;

use App\Models\AnamneseInfantil;
use App\Models\Paciente;
use Illuminate\Http\Request;

class AnamneseInfantilController extends Controller
{
    public function index(Paciente $paciente)
    {
        $anamneses = AnamneseInfantil::where('paciente_id', $paciente->id)->get();
        $item = $anamneses->last(); // null se não tiver

        return view('anamneses_infantis.index', compact('paciente', 'anamneses', 'item'));
    }

    public function create(Paciente $paciente)
    {
        return view('anamneses_infantis.create', compact('paciente'));
    }
    public function store(Request $request, Paciente $paciente)
    {
        $data = $request->all();
        $data['paciente_id'] = $paciente->id;

        AnamneseInfantil::create($data);
        return redirect()
            ->route('anamnese-infantil.index', ['paciente' => $paciente->id])
            ->with('success', 'Anamnese criada com sucesso!');
    }


    public function edit(Paciente $paciente, AnamneseInfantil $anamnese_infantil)
    {
        return view('anamneses_infantis.edit', compact('paciente', 'anamnese_infantil'));
    }

    public function update(Request $request, Paciente $paciente, AnamneseInfantil $anamnese_infantil)
    {
        $data = $request->all();
        $anamnese_infantil->update($data);
        if ($request->has('paciente')) {
            $paciente->update($request->paciente);
        }

        $anamnese_infantil->update($request->except('paciente'));
        return redirect()
            ->route('anamnese-infantil.index', $paciente)
            ->with('success', 'Anamnese atualizada com sucesso!');
    }


    public function destroy(Paciente $paciente, AnamneseInfantil $anamnese_infantil)
    {
        $anamnese_infantil->delete();

        return redirect()
            ->route('pacientes.anamnese-infantil.index', $paciente)
            ->with('success', 'Anamnese excluída');
    }
}
