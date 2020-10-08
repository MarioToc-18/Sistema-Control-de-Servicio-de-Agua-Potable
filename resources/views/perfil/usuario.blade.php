@extends('tema.general')

@section('htmlheadertitle', 'Perfil')

@section('pagestyle')

@endsection



@section('headerpage')
    <div class="row">
	    <div class="col-lg-5 col-md-8 col-sm-12">                        
	        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Perfil</h2>
	        <ul class="breadcrumb">
	            <li class="breadcrumb-item">
	            	<a href="javascript:void(0);">Perfil</a>
	            </li>                            
	            <li class="breadcrumb-item active">Editar Usuario</li>
	        </ul>
	    </div> 
        
	</div>
@endsection

@section('pagecontent')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <h2>PERFIL <small>Ingrese todos los datos</small> </h2>      
                        </div>
                        <div class="pull-right">
                            
                        </div>                      
                    </div>
                </div>
                    
            </div>
            <div class="body">
                    <div class="row">   
                        <div class="col-md-12">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Corregir los siguientes campos:<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                        </div>
                    </div>
                <form role="form" method="POST" action="{{route('perfil.actualizar.usuario', $registro->id_usuario)}}" >
                    {{csrf_field()}} {{ method_field('PUT') }}
                    <label class="text-primary">USUARIO DEL SISTEMA</label>
                    <hr>
                    <div class="row">
                        <div class="col-md-8">
                             <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" class="form-control" value="{{old('usuario', $registro->usuario)}}" name="usuario" id="usuario">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                             <div class="form-group">
                                <label>Contraseña <small class="text-info">Dejar en blanco si no desea cambiar la contraseña</small></label>
                                <input type="password" class="form-control" value="{{old('password')}}" name="password" id="password">
                            </div>
                        </div>
                        <div class="col-md-8">
                             <div class="form-group">
                                <label>Repite su Contraseña</label>
                                <input type="password" class="form-control" value="{{old('password_confirmation')}}" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>
                    </div>



                    <br>
                    <div class="row">
                        <div class="col-md-8">
                            
                        <button style="margin-left: 20px;" type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Actualizar Usuario</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
</div>
@endsection


@section('pagescript')

	<script src="{{asset('alucid/bundles/mainscripts.bundle.js')}}"></script>
@endsection