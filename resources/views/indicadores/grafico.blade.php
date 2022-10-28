@extends('base', ['titulo' => 'dashboard'])


@section('content')

    <div class="">
        <h1>Gráfico</h1>
        <br>
        <br>
        <div class="row">
            <div class="col-4">
                <form action="" onsubmit="return false" id="form-filtro-grafico" >
                    <div class="form-group row">
                        <label htmlFor="id_seleccion_objetos"
                               class="col-sm-4 col-form-label">Seleccion tipo</label>
                        <div class="col-sm-8">
                            <select id="tipo_indicador" name="tipo_indicador" class="form-select" aria-label="seleccione un objeto..." required>
                                <option value="">...</option>
                                @foreach($tipo_indicador as $tipo)
                                    <option value={{$tipo->id}}>{{$tipo->nombreIndicador}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Fecha Inicio</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio"  required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Fecha Termino</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="fechaTermino" name="fechaTermino"  required>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
                        <div  class="col-sm-4 "></div>
                        <div class="col-sm-8">
                            <button onclick="graficarIndicador()" class="btn btn-primary mb-3">Graficar</button>
                        </div>
                    </div>
                    <button type="submit" id="agente-submit" hidden>subir</button>'
                </form>
            </div>
            <div class="col-8">
                <canvas id="canvas-grafico"></canvas>
            </div>
        </div>
    </div>




@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{asset('js/indicadores/indicadores.js')}}"></script>
