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
        Schema::create($this->nombre_tabla_uf, function (Blueprint $table) {
            $table->id();
            $table->string('nombreIndicador');
            $table->string('codigoIndicador');
            $table->string('unidadMedidaIndicador');
            $table->float("valorIndicador");
            $table->date("fechaIndicador");
            $table->string("tiempoIndicador")->nullable();
            $table->string("origenIndicador");
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
            'userName' => 'dbarraza4@outlook.com',
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
            foreach ($data as $registro){
                DB::table($this->nombre_tabla_uf)->insert(
                    $registro
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
