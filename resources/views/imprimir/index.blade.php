@extends('tema.general')

@section('htmlheadertitle', 'Recibos')

@section('pagestyle')
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">


    <style type="text/css">
        .badge {
            padding: 4px 8px;
            text-transform: uppercase;
            line-height: 12px;
            border: 0px solid !important;
            font-weight: 400;
            border-radius: 10px;
        }
    </style>
@endsection


@section('headerpage')
    <div class="row">
	    <div class="col-lg-5 col-md-8 col-sm-12">                        
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
                            <h2>RECIBOS NO COBRADAS <small>Listado de recibos aun no cancelada</small> </h2>      
                        </div>  
                        <div class="pull-right">
                            <a  href="{{route('imprimir.generar')}}" 
                                target="_blank" 
                                class="btn btn-primary">
                                 <i class="icon-printer"></i>  Imprimir Recibos <span class="badge badge-light">{{ count(Session::get('recibos')) }}</span>
                            </a>
                        </div>                       
                    </div>
                </div>
                    
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable table-custom" id="listado">
                        <thead>
                            <tr>
                                <th class="text-center"># Recibo</th>
                                <th class="text-center">Ramal</th>
                                <th class="text-center"># Contador</th>
                                <th>Nombre del Beneficiado</th>
                                <th class="text-center">Lectura Anterior</th>
                                <th class="text-center">Lectura Actual</th>
                                <th class="text-center">Consumo</th>
                                <th class="text-center">Cuota Pendiente</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recibos as $registro)

                            <tr>
                                <td class="text-center">{{$registro->serie}} {{$registro->numero}}</td>
                                <td>{{$registro->contador->rama}}</td>
                                <td>{{$registro->contador->contador_format}}</td>
                                <td>{{$registro->contador->beneficiado->nombre_completo}}</td>
                                <td>{{number_format($registro->lectura_anterior, 0, '.', ',')}}</td>
                                <td>{{number_format($registro->lectura_actual, 0, '.', ',')}}</td>
                                <td>Q {{number_format($registro->consumo, 2, '.', ',')}}</td>
                                <td>Q {{number_format($registro->cuota_pendiente, 2, '.', ',')}}</td>
                                <td>Q {{number_format($registro->total, 2, '.', ',')}}</td>
                                <td class="text-center">
                                    <a  href="{{ route('imprimir.agregar', $registro->id_recibo) }}"  
                                        class="btn btn-sm btn-warning"
                                        data-toggle="tooltip" 
                                        title="Agregar a la cola"
                                    >
                                        <i class="icon-shuffle"></i>
                                    </a>

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