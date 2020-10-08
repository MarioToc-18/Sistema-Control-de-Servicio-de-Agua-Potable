@extends('tema.general')

@section('htmlheadertitle', 'Beneficiados')

@section('pagestyle')

@endsection



@section('headerpage')
    <div class="row">
	    <div class="col-lg-5 col-md-8 col-sm-12">                        
	        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Beneficiados</h2>
	        <ul class="breadcrumb">
	            <li class="breadcrumb-item">
	            	<a href="javascript:void(0);">Beneficiados</a>
	            </li>                            
	            <li class="breadcrumb-item active">Crear Nuevo</li>
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
                            <h2>BENEFICIADOS <small>Ingrese todos los datos</small> </h2>      
                        </div>
                        <div class="pull-right">
                            <a href="{{route('beneficiados')}}" class="btn btn-secondary"> <i class="icon-arrow-left"></i> <span> Regresar al Listado</span></a>
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
                <form role="form" method="POST" action="{{route('beneficiados.guardar')}}" id="form_guardar" >
                    {{csrf_field()}}

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DPI</label>
                                <input type="text" class="form-control" value="{{old('cui')}}" name="cui" id="cui">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Primer Nombre</label>
                                <input type="text" class="form-control" value="{{old('nombre1')}}" name="nombre1" id="nombre1">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                             <div class="form-group">
                                <label>Segundo Nombre</label>
                                <input type="text" class="form-control" value="{{old('nombre2')}}" name="nombre2" id="nombre2">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        

                        

                        <div class="col-md-4">
                             <div class="form-group">
                                <label>Primer Apellido</label>
                                <input type="text" class="form-control" value="{{old('apellido1')}}" name="apellido1" id="apellido1">
                            </div>
                        </div>

                        <div class="col-md-4">
                             <div class="form-group">
                                <label>Segundo Apellido</label>
                                <input type="text" class="form-control" value="{{old('apellido2')}}" name="apellido2" id="apellido2">
                            </div>
                        </div>
                        
                         <div class="col-md-4">
                             <div class="form-group">
                                <label>Telefono</label>
                                <input type="text" class="form-control" value="{{old('telefono')}}" name="telefono" id="telefono">
                            </div>
                        </div>
                        
                    </div>


                    <div class="row">
                        

                       

                    </div>

                    <div class="row">
                        <div class="col-md-8">
                             <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control" value="{{old('direccion')}}" name="direccion" id="direccion">
                            </div>
                        </div>

                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Beneficiado</button>
                </form>

            </div>
        </div>
    </div>
    
</div>
@endsection


@section('pagescript')

	<script src="{{asset('alucid/bundles/mainscripts.bundle.js')}}"></script>
@endsection