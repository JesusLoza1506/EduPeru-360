<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

// Página principal
Route::get('/', function () {
    return view('home');
});

// Login para padres (GET)
Route::get('/login/padres', function () {
    return view('/Logins/login_padres');
});

// Login para padres (POST)
Route::post('/login/padres', function (Illuminate\Http\Request $request) {
    $dni = $request->input('dni');
    $password = $request->input('password');

    $padre = DB::table('users')
        ->where('dni', $dni)
        ->where('rol', 'Padre')
        ->first();

    if ($padre && Hash::check($password, $padre->password)) {
        // Autenticación exitosa, mostrar vista exclusiva para padres
        return view('/Dashboards/padres_dashboard');
    } else {
        // Error de autenticación
        return redirect('/login/padres')->withErrors(['dni' => 'DNI o contraseña incorrectos'])->withInput();
    }
});

// Login para estudiantes (GET)
Route::get('/login/estudiantes', function () {
    return view('/Logins/login_estudiantes');
});

// Login para estudiantes (POST)
Route::post('/login/estudiantes', function (Illuminate\Http\Request $request) {
    $codigo = $request->input('codigo');
    $password = $request->input('password');

    $estudiante = DB::table('users')
        ->where(function ($query) use ($codigo) {
            $query->where('dni', $codigo)
                ->orWhere('email', $codigo);
        })
        ->where('rol', 'Estudiante')
        ->first();

    if ($estudiante && Hash::check($password, $estudiante->password)) {
        return view('/Dashboards/estudiantes_dashboard');
    } else {
        return redirect('/login/estudiantes')->withErrors(['codigo' => 'Código/DNI o contraseña incorrectos'])->withInput();
    }
});

// Login para docentes (GET)
Route::get('/login/docentes', function () {
    return view('/Logins/login_docentes');
});

// Login para docentes (POST)
Route::post('/login/docentes', function (Illuminate\Http\Request $request) {
    $dni = $request->input('dni');
    $password = $request->input('password');

    $docente = DB::table('users')
        ->where('dni', $dni)
        ->where('rol', 'Docente')
        ->first();

    if ($docente && Hash::check($password, $docente->password)) {
        return view('/Dashboards/docentes_dashboard');
    } else {
        return redirect('/login/docentes')->withErrors(['dni' => 'DNI o contraseña incorrectos'])->withInput();
    }
});

// Login para administración (GET)
Route::get('/login/administracion', function () {
    return view('/Logins/login_administracion');
});

// Login para administración (POST)
Route::post('/login/admin', function (Illuminate\Http\Request $request) {
    $usuario = $request->input('usuario');
    $password = $request->input('password');

    $admin = DB::table('users')
        ->where(function ($query) use ($usuario) {
            $query->where('dni', $usuario)
                ->orWhere('email', $usuario);
        })
        ->where('rol', 'Administrador General')
        ->first();

    if ($admin && Hash::check($password, $admin->password)) {
        return view('/Dashboards/admin_dashboard');
    } else {
        return redirect('/login/administracion')->withErrors(['usuario' => 'Usuario/DNI o contraseña incorrectos'])->withInput();
    }
});
Route::get('/hash-demo', function () {
    $passwords = [
        'admin123',
        'padre123',
        'estudiante123',
        'docente123'
    ];
    $hashes = [];
    foreach ($passwords as $pass) {
        $hashes[$pass] = bcrypt($pass);
    }
    return response()->json($hashes);
});

Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return '¡Conexión exitosa a la base de datos!';
    } catch (\Exception $e) {
        return 'Error de conexión: ' . $e->getMessage();
    }
});
