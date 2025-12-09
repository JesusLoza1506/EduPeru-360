use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
<?php

namespace App\Http\Controllers;

use App\Models\SolicitudMatricula;
use App\Models\Grado;
use App\Models\AnoEscolar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Matricula;
use App\Models\Estudiante;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// Mostrar detalle de solicitud para revisión

class SolicitudMatriculaController extends Controller
{
    // Listar solicitudes (para el administrador)
    public function index()
    {
        $solicitudes = SolicitudMatricula::with(['padre', 'grado', 'anoEscolar'])->orderByDesc('fecha_solicitud')->paginate(20);
        return view('solicitudes.index', compact('solicitudes'));
    }

    // Formulario para padres (crear solicitud)
    public function create()
    {
        $grados = Grado::all();
        $anosEscolares = AnoEscolar::all();
        // Obtener todas las solicitudes del padre actual con grado, año y matrícula (si existe)
        $misSolicitudes = \App\Models\SolicitudMatricula::with(['grado', 'anoEscolar'])
            ->where('padre_id', Auth::id())
            ->orderByDesc('fecha_solicitud')
            ->get();

        // Para cada solicitud aprobada, buscar la matrícula asociada (por DNI, grado y año)
        foreach ($misSolicitudes as $sol) {
            if ($sol->estado == 'Aprobado') {
                $estudiante = \App\Models\Estudiante::whereHas('usuario', function ($q) use ($sol) {
                    $q->where('dni', $sol->dni_estudiante);
                })->first();
                $matricula = null;
                if ($estudiante) {
                    $matricula = \App\Models\Matricula::where('estudiante_id', $estudiante->id)
                        ->where('grado_id', $sol->grado_id)
                        ->where('ano_escolar_id', $sol->ano_escolar_id)
                        ->first();
                }
                $sol->matricula = $matricula;
            } else {
                $sol->matricula = null;
            }
        }
        return view('solicitudes.create', compact('grados', 'anosEscolares', 'misSolicitudes'));
    }

