@extends('base', ['titulo' => 'dashboard'])

@section('content')
    <div class="container-xxl">
        <h1>Actualizar Registro</h1>
        <br>
        <br>
        <form method="POST" action="/">
            @csrf
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value={{$indicador->id}}>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
            </div>
        </form>
    </div>
@endsection
<script src="{{asset('js/indicadores/indicadores.js')}}"></script>
