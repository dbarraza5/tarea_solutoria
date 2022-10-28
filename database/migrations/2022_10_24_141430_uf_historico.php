<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class UfHistorico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $nombre_tabla_uf = "uf_historico";
    private $nombre_tabla_tipo_indicador = "tipo_indicador";

    public function up()
    {
        Schema::dropIfExists($this->nombre_tabla_tipo_indicador);
        Schema::dropIfExists($this->nombre_tabla_uf);

        Schema::create($this->nombre_tabla_uf, function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_indicador');
            $table->float("valorIndicador");
            $table->date("fechaIndicador");
            $table->string("tiempoIndicador")->nullable();
            $table->string("origenIndicador")->nullable();
            $table->timestamps();
        });


        Schema::create($this->nombre_tabla_tipo_indicador, function (Blueprint $table) {
            $table->id();
            $table->string('nombreIndicador');
            $table->string('codigoIndicador');
            $table->string('unidadMedidaIndicador');
            $table->timestamps();
        });

        $response = Http::post('https://postulaciones.solutoria.cl/api/acceso', [
            'userName' => env("USUARIO_SOLUTORIA"),
            'flagJson' => true,
        ]);
        if($response->ok()){
            $acceso =$response->json();
            $token = $acceso["token"];
            $fecha_expiracion = $acceso["expiracion"];

            $response_db = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get("https://postulaciones.solutoria.cl/api/indicadores");

            $data = $response_db->json();

            //creando el conjunto de indicadores para una tabla
            $conjunto_indicadores = array_unique(array_map(function ($row){
                return $row["codigoIndicador"];
            }, $data));

            $conjunto_indicadores = [];
            $datos_indicadores = [];
            $contador = 1;
            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
                $codigo = $row["codigoIndicador"];
                $aux_araay = array_map(function ($e) {
                    return $e["codigoIndicador"];
                }, array_values($conjunto_indicadores));
                if (!in_array($codigo, $aux_araay)) {
                    $conjunto_indicadores[$codigo] = [
                        "id" => $contador,
                        "nombreIndicador" => $row["nombreIndicador"],
                        "codigoIndicador" => $row["codigoIndicador"],
                        "unidadMedidaIndicador" => $row["unidadMedidaIndicador"]
                    ];
                    $contador++;
                }

                array_push($datos_indicadores, [
                    "id" => $row["id"],
                    "tipo_indicador" => $conjunto_indicadores[$codigo]["id"],
                    "valorIndicador" => $row["valorIndicador"],
                    "fechaIndicador" => $row["fechaIndicador"],
                    "tiempoIndicador"=> $row["tiempoIndicador"],
                    "origenIndicador"=> $row["origenIndicador"]
                ]);
            }
            foreach ($datos_indicadores as $registro){
                DB::table($this->nombre_tabla_uf)->insert(
                    $registro
                );
            }

            foreach ($conjunto_indicadores as $key => $value){
                DB::table($this->nombre_tabla_tipo_indicador)->insert(
                    $value
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('uf_historico');
    }
}
