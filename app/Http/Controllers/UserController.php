<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Listar todos los usuarios con búsqueda global y filtro por rol
    public function index(Request $request)
    {
        $query = User::query();
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }
        if ($request->filled('busqueda') && $request->filled('filtro')) {
            $campo = $request->filtro;
            $valor = $request->busqueda;
            if ($campo === 'nombre_apellido') {
                $query->where(function ($q) use ($valor) {
                    $q->where('nombre', 'like', "%$valor%")
                        ->orWhere('apellido', 'like', "%$valor%");
                });
            } elseif (in_array($campo, ['dni', 'email', 'telefono'])) {
                $query->where($campo, 'like', "%$valor%");
            }
        }
        $usuarios = $query->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de registro
    public function create()
    {
        return view('usuarios.create');
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'rol' => 'required',
            'password' => 'required|min:6',
        ]);

        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->dni = $request->dni;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->rol = $request->rol;
        $usuario->password = bcrypt($request->password);
        $usuario->activo = 1;
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:users,dni,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'rol' => 'required',
        ]);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->dni = $request->dni;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->rol = $request->rol;
        $usuario->activo = $request->activo;
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }

    // Restablecer contraseña
    public function resetPassword(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $request->validate([
            'password' => 'required|min:6',
        ]);
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        return redirect()->route('usuarios.index')->with('success', 'Contraseña restablecida correctamente');
    }
}
