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
                            <h2>CONTADORES <small>Listado de contadores asociado a beneficiados</small> </h2>      
                        </div>                    
                    </div>
                </div>
                    
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable table-custom" id="listado">
                        <thead>
                            <tr>
                                <th class="text-center">Ramal</th>
                                <th class="text-center">Número de Contador</th>
                                <th>Nombre Completo</th>
                                <th class="text-center">Telefono</th>
                                <th class="text-center">Número de Recibos</th>
                                <th class="text-center">Número de Pagos Pendientes</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contadores as $registro)
                            <tr>
                                <td class="text-center">{{$registro->rama}}</td>
                                <td class="text-center">{{$registro->contador_format}}</td>
                                <td>{{$registro->beneficiado->nombre_completo}}</td>
                                <td>{{$registro->beneficiado->telefono}}</td>
                                <td class="text-center">{{$registro->recibos->count()}}</td>
                                <td class="text-center">{{$registro->nopagado->count()}}</td>
                                <td class="text-center">
                                    <a  href="{{ route('lecturas.crear', $registro->id_beneficiado_contador) }}"  
                                        class="btn btn-sm btn-info"
                                        data-toggle="tooltip" 
                                        title="Registrar Lectura"
                                    >
                                        <i class="fa fa-plus-square-o"></i>
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Rama</th>
                                <th class="text-center">Número de Contador</th>
                                <th>Nombre Completo</th>
                                <th class="text-center">Telefono</th>
                                <th class="text-center">Número de Recibos</th>
                                <th class="text-center">Número de Pagos Pendientes</th>
                                <th class="text-center">Opciones</th>
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
            }
		});

	</script>
@endsection