@extends('tema.general')

@section('htmlheadertitle', 'Beneficiados')

@section('pagestyle')
    <link rel="stylesheet" href="{{ asset('alucid/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
@endsection



@section('headerpage')
    <div class="row">
	    <div class="col-lg-5 col-md-8 col-sm-12">                        
	        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Beneficiados</h2>
	        <ul class="breadcrumb">
	            <li class="breadcrumb-item">
	            	<a href="javascript:void(0);">Beneficiados</a>
	            </li>                            
	            <li class="breadcrumb-item active">Asignar Contador</li>
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
                            <h2 style="font-size: 20px" class="text-primary text-uppercase">{{$registro->nit}} - {{ $registro->nombre_completo}} -</h2> 
                            <h2>REGISTRO DE CONTADOR NUEVO AL BENEFICIADO:</h2>      
                        </div>
                        <div class="pull-right">
                            <a href="{{route('beneficiados')}}" class="btn btn-secondary"> <i class="icon-arrow-left"></i> <span> Regresar a Beneficiados</span></a>
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
                <form role="form" method="POST" action="{{route('contador.guardar')}}" >
                   {{csrf_field()}}
                    <input type="hidden" name="id_beneficiado" value="{{$registro->id_beneficiado}}">
                    <div class="row">
                        
                        <div class="col-md-4">
                             <div class="form-group">
                                <label>Ramal</label>
                                <input type="text" class="form-control" value="{{old('rama')}}" name="rama" id="rama">
                            </div>
                        </div>

                        <div class="col-md-4">
                             <div class="form-group">
                                <label>Número de Contador</label>
                                <input type="text" class="form-control" value="{{old('numero_contador')}}" name="numero_contador" id="numero_contador">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <label>Fecha Inicio del Servicio</label>
                            <div class="input-group date" data-date-autoclose="true">
                                <input type="text" class="form-control" value="{{old('fecha_inicio')}}" name="fecha_inicio" id="fecha_inicio">
                                <div class="input-group-append" style="height: 34px;">                                            
                                    <button class="btn btn-outline-secondary" type="button" style=" border: 1px solid #ccc"><i class="fa fa-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-paper-plane "></i> Asignar Contador</button>
                            </div>
                        </div>

                    </div>
                    <br>
                    
                </form>
                <br>
                <div class="header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <h2 class="text-primary">CONTADORES ASIGNADOS</h2>      
                            </div>                    
                        </div>
                    </div>
                        
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table width="100%" class="table table-striped">
                            <thead>
                                <tr class="text-uppercase">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Rama</th>
                                    <th class="text-center">Número Contador</th>
                                    <th class="text-center">Fecha Inicio del Sericio</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registro->contadores as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td class="text-center">{{$item->rama}}</td>
                                        <td class="text-center">{{$item->contador_format}}</td>
                                        <td>{{Carbon\Carbon::parse($item->fecha_ingreso)->format('d/m/Y')}}</td>
                                        <td class="text-center">

                                            <form method="POST"
                                                action="{{ route('contador.eliminar', $item->id_beneficiado_contador) }}"
                                                style="display: inline"
                                                data-toggle="tooltip" 
                                                title="Eliminar contador"
                                                >
                                                <input type="hidden" name="id_beneficiado" value="{{$item->id_beneficiado}}">
                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                <button class="btn btn-danger"
                                                    style="height: 20px; width: 20px; padding: 0" 
                                                    onclick="return confirm('¿Estás seguro de querer eliminar el contador?')"
                                                ><i class="fa fa-trash-o"></i></button>
                                            </form>
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
    
</div>
@endsection


@section('pagescript')
    <script src="{{asset('alucid/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('alucid/vendor/bootstrap-datepicker/js/bootstrap-datepicker.es.min.js')}}"></script>
	<script src="{{asset('alucid/bundles/mainscripts.bundle.js')}}"></script>


    <script type="text/javascript">
        
        $(document).ready( function () {
            var options = {
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true,
                todayHighlight: true,  
                clearBtn: true          
            };
                
            $('#fecha_inicio').datepicker(options);
            
        });

        

    </script>
@endsection