<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstanciaController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\InformesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

/*Route::get('/admindashboard', [EstanciaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admi.adminDashboard');*/
Route::get('/dashboard', [EstanciaController::class,'index'])->middleware(['auth', 'verified'])->name('adminDashboard');
Route::get('/user_dashboard', [EstanciaController::class,'indexUser'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Usuario admin
    Route::get('/adminInformes', [InformesController::class, 'showInformes'])->name('showInformes');
    Route::get('/showUsers', [EstanciaController::class, 'showUsers'])->name('showUsers');
    Route::get('/historico-convocatorias', [EstanciaController::class, 'historicoEstancias'])->name('historico-convocatorias');
    Route::get('/crear_estancia', [EstanciaController::class, 'create'])->name('crearEstancia');
    Route::get('/ver_solicitudes', [SolicitudesController::class, 'currentRequests'])->name('solicitudes');
    Route::get('/historico_solicitudes', [SolicitudesController::class, 'allRequests'])->name('historico-solicitudes');
    Route::get('/admiShowRequest/{id}', [SolicitudesController::class, 'showRequest'])->name('admiShowRequest');
    Route::post('/aceptar-solicitud/{id}', [SolicitudesController::class, 'aceptarSolicitud'])->name('aceptar-solicitud');
    Route::post('/rechazar-solicitud/{id}', [SolicitudesController::class, 'rechazarSolicitud'])->name('rechazar-solicitud');
    Route::get('/observaciones/{id}', [SolicitudesController::class, 'observaciones'])->name('observaciones');
    Route::post('/enviar-observacion/{id}', [SolicitudesController::class, 'enviarObservacion'])->name('enviar-observacion');
    Route::post('/informes/aceptar/{id}', [InformesController::class, 'aceptar'])->name('aceptar.informe');
    Route::post('/rechazar-informe/{id}', [InformesController::class, 'rechazarInforme'])->name('rechazar.informe');
    Route::get('/informes/upload/{id}', [InformesController::class, 'showUploadForm'])->name('informes.showUploadForm');
    Route::post('/informes/upload/{id}', [InformesController::class, 'uploadConstancia'])->name('informes.uploadConstancia');
    Route::get('/descargar-constancia/{id}', [InformesController::class, 'descargarConstancia'])->name('descargar-constancia');

    Route::post('/guardar-estancia', [EstanciaController::class, 'guardar'])->name('guardar-estancia');
    Route::get('/ver-estancia/{id}', [EstanciaController::class, 'showEstancia'])->name('verEstancia');
    Route::delete('/eliminar-estancia/{id}', [EstanciaController::class, 'eliminar'])->name('eliminar-estancia');
    Route::get('/estancia/{estancia}/edit', [EstanciaController::class, 'edit'])->name('estancia.edit');
    Route::put('/estancia/{estancia}', [EstanciaController::class, 'update'])->name('estancia.update');


    Route::get('/docente/edit/{id}', [DocenteController::class, 'edit'])->name('docente.edit');
    Route::put('/docente/update/{id}', [DocenteController::class, 'update'])->name('docente.update');
    //rutas usuario user
    Route::get('/user-reportes', [DocenteController::class, 'enableInformes'])->name('estanciaAccepted');
    Route::get('/user-solicitudes', [SolicitudesController::class, 'index'])->name('userSolicitudes');
    Route::get('/ver_estancia/{id}', [EstanciaController::class, 'showUserEstancia'])->name('showUserEstancia');
    Route::get('/create_request/{id}', [SolicitudesController::class, 'userCreateSolicitud'])->name('userCreateSolicitud');
    Route::post('/generar-solicitud/{id_estancia}', [SolicitudesController::class, 'generarSolicitud'])->name('generar-solicitud');
    Route::get('/showRequestFiles/{id}', [SolicitudesController::class, 'showRequestFiles'])->name('showRequestFiles');
    Route::put('/user-update-request/{id}', [SolicitudesController::class, 'userUpdateRequest'])->name('userUpdateRequest');
    Route::get('/informesView/{id}', [DocenteController::class, 'verArchivos'])->name('informesView');
    Route::get('/informes/{id}', [DocenteController::class, 'generarInforme'])->name('informes');
    Route::post('/informes/upload', [InformesController::class, 'guardarInformes'])->name('uploadinformes');
});

require __DIR__.'/auth.php';

/*
/*
//migracion

*/


/*
*/
