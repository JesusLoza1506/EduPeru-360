<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::orderBy('nombre')->paginate(20);
        return view('materias.index', compact('cursos'));
    }

    public function create()
    {
        return view('materias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'area_curricular' => 'nullable|string|max:100',
        ]);
        Curso::create($request->all());
        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente');
    }

    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        return view('materias.edit', compact('curso'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'area_curricular' => 'nullable|string|max:100',
        ]);
        $curso = Curso::findOrFail($id);
        $curso->update($request->all());
        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente');
    }

    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente');
    }
}
