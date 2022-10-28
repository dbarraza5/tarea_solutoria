@extends('base', ['titulo' => 'dashboard'])

@section('content')
    <div class="">
        <h1>Indicadores Historicos</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">nombreIndicador</th>
                <th scope="col">codigoIndicador</th>
                <th scope="col">unidadMedidaIndicador</th>
                <th scope="col">valorIndicador</th>
                <th scope="col">fechaIndicador</th>
                <th scope="col">tiempoIndicador</th>
                <th scope="col">origenIndicador</th>
                <th scope="col">operaciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($indicadores as $indicador)
                <tr>
                    <th scope="row">{{$indicador->id}}</th>
                    <td>{{$indicador->nombreIndicador}}</td>
                    <td>{{$indicador->codigoIndicador}}</td>
                    <td>{{$indicador->unidadMedidaIndicador}}</td>
                    <td>{{$indicador->valorIndicador}}</td>
                    <td>{{$indicador->fechaIndicador}}</td>
                    <td>{{$indicador->tiempoIndicador}}</td>
                    <td>{{$indicador->origenIndicador}}</td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                            <button type="button" class="btn btn-outline-primary"
                                    onclick="redireccion({{$indicador->id}})">
                                <i class="bi bi-pencil" ></i>
                            </button>
                            <!--button type="button" class="btn btn-outline-primary"><i class="bi bi-files"></i></--button-->
                            <button type="button" class="btn btn-outline-primary"
                                    onclick="eliminarRegistro({{$indicador->id}})">
                                <i class="bi bi-eraser"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{$indicadores->links()}}
    </div>
@endsection
<script src="{{asset('js/indicadores/indicadores.js')}}"></script>
