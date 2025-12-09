<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Estudiante;
use App\Http\Controllers\UserController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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

    $padre = User::where('dni', $dni)
        ->where('rol', 'Padre')
        ->first();

    if ($padre && Hash::check($password, $padre->password)) {
        Auth::login($padre); // Autentica al usuario
        return redirect('/dashboard/padres'); // Redirige al dashboard de padres
    } else {
        return redirect('/login/padres')->withErrors(['dni' => 'DNI o contraseña incorrectos'])->withInput();
    }
});

// Dashboard para padres (protegido y dinámico)
Route::get('/dashboard/padres', function () {
    $padre = Auth::user();
    // DEBUG: Mostrar el ID del padre logueado
    // dd($padre->id);

    // Consulta mejorada: obtener hijos reales del padre logueado
    $hijosDatos = DB::table('padre_hijo')
        ->join('users', 'padre_hijo.estudiante_id', '=', 'users.id')
        ->join('estudiantes', 'users.id', '=', 'estudiantes.user_id')
        ->where('padre_hijo.padre_id', $padre->id)
        ->select('users.id', 'users.nombre', 'users.apellido', 'estudiantes.id as estudiante_id')
        ->get();

    // Selección de hijo (por defecto el primero)
    $hijoSeleccionadoId = request('hijo_id') ?? ($hijosDatos->count() > 0 ? $hijosDatos[0]->estudiante_id : null);
    $hijoSeleccionado = $hijosDatos->firstWhere('estudiante_id', $hijoSeleccionadoId);

    // Obtener matrícula del hijo seleccionado (si existe)
    $matricula = null;
    if ($hijoSeleccionadoId) {
        $matricula = DB::table('matriculas')
            ->where('estudiante_id', $hijoSeleccionadoId)
            ->orderByDesc('created_at')
            ->first();
    }

    return view('Dashboards.padres_dashboard', [
        'hijos' => $hijosDatos,
        'hijoSeleccionado' => $hijoSeleccionado,
        'matricula' => $matricula
    ]);

    // Selección de hijo (por defecto el primero)
    $hijoSeleccionadoId = request('hijo_id') ?? ($hijos->count() > 0 ? $hijos[0]->estudiante_id : null);
    $hijoSeleccionado = $hijos->firstWhere('estudiante_id', $hijoSeleccionadoId);

    // Obtener matrícula del hijo seleccionado (si existe)
    $matricula = null;
    if ($hijoSeleccionadoId) {
        $matricula = DB::table('matriculas')
            ->where('estudiante_id', $hijoSeleccionadoId)
            ->orderByDesc('created_at')
            ->first();
    }

    return view('Dashboards.padres_dashboard', [
        'hijos' => $hijos,
        'hijoSeleccionado' => $hijoSeleccionado,
        'matricula' => $matricula
    ]);
})->middleware('auth');

// Dashboard para estudiantes (protegido)
Route::get('/dashboard/estudiantes', function () {
    return view('Dashboards.estudiantes_dashboard');
})->middleware('auth');

// Login para estudiantes (GET)
Route::get('/login/estudiantes', function () {
    return view('/Logins/login_estudiantes');
});

// Login para estudiantes (POST)
Route::post('/login/estudiantes', function (Illuminate\Http\Request $request) {
    $codigo = $request->input('codigo');
    $password = $request->input('password');

    $estudiante = App\Models\User::where(function ($query) use ($codigo) {
        $query->where('dni', $codigo)
            ->orWhere('email', $codigo);
    })
        ->where('rol', 'Estudiante')
        ->first();

    if ($estudiante && Hash::check($password, $estudiante->password)) {
        Auth::login($estudiante); // Autentica al estudiante
        return redirect('/dashboard/estudiantes'); // Redirige al dashboard de estudiantes
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

// CRUD de matrículas
Route::resource('matriculas', App\Http\Controllers\MatriculaController::class);

// Solicitudes de matrícula
Route::resource('solicitudes', App\Http\Controllers\SolicitudMatriculaController::class);

// Validar solicitud de matrícula (aprobación/rechazo)
Route::post('/solicitudes/{id}/validar', [App\Http\Controllers\SolicitudMatriculaController::class, 'validar'])->name('solicitudes.validar');
// Dashboard para admin (protegido)
Route::get('/dashboard/admin', function () {
    return view('Dashboards.admin_dashboard');
})->middleware('auth');

// Rutas para gestión de usuarios y docentes
Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
    Route::post('/usuarios/{id}/reset-password', [UserController::class, 'resetPassword'])->name('usuarios.resetPassword');
});

Route::get('/cloud-test', function () {
    return response()->json(config('cloudinary.cloud'));
});
