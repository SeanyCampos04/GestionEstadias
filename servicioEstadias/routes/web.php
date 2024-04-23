<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstanciaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admi.adminDashboard');
})->middleware(['auth', 'verified'])->name('adminDashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Usuario admin
    Route::get('/crear_estancia', [EstanciaController::class, 'create'])->name('crearEstancia');
    Route::get('/ver_solicitudes', [EstanciaController::class, 'showSolicitudes'])->name('solicitudes');
    Route::get('/historico_solicitudes', [EstanciaController::class, 'historicoSolicitudes'])->name('historico-solicitudes');

});

require __DIR__.'/auth.php';
