<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentoController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/', [App\Http\Controllers\InicioController::class, 'index'])->name('inicio');
        Route::get('/manual', [App\Http\Controllers\ManualController::class, 'index'])->name('manual.index');
        Route::get('/manual/{manual}', [App\Http\Controllers\ManualController::class, 'show'])->name('manual.show')->middleware('log.show.route');;
        Route::get('/capsula', [App\Http\Controllers\CapsulaController::class, 'index'])->name('capsula.index');
        Route::get('/capsula/{capsula}', [App\Http\Controllers\CapsulaController::class, 'show'])->name('capsula.show')->middleware('log.show.route');;
        Route::get('/folleto', [App\Http\Controllers\FolletoController::class, 'index'])->name('folleto.index');
        Route::get('/folleto/{folleto}', [App\Http\Controllers\FolletoController::class, 'show'])->name('folleto.show')->middleware('log.show.route');;
        Route::get('/formato', [App\Http\Controllers\FormatoController::class, 'index'])->name('formato.index');
        Route::get('/formato/{formato}', [App\Http\Controllers\FormatoController::class, 'show'])->name('formato.show')->middleware('log.show.route');;
        
        Route::get('/documento', [DocumentoController::class, 'index'])->name('documento.index');
        // Route::get('/documento/{autoridadid}', [DocumentoController::class, 'index'])->name('documento.index');


        Route::get('/documento/{documento}', [App\Http\Controllers\DocumentoController::class, 'show'])->name('documento.show')->middleware('log.show.route');;
        Route::get('/catalogo', [App\Http\Controllers\CatalogoController::class, 'index'])->name('catalogo.index');
        Route::get('/catalogo/{catalogo}', [App\Http\Controllers\CatalogoController::class, 'show'])->name('catalogo.show')->middleware('log.show.route');;
      
        Route::get('/compendio', [App\Http\Controllers\CompendioController::class, 'index'])->name('compendio.index');
      
        Route::get('/compendio/{compendio}', [App\Http\Controllers\CompendioController::class, 'show'])->name('compendio.show')->middleware('log.show.route');;
        
        // Route::post('/compendio/filtrar', [App\Http\Controllers\FiltroCompendioController::class, 'filtrarDatos'])->name('compendio.filtrar');
    
        Route::get('/compendio-filtro', [App\Http\Controllers\FiltroCompendioController::class, 'index'])->name('compendio-filtro.index');
        Route::post('/compendio-filtro', [App\Http\Controllers\FiltroCompendioController::class, 'filtrarDatos'])->name('compendio.filtrar');



        // Route::post('/busqueda', [App\Http\Controllers\BusquedaController::class, 'index'])->name('busqueda.index');

        Route::post('/busqueda', [App\Http\Controllers\BusquedaController::class, 'index'])->name('busqueda.index');
        Route::get('/busqueda', [App\Http\Controllers\BusquedaController::class, 'index'])->name('busqueda.index');
        
        // Route::match(['get', 'post'], '/busqueda', [App\Http\Controllers\BusquedaController::class, 'index'])->name('busqueda.index');

        
        //Estadistica
        Route::post('/registrar-descarga/{tipoDescarga}/{archivoId}', [ App\Http\Controllers\DescargasController::class,'registrarDescarga' ])->name('registrar.descarga');
        Route::post('/estadistica/{filtro}', [App\Http\Controllers\EstadisticaController::class, 'obtenerEstadistica']);
        Route::post('/estadistica/buscar/usuario', [App\Http\Controllers\EstadisticaController::class, 'buscarUsuario']);
        

    });