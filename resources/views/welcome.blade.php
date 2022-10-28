@extends('base', ['titulo' => 'dashboard'])


@section('content')

    <div class="">
        <h1>Indicadores históricos</h1>
        <br>
        <br>
        <div class="row">
            <div class="btn-group-vertical">
                <button class="btn btn-outline-dark"
                        onclick=redireccion("{{asset('indicadores/crear')}}")>
                    Crear Registro de un Indicador</button>
                <button class="btn btn-outline-dark"
                        onclick=redireccion("{{asset('indicadores')}}")>Gestión de Indicadores</button>
                <button class="btn btn-outline-dark"
                        onclick=redireccion("{{asset('indicadores/grafico')}}")>Gráfico de Indicadores</button>
            </div>


        </div>
    </div>
    <script>
        function redireccion(url){
            window.location.href=url
        }
    </script>


@endsection
