<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

// Página principal
Route::get('/', function () {
    return view('home');
});

// Login para padres
Route::get('/login/padres', function () {
    try {
        if (View::exists('login_padres')) {
            return view('login_padres');
        } else {
            Log::error('La vista login_padres no existe.');
            return response()->view('errors.404', ['mensaje' => 'La vista login_padres no existe.'], 404);
        }
    } catch (Exception $e) {
        Log::error('Error al cargar login_padres: ' . $e->getMessage());
        return response()->view('errors.500', ['mensaje' => $e->getMessage()], 500);
    }
});

// Login para estudiantes
Route::get('/login/estudiantes', function () {
    try {
        if (View::exists('login_estudiantes')) {
            return view('login_estudiantes');
        } else {
            Log::error('La vista login_estudiantes no existe.');
            return response()->view('errors.404', ['mensaje' => 'La vista login_estudiantes no existe.'], 404);
        }
    } catch (Exception $e) {
        Log::error('Error al cargar login_estudiantes: ' . $e->getMessage());
        return response()->view('errors.500', ['mensaje' => $e->getMessage()], 500);
    }
});

// Login para docentes
Route::get('/login/docentes', function () {
    try {
        if (View::exists('login_docentes')) {
            return view('login_docentes');
        } else {
            Log::error('La vista login_docentes no existe.');
            return response()->view('errors.404', ['mensaje' => 'La vista login_docentes no existe.'], 404);
        }
    } catch (Exception $e) {
        Log::error('Error al cargar login_docentes: ' . $e->getMessage());
        return response()->view('errors.500', ['mensaje' => $e->getMessage()], 500);
    }
});

// Login para administración
Route::get('/login/administracion', function () {
    try {
        if (View::exists('login_administracion')) {
            return view('login_administracion');
        } else {
            Log::error('La vista login_administracion no existe.');
            return response()->view('errors.404', ['mensaje' => 'La vista login_administracion no existe.'], 404);
        }
    } catch (Exception $e) {
        Log::error('Error al cargar login_administracion: ' . $e->getMessage());
        return response()->view('errors.500', ['mensaje' => $e->getMessage()], 500);
    }
});

Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return '¡Conexión exitosa a la base de datos!';
    } catch (\Exception $e) {
        return 'Error de conexión: ' . $e->getMessage();
    }
});
