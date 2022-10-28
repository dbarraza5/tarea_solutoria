<?php

use App\Http\Controllers\IndicadorController;
use App\Models\UF_Historico;
use App\Models\TipoIndicador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});

Route::prefix('indicadores')->group(function () {
    Route::get('/', [IndicadorController::class, "index"])
        ->name("indicadores");

    Route::get('/crear', [IndicadorController::class, "indexCrear"])
        ->name("crear");

    Route::get('/actualizar/{id}',  [IndicadorController::class, "indexActualizar"])
        ->name("actualizar");

    Route::put('/actualizar', [IndicadorController::class, "actualizarRegistro"])->name("actualizar-put");

    Route::post('/crear',  [IndicadorController::class, "crearRegistro"])->name("crear-put");

    Route::post('/eliminar', [IndicadorController::class, "eliminarRegistro"]);

    Route::get('/grafico', [IndicadorController::class, "indexGrafico"]);

    Route::post('/grafico', [IndicadorController::class, "datosIndicadoresEntreFechas"]);
});

