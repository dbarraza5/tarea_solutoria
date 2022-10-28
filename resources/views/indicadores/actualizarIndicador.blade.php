@extends('base', ['titulo' => 'dashboard'])

@section('content')
    <div class="">
        @if(isset($indicador))
            <h1>Actualizar Registro</h1>
        @else
            <h1>Crear Registro</h1>
        @endif

        <br>
        <br>
        <form action="" onsubmit="return false" id="form-indicador" >
            @csrf

            @if(isset($indicador))
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-10">

                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value={{$indicador->id}}>
                    </div>
                </div>
            @endif


            <div class="form-group row">
                <label htmlFor="id_seleccion_objetos"
                       class="col-sm-2 col-form-label">Selección de tipo</label>
                <div class="col-sm-10">
                    <select id="tipo_indicador" name="tipo_indicador" class="form-select" aria-label="seleccione un objeto..." required>
                        <option value="">...</option>

                        @if(isset($indicador))
                            @foreach($tipo_indicador as $tipo)
                                @if($tipo->id == $indicador->tipo_indicador)
                                    <option value={{$tipo->id}} selected="selected">{{$tipo->nombreIndicador}}</option>
                                @else
                                    <option value={{$tipo->id}}>{{$tipo->nombreIndicador}}</option>
                                @endif
                            @endforeach
                        @else
                            @foreach($tipo_indicador as $tipo)
                                <option value={{$tipo->id}}>{{$tipo->nombreIndicador}}</option>
                            @endforeach
                        @endif


                    </select>
                </div>

            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Valor Indicador</label>
                <div class="col-sm-10">
                    @if(isset($indicador))
                        <input type="text" class="form-control" id="valorIndicador" name="valorIndicador" value="{{$indicador->valorIndicador}}" required>
                    @else
                        <input type="text" class="form-control" id="valorIndicador" name="valorIndicador" required>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Fecha Indicador</label>
                <div class="col-sm-10">
                    @if(isset($indicador))
                        <input type="date" class="form-control" id="fechaIndicador" name="fechaIndicador" value="{{$indicador->fechaIndicador}}" required>
                    @else
                        <input type="date" class="form-control" id="fechaIndicador" name="fechaIndicador"  required>
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Tiempo Indicador</label>
                <div class="col-sm-10">
                    @if(isset($indicador))
                        <input type="text" class="form-control" id="tiempoIndicador" name="tiempoIndicador" value="{{$indicador->tiempoIndicador}}">
                    @else
                        <input type="text" class="form-control" id="tiempoIndicador" name="tiempoIndicador">
                    @endif

                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Origen Indicador</label>
                <div class="col-sm-10">
                    @if(isset($indicador))
                        <input type="text" class="form-control" id="origenIndicador" name="origenIndicador" value="{{$indicador->origenIndicador}}">
                    @else
                        <input type="text" class="form-control" id="origenIndicador" name="origenIndicador">
                    @endif

                </div>
            </div>
            <br>
            <div class="form-group row">
                <div  class="col-sm-2 "></div>
                <div class="col-sm-10">
                    @if(isset($indicador))
                        <button onclick="actualizarRgistro({{$indicador->id}})" class="btn btn-primary mb-3">Actualizar</button>
                    @else
                        <button onclick="crearRgistro()" class="btn btn-primary mb-3">Crear</button>
                    @endif

                </div>
            </div>
            <button type="submit" id="agente-submit" hidden>subir</button>'
        </form>
    </div>
@endsection
<script src="{{asset('js/indicadores/indicadores.js')}}"></script>