    // Guardar nueva solicitud
    public function store(Request $request)
    {
        $request->validate([
            'nombre_estudiante' => 'required|string|max:100',
            'apellido_estudiante' => 'required|string|max:100',
            'dni_estudiante' => 'required|digits:8',
            'grado_id' => 'required|exists:grados,id',
            'ano_escolar_id' => 'required|exists:anos_escolares,id',
            'monto_matricula' => 'required|numeric|min:0',
            'monto_mensualidad' => 'required|numeric|min:0',
            'comprobante_yape' => 'required|file|mimes:jpg,jpeg,png|max:5120', // 5MB
            'nro_operacion_yape' => 'required|string|max:50',
        ]);

        // Guardar el archivo de comprobante Yape en Cloudinary
        $comprobanteYapeUrl = null;
        if ($request->hasFile('comprobante_yape')) {
            $file = $request->file('comprobante_yape');
            // Subir a Cloudinary y obtener la URL segura
            $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'comprobantes_yape'
            ]);
            $comprobanteYapeUrl = $uploadedFile->getSecurePath();
        }

        SolicitudMatricula::create([
            'padre_id' => Auth::id(),
            'nombre_estudiante' => $request->nombre_estudiante,
            'apellido_estudiante' => $request->apellido_estudiante,
            'dni_estudiante' => $request->dni_estudiante,
            'grado_id' => $request->grado_id,
            'ano_escolar_id' => $request->ano_escolar_id,
            'fecha_solicitud' => now(),
            'monto_matricula' => $request->monto_matricula,
            'monto_mensualidad' => $request->monto_mensualidad,
            'comprobante_yape' => $comprobanteYapeUrl, // Guardamos la URL de Cloudinary
            'nro_operacion_yape' => $request->nro_operacion_yape,
            'estado' => 'Pendiente',
        ]);

        return redirect()->route('solicitudes.create')->with('success', 'Solicitud registrada. Queda pendiente de revisión.');
    }

    // Validar y aprobar/rechazar (admin)
    public function update(Request $request, $id)
    {
        $solicitud = SolicitudMatricula::findOrFail($id);
        // Solo permitir editar si está pendiente y el padre es el dueño
        if ($solicitud->estado !== 'Pendiente' || $solicitud->padre_id !== Auth::id()) {
            return redirect()->route('solicitudes.create')->with('error', 'Solo puedes editar tus solicitudes pendientes.');
        }
        $request->validate([
            'nombre_estudiante' => 'required|string|max:100',
            'apellido_estudiante' => 'required|string|max:100',
            'dni_estudiante' => 'required|digits:8',
            'grado_id' => 'required|exists:grados,id',
            'ano_escolar_id' => 'required|exists:anos_escolares,id',
            'monto_matricula' => 'required|numeric|min:0',
            'monto_mensualidad' => 'required|numeric|min:0',
            'nro_operacion_yape' => 'required|string|max:50',
            'comprobante_yape' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Si se sube nuevo comprobante, reemplazar en Cloudinary
        $comprobanteYapeUrl = $solicitud->comprobante_yape;
        if ($request->hasFile('comprobante_yape')) {
            $file = $request->file('comprobante_yape');
            $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'comprobantes_yape'
            ]);
            $comprobanteYapeUrl = $uploadedFile->getSecurePath();
        }

        $solicitud->update([
            'nombre_estudiante' => $request->nombre_estudiante,
            'apellido_estudiante' => $request->apellido_estudiante,
            'dni_estudiante' => $request->dni_estudiante,
            'grado_id' => $request->grado_id,
            'ano_escolar_id' => $request->ano_escolar_id,
            'monto_matricula' => $request->monto_matricula,
            'monto_mensualidad' => $request->monto_mensualidad,
            'nro_operacion_yape' => $request->nro_operacion_yape,
            'comprobante_yape' => $comprobanteYapeUrl,
        ]);
        return redirect()->route('solicitudes.create')->with('success', 'Solicitud actualizada correctamente.');
    }

    public function show($id)
    {
        $solicitud = SolicitudMatricula::with(['padre', 'grado', 'anoEscolar'])->findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    // Validar (aprobar/rechazar) solicitud
    public function validar(Request $request, $id)
    {
        $solicitud = SolicitudMatricula::with(['padre', 'grado', 'anoEscolar'])->findOrFail($id);
        $accion = $request->input('accion');
        $observaciones = $request->input('observaciones');

        if ($accion === 'rechazar') {
            $request->validate([
                'observaciones' => 'required|string|min:5',
            ]);
            $solicitud->update([
                'estado' => 'Rechazado',
                'observaciones' => $observaciones,
                'fecha_revision' => now(),
            ]);
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud rechazada correctamente.');
        }

        // APROBAR: crear usuario estudiante, registro en estudiantes, matrícula y relación padre-hijo
        $userEstudiante = \App\Models\User::firstOrCreate(
            [
                'dni' => $solicitud->dni_estudiante,
                'rol' => 'Estudiante',
            ],
            [
                'nombre' => $solicitud->nombre_estudiante,
                'apellido' => $solicitud->apellido_estudiante,
                'email' => $solicitud->dni_estudiante . '@sinemail.com',
                'password' => bcrypt('12345678'), // Contraseña por defecto
                'activo' => true,
            ]
        );
        $estudiante = Estudiante::firstOrCreate([
            'user_id' => $userEstudiante->id
        ]);

        $matricula = Matricula::create([
            'estudiante_id' => $estudiante->id,
            'grado_id' => $solicitud->grado_id,
            'ano_escolar_id' => $solicitud->ano_escolar_id,
            'fecha_matricula' => now(),
            'estado' => 'Activo',
            'ficha_pdf' => null,
        ]);

        $pdf = Pdf::loadView('matriculas.ficha_pdf', [
            'matricula' => $matricula,
            'solicitud' => $solicitud,
            'estudiante' => $estudiante,
            'userEstudiante' => $userEstudiante,
        ]);
        $pdfPath = 'fichas_matricula/matricula_' . $matricula->id . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());
        $matricula->update(['ficha_pdf' => $pdfPath]);

        // Relacionar padre con usuario estudiante
        $padreId = $solicitud->padre_id;
        $estudianteUserId = $userEstudiante->id;
        $existeRelacion = DB::table('padre_hijo')
            ->where('padre_id', $padreId)
            ->where('estudiante_id', $estudianteUserId)
            ->exists();
        if (!$existeRelacion) {
            DB::table('padre_hijo')->insert([
                'padre_id' => $padreId,
                'estudiante_id' => $estudianteUserId,
                'parentesco' => 'Padre/Madre'
            ]);
        }

        // Actualizar solicitud
        $solicitud->update([
            'estado' => 'Aprobado',
            'observaciones' => $observaciones,
            'fecha_revision' => now(),
        ]);

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud aprobada y matrícula generada correctamente.');
    }
    public function destroy($id)
    {
        $solicitud = \App\Models\SolicitudMatricula::findOrFail($id);
        // Solo permitir eliminar si está pendiente
        if ($solicitud->estado === 'Pendiente') {
            $solicitud->delete();
            return redirect()->route('solicitudes.create')->with('success', 'Solicitud eliminada correctamente.');
        }
        return redirect()->route('solicitudes.create')->with('error', 'Solo puedes eliminar solicitudes pendientes.');
    }
    public function edit($id)
    {
        $solicitud = \App\Models\SolicitudMatricula::findOrFail($id);
        // Solo permitir editar si está pendiente
        if ($solicitud->estado === 'Pendiente') {
            $grados = \App\Models\Grado::all();
            $anosEscolares = \App\Models\AnoEscolar::all();
            return view('solicitudes.edit', compact('solicitud', 'grados', 'anosEscolares'));
        }
        return redirect()->route('solicitudes.create')->with('error', 'Solo puedes editar solicitudes pendientes.');
    }
}
