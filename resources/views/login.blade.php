@extends('tema.login')

@section('htmlheadertitle', 'Login')

@section('content')
    <div class="vertical-align-middle auth-main">
        <div class="auth-box" style="padding-top: 0px;">
            <div class="top">
                <img src="{{ asset('alucid/img/logo.png') }}" alt="Sisap">
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <p>Corregir los siguientes campos:</p><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="header">
                    <p class="lead">Entrar al sistema</p>
                </div>
                <div class="body">
                    <form method="POST" class="form-auth-small" action="{{ route('verificar') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="usuario" class="control-label sr-only">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label sr-only">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                        </div>
                        <div class="form-group clearfix">
                                                         
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fa fa-sign-in" aria-hidden="true"></i> Entrar
                        </button>
                        <div class="bottom">
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('pagescript')
@endsection