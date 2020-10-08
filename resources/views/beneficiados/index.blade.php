@extends('tema.general')

@section('htmlheadertitle', 'Beneficiados')

@section('pagestyle')
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
@endsection



@section('headerpage')
    <div class="row">
	    <div class="col-lg-5 col-md-8 col-sm-12">                        
	        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Beneficiados</h2>
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
                            <h2>BENEFICIADOS <small>Listado general de beneficiados</small> </h2>      
                        </div>
                        <div class="pull-right">
                            <a href="{{route('beneficiados.crear')}}" class="btn btn-primary"><i class="fa fa-plus"></i> <span>Nuevo Beneficiado</span></a>
                        </div>                      
                    </div>
                </div>
                    
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable table-custom" id="listado">
                        <thead>
                            <tr>
                                <th>Ramal</th>
                                <th>Número de Contador</th>
                                <th>Nombre Completo</th>
                                <th>Telefono</th>
                                <th>Dirección</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beneficiados as $registro)
                            <tr>
                                <td class="text-center">{{$registro->rama}}</td>
                                <td class="text-center">{{$registro->numero_contador}}</td>
                                <td>{{$registro->nombre_completo}}</td>
                                <td>{{$registro->telefono}}</td>
                                <td>{{$registro->direccion}}</td>
                                <td class="text-center">
                                    <a  href="{{ route('beneficiados.editar', $registro->id_beneficiado) }}"  
                                        class="btn btn-sm btn-success"
                                        data-toggle="tooltip" 
                                        title="Editar Beneficiado"
                                    >
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    
                                    <a  href="{{ route('contador.crear', $registro->id_beneficiado) }}"  
                                        class="btn btn-sm btn-primary"
                                        data-toggle="tooltip" 
                                        title="Asignar Contador Nuevo"
                                    >
                                        <i class="fa fa-tint"></i>
                                    </a>

                                    <form method="POST"
                                        action="{{ route('beneficiados.eliminar', $registro->id_beneficiado) }}"
                                        style="display: inline"
                                        data-toggle="tooltip" 
                                        title="Eliminar registro"
                                        >
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button class="btn btn-danger"
                                            style="height: 32px; width: 32px;" 
                                            onclick="return confirm('¿Estás seguro de querer eliminar el registro?')"
                                        ><i class="fa fa-trash-o"></i></button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Rama</th>
                                <th>Número de Contador</th>
                                <th>Nombre Completo</th>
                                <th>Telefono</th>
                                <th>Dirección</th>
                                <th>Opciones</td>
                            </tr>
                        </tfoot>
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
            },
            "order": [[ 0, "desc" ], [ 1, "desc" ], [ 2, "asc" ]]

		});

	</script>
@endsection