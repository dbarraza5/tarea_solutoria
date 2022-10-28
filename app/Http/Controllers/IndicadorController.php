<?php


namespace App\Http\Controllers;


use App\Models\UF_Historico;
use App\Models\TipoIndicador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class IndicadorController extends Controller
{
    function index(Request $request){
        $query = $request->query();
        if(isset($query["id"])){
            $indicadores = DB::table('uf_historico')
                ->join('tipo_indicador', 'tipo_indicador.id', '=', 'uf_historico.tipo_indicador')
                ->where("uf_historico.id", $query["id"])
                ->select("uf_historico.*",
                    "tipo_indicador.nombreIndicador as nombreIndicador",
                    "tipo_indicador.codigoIndicador as codigoIndicador",
                    "tipo_indicador.unidadMedidaIndicador as unidadMedidaIndicador",
                    "tipo_indicador.id as id_tipo" )
                ->simplePaginate();
        }else{
            $indicadores = DB::table('uf_historico')
                ->join('tipo_indicador', 'tipo_indicador.id', '=', 'uf_historico.tipo_indicador')
                ->select("uf_historico.*",
                    "tipo_indicador.nombreIndicador as nombreIndicador",
                    "tipo_indicador.codigoIndicador as codigoIndicador",
                    "tipo_indicador.unidadMedidaIndicador as unidadMedidaIndicador",
                    "tipo_indicador.id as id_tipo" )
                ->simplePaginate(15);
        }

        return view('indicadores.indicadores')
            ->with("indicadores", $indicadores);
    }

    function indexCrear(){
        $tipo_indicador  = TipoIndicador::all();
        return view('indicadores.actualizarIndicador')
            ->with("tipo_indicador", $tipo_indicador);
    }

    function indexActualizar($id){
        $indicador  = UF_Historico::where("id", $id)->first();
        $tipo_indicador  = TipoIndicador::all();
        return view('indicadores.actualizarIndicador')
            ->with("indicador", $indicador)
            ->with("tipo_indicador", $tipo_indicador);
    }

    function actualizarRegistro(Request $request){
        $data = $request->all();
        $id = $data["id"];
        unset($data["id"]);
        unset($data["_token"]);
        $validator = Validator::make($request->all(), [
            'tipo_indicador' => 'required|numeric',
            'valorIndicador' => 'required|numeric',
            'fechaIndicador' => 'required|date',
        ]);

        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        try{
            UF_Historico::where("id", $id)
                ->update($data);
            return [
                "id"=>$id];
        }
        catch (Illuminate\Database\QueryException $e){
            $error_code = $e->errorInfo[1];
            return $e->errorInfo;
        }
    }

    function crearRegistro(Request $request){
        $data = $request->all();
        unset($data["_token"]);
        $validator = Validator::make($request->all(), [
            'tipo_indicador' => 'required|numeric',
            'valorIndicador' => 'required|numeric',
            'fechaIndicador' => 'required|date',
        ]);

        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        try{
            //$data["id"] = 23233223;
            $uf = UF_Historico::create($data);
            return $uf;
        }
        catch (Illuminate\Database\QueryException $e){
            $error_code = $e->errorInfo;
            return $e->errorInfo;
        }
    }

    function eliminarRegistro(Request $request){
        $id = $request->get("id");
        try{
            UF_Historico::where('id', $id)->first()->delete();
            return $id;
        }
        catch (Illuminate\Database\QueryException $e){
            $error_code = $e->errorInfo[1];
            return $e->errorInfo;
        }
    }

    function indexGrafico(){
        $tipo_indicador  = TipoIndicador::all();
        return view('indicadores.grafico')
            ->with("tipo_indicador", $tipo_indicador);
    }

    function datosIndicadoresEntreFechas(Request $request){
        $tipo_indicador = $request->get("tipo_indicador");
        $fechaInicio = $request->get("fechaInicio");
        $fechaTermino = $request->get("fechaTermino");
        $datos = UF_Historico::where('tipo_indicador', $tipo_indicador)
            ->whereBetween('fechaIndicador', [$fechaInicio, $fechaTermino])->get();
        return $datos->toArray();
    }
}
