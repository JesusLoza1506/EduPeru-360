<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    // Listar todos los grados
    public function index()
    {
        $grados = Grado::orderBy('nivel')->orderBy('grado')->orderBy('seccion')->paginate(20);
        return view('grados.index', compact('grados'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('grados.create');
    }

    // Guardar nuevo grado
    public function store(Request $request)
    {
        $request->validate([
            'nivel' => 'required|in:Primaria,Secundaria',
            'grado' => 'required|integer|min:1',
            'seccion' => 'required|string|max:1',
            'capacidad' => 'required|integer|min:1',
        ]);
        Grado::create($request->all());
        return redirect()->route('grados.index')->with('success', 'Grado creado correctamente');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $grado = Grado::findOrFail($id);
        return view('grados.edit', compact('grado'));
    }

    // Actualizar grado
    public function update(Request $request, $id)
    {
        $request->validate([
            'nivel' => 'required|in:Primaria,Secundaria',
            'grado' => 'required|integer|min:1',
            'seccion' => 'required|string|max:1',
            'capacidad' => 'required|integer|min:1',
        ]);
        $grado = Grado::findOrFail($id);
        $grado->update($request->all());
        return redirect()->route('grados.index')->with('success', 'Grado actualizado correctamente');
    }

    // Eliminar grado
    public function destroy($id)
    {
        $grado = Grado::findOrFail($id);
        $grado->delete();
        return redirect()->route('grados.index')->with('success', 'Grado eliminado correctamente');
    }
}
