@extends('tema.general')

@section('htmlheadertitle', 'Recibos')

@section('pagestyle')
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('alucid/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
@endsection



@section('headerpage')
    <div class="row">
	    <div class="col-lg-5 col-md-8 col-sm-12">                        
	        <ul class="breadcrumb">
	            <li class="breadcrumb-item">
	            	<a href="javascript:void(0);"><i class="icon-home"></i></a>
	            </li>                            
	            <li class="breadcrumb-item active">Listado Recibos Cobrados</li>
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
                            <h2>RECIBOS COBRADOS <small>Listado de recibos cobrados</small> </h2>      
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
                                <th class="text-center">Fecha de Cobro</th>
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
                                <td>{{Carbon\Carbon::parse($registro->fecha_efectiva)->format('d/m/Y')}}</td>
                                <td>Q {{number_format($registro->total, 2, '.', ',')}}</td>
                                <td class="text-center">
                                    <a  href="{{route('recibos.imprimir', $registro->id_recibo)}}"  
                                        class="btn btn-sm btn-warning"
                                        target="_blank" 
                                        data-toggle="tooltip" 
                                        title="Imprimir Recibo"
                                    >
                                        <i class="icon-printer"></i>
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