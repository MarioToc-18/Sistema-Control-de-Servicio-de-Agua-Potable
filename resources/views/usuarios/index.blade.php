@extends('tema.general')

@section('htmlheadertitle', 'Usuarios')

@section('pagestyle')
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
@endsection



@section('headerpage')
    <div class="row">
	    <div class="col-lg-5 col-md-8 col-sm-12">                        
	        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Usuarios</h2>
	        <ul class="breadcrumb">
	            <li class="breadcrumb-item">
	            	<a href="javascript:void(0);"><i class="icon-home"></i></a>
	            </li>                            
	            <li class="breadcrumb-item active">Listado</li>
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
                            <h2>USUARIOS <small>Listado general de usuarios</small> </h2>      
                        </div>
                        <div class="pull-right">
                            <a href="{{route('usuarios.crear')}}" class="btn btn-primary"><i class="fa fa-plus"></i> <span>Nuevo Usuario</span></a>
                        </div>                      
                    </div>
                </div>
                    
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable table-custom" id="listado">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre Completo</th>
                                <th>Telefono</th>
                                <th>Dirección</th>
                                <th>Email</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $registro)
                            <tr>
                                <td>{{$registro->id_usuario}}</td>
                                <td>{{$registro->nombre_completo}}</td>
                                <td>{{$registro->telefono}}</td>
                                <td>{{$registro->direccion}}</td>
                                <td>{{$registro->email}}</td>
                                <td>{{$registro->usuario}}</td>
                                <td>{{$registro->estado}}</td>
                                <td class="text-center">

                                    @if($registro->esta_eliminado)
                                        <form method="POST"
                                            action="{{ route('usuarios.activar', $registro->id_usuario) }}"
                                            style="display: inline"
                                            data-toggle="tooltip" 
                                            title="Activar registro"
                                            >
                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                            <button class="btn btn-info"
                                                style="height: 32px; width: 32px; padding-right: 28px;" 
                                                onclick="return confirm('¿Estas seguro de dar de alta al usuario?')"
                                            ><i class="fa fa-cogs"></i></button>
                                        </form>

                                    @else
                                        <a  href="{{ route('usuarios.editar', $registro->id_usuario) }}"  
                                            class="btn btn-sm btn-success"
                                            data-toggle="tooltip" 
                                            title="Editar Usuario"
                                        >
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        
                                        <form method="POST"
                                            action="{{ route('usuarios.eliminar', $registro->id_usuario) }}"
                                            style="display: inline"
                                            data-toggle="tooltip" 
                                            title="Eliminar registro"
                                            >
                                            {{ csrf_field() }} {{ method_field('DELETE') }}
                                            <button class="btn btn-danger"
                                                style="height: 32px; width: 32px;" 
                                                onclick="return confirm('¿Estás seguro de querer dar de baja el registro?')"
                                            ><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection


@section('pagescript')

	
	<script src="{{asset('alucid/bundles/datatablescripts.bundle.js')}}"></script>
	<script src="{{asset('alucid/vendor/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('alucid/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('alucid/vendor/jquery-datatable/buttons/buttons.colVis.min.js')}}"></script>
	<script src="{{asset('alucid/vendor/jquery-datatable/buttons/buttons.html5.min.js')}}"></script>
	<script src="{{asset('alucid/vendor/jquery-datatable/buttons/buttons.print.min.js')}}"></script>

	<script src="{{asset('alucid/bundles/mainscripts.bundle.js')}}"></script>
	<script>
		
		$('#listado').DataTable({
			"language": {
                url: "{!!  asset('alucid/vendor/jquery-datatable/lang/es.json') !!}"
            }
		});

	</script>
@endsection