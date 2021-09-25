<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\MysmesController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\UserController;

/** admin */
Route::middleware(['admin'])->group(function () {

    Route::resource('firmas', FirmaController::class, ['only' => [
        'index', 'destroy'
    ]]);

    Route::resource('personas', PersonaController::class, ['only' => [
        'index','destroy'
    ]]);

    Route::resource('proyectos', ProyectoController::class, ['only' => [
        'index','destroy'
    ]]);

    Route::resource('tramites', TramiteController::class, ['only' => [
        'index','destroy'
    ]]);

    Route::resource('expedientes', TramiteController::class, ['only' => [
        'index','destroy'
    ]]);

    Route::resource('usuarios', UserController::class);

});

/** logeados */
Route::middleware(['auth'])->group(function () {

    Route::resource('balances', BalanceController::class,['except' => [
        'irmb'
    ]]);

    Route::resource('presupuestos', PresupuestoController::class,['except' => [
        'irpresup'
    ]]);

    Route::resource('gestiones', GestionController::class,['except' => [
        'irgestion'
    ]]);

    Route::resource('firmas', FirmaController::class, ['except' => [
        'index', 'destroy'
    ]]);
    Route::resource('personas', PersonaController::class, ['except' => [
        'index', 'destroy'
    ]]);

    Route::resource('proyectos', ProyectoController::class, ['except' => [
        'index', 'destroy'
    ]]);

    Route::resource('tramites', TramiteController::class, ['except' => [
        'index', 'destroy','edit'
    ]]);

    Route::resource('expedientes', ExpedienteController::class, ['except' => [
        'index','destroy','edit'
    ]]);

    Route::get('/firmas/index/{idFirma}',[FirmaController::class, 'addapp'])->name('firmas.addapp');

    Route::get('/pymes/mysmes',[FirmaController::class, 'mysmes'])->name('pymes.mysmes');

    Route::get('/personas/socio/{id}', [PersonaController::class, 'irpersona'])->name('personas.irpersona');

    Route::get('/proyectos/proyecto/{id}', [ProyectoController::class, 'irproyecto'])->name('proyectos.irproyecto');

    Route::get('/balances/index/{idFirma}', [BalanceController::class, 'irmb'])->name('balances.irmb');

    Route::get('/presupuestos/index/{idProy}', [PresupuestoController::class, 'irpresup'])->name('presupuestos.irpresup');

    Route::get('/gestiones/index/{idProy}', [GestionController::class, 'irgestion'])->name('gestiones.irgestion');

    Route::get('/tramites.show/{idProy}', [TramiteController::class, 'irtramite'])->name('tramites.show');

    Route::get('/tramites.edit/{idProy}', [TramiteController::class, 'edit'])->name('tramites.edit');

    Route::get('/expedientes.show/{idProy}', [ExpedienteController::class, 'irexpte'])->name('expedientes.show');

    Route::get('/expedientes.edit/{idProy}', [ExpedienteController::class, 'edit'])->name('expedientes.edit');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { return view('dashboard');})
->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
