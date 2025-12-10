<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCurso;
use App\Models\Curso;
use App\Models\Grado;
use App\Models\User;
use App\Models\AnoEscolar;
use Illuminate\Http\Request;

class AsignacionCursoController extends Controller
{
    public function index()
    {
        $asignaciones = AsignacionCurso::with(['curso', 'grado', 'docente', 'anoEscolar'])->paginate(15);
        return view('asignaciones.index', compact('asignaciones'));
    }

    public function create()
    {
        $cursos = Curso::all();
        $grados = Grado::all();
        $docentes = User::where('rol', 'Docente')->where('activo', 1)->get();
        $anios = AnoEscolar::orderBy('ano', 'desc')->get();
        return view('asignaciones.create', compact('cursos', 'grados', 'docentes', 'anios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'grado_id' => 'required|exists:grados,id',
            'docente_id' => 'required|exists:users,id',
            'ano_escolar_id' => 'required|exists:anos_escolares,id',
        ]);

        // Evitar duplicados por unique key
        $exists = AsignacionCurso::where([
            ['curso_id', $request->curso_id],
            ['grado_id', $request->grado_id],
            ['ano_escolar_id', $request->ano_escolar_id],
        ])->exists();
        if ($exists) {
            return back()->with('error', 'Ya existe una asignación para este curso, grado y año escolar.');
        }

        AsignacionCurso::create($request->all());
        return redirect()->route('asignaciones.index')->with('success', 'Asignación creada correctamente.');
    }

    public function edit($id)
    {
        $asignacion = AsignacionCurso::findOrFail($id);
        $cursos = Curso::all();
        $grados = Grado::all();
        $docentes = User::where('rol', 'Docente')->where('activo', 1)->get();
        $anios = AnoEscolar::orderBy('ano', 'desc')->get();
        return view('asignaciones.edit', compact('asignacion', 'cursos', 'grados', 'docentes', 'anios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'grado_id' => 'required|exists:grados,id',
            'docente_id' => 'required|exists:users,id',
            'ano_escolar_id' => 'required|exists:anos_escolares,id',
        ]);

        $asignacion = AsignacionCurso::findOrFail($id);
        // Evitar duplicados al actualizar
        $exists = AsignacionCurso::where([
            ['curso_id', $request->curso_id],
            ['grado_id', $request->grado_id],
            ['ano_escolar_id', $request->ano_escolar_id],
        ])->where('id', '!=', $id)->exists();
        if ($exists) {
            return back()->with('error', 'Ya existe una asignación para este curso, grado y año escolar.');
        }
        $asignacion->update($request->all());
        return redirect()->route('asignaciones.index')->with('success', 'Asignación actualizada correctamente.');
    }

    public function destroy($id)
    {
        $asignacion = AsignacionCurso::findOrFail($id);
        $asignacion->delete();
        return redirect()->route('asignaciones.index')->with('success', 'Asignación eliminada correctamente.');
    }
}
