<?php

use App\Models\UF_Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;



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


Route::get('/indicadores', function () {
    $indicadores  = UF_Historico::simplePaginate(15);
    return view('indicadores.indicadores')->with("indicadores", $indicadores);
})->name("indicadores");

Route::get('/actualizar/{id}', function ($id) {
    $indicador  = UF_Historico::where("id", $id)->first();
    return view('indicadores.actualizarIndicador')->with("indicador", $indicador);
})->name("actualizar");

Route::post('/eliminar', function (Request $request) {

    $id = $request->get("id");
    UF_Historico::where('id', $id)->delete();
    /*try{
        UF_Historico::where('id', $id)->delete();
        return [12];
    }
    catch (Illuminate\Database\QueryException $e){
        $error_code = $e->errorInfo[1];
        return $e->errorInfo;

    }*/
    //return redirect()->route("indicadores");
    return $id;
});
