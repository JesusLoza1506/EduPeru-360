<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Estudiante;
use App\Models\Grado;
use App\Models\AnoEscolar;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    // Listar todas las matrículas
    public function index()
    {
        $matriculas = Matricula::with(['estudiante.usuario', 'grado', 'anoEscolar'])->paginate(20);
        return view('matriculas.index', compact('matriculas'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $estudiantes = Estudiante::with('usuario')->get();
        $grados = Grado::all();
        $anosEscolares = AnoEscolar::all();
        return view('matriculas.create', compact('estudiantes', 'grados', 'anosEscolares'));
    }

    // Guardar nueva matrícula
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grado_id' => 'required|exists:grados,id',
            'ano_escolar_id' => 'required|exists:anos_escolares,id',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|in:Activo,Retirado,Repitente',
        ]);

        Matricula::create($request->all());
        return redirect()->route('matriculas.index')->with('success', 'Matrícula registrada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $matricula = Matricula::findOrFail($id);
        $estudiantes = Estudiante::with('usuario')->get();
        $grados = Grado::all();
        $anosEscolares = AnoEscolar::all();
        return view('matriculas.edit', compact('matricula', 'estudiantes', 'grados', 'anosEscolares'));
    }

    // Actualizar matrícula
    public function update(Request $request, $id)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'grado_id' => 'required|exists:grados,id',
            'ano_escolar_id' => 'required|exists:anos_escolares,id',
            'fecha_matricula' => 'required|date',
            'estado' => 'required|in:Activo,Retirado,Repitente',
        ]);

        $matricula = Matricula::findOrFail($id);
        $matricula->update($request->all());
        return redirect()->route('matriculas.index')->with('success', 'Matrícula actualizada correctamente.');
    }

    // Eliminar matrícula
    public function destroy($id)
    {
        $matricula = Matricula::findOrFail($id);
        $estudiante = $matricula->estudiante;
        if ($estudiante && $estudiante->usuario) {
            $estudiante->usuario->delete();
        }
        $matricula->delete();
        return redirect()->route('matriculas.index')->with('success', 'Matrícula y usuario del estudiante eliminados correctamente.');
    }
}
