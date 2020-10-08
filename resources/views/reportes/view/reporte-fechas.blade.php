@extends('tema.general')

@section('htmlheadertitle', 'Reporte por rango de fechas')

@section('pagestyle')
    <link rel="stylesheet" href="{{ asset('alucid/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">

    <style>
        #listado{
            font-size: 12px;
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
	            <li class="breadcrumb-item active">Reporte por rango de fechas</li>
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
                            <h2>RECIBOS MONTOS EXPRESADOS EN QUETZALES Q. <small> seleccionados por rango de fechas</small> </h2>      
                        </div>                    
                    </div>
                </div>
                <form action="{{route('reportes.recibos.generar')}}" method="POST" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row" style="padding-top: 10px;">
                        <div class="col-lg-4 col-md-12">
                            <label>Fecha inicial</label>
                            <div class="input-group date" data-date-autoclose="true">
                                <input type="text" class="form-control" value="{{ $fecha_i->format('d/m/Y')}}" name="fecha_inicial" id="fecha_inicial">
                                <div class="input-group-append" style="height: 34px;">                                            
                                    <button class="btn btn-outline-secondary" type="button" style=" border: 1px solid #ccc"><i class="fa fa-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <label>Fecha final</label>
                            <div class="input-group date" data-date-autoclose="true">
                                <input type="text" class="form-control" value="{{ $fecha_f->format('d/m/Y')}}" name="fecha_final" id="fecha_final">
                                <div class="input-group-append" style="height: 34px;">                                            
                                    <button class="btn btn-outline-secondary" type="button" style=" border: 1px solid #ccc"><i class="fa fa-calendar"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <label for="" style="padding-top: 13px;"></label>
                            <button id="btnGenerar" type="submit" class="btn btn-info btn-block"> <i class="fa fa-search"></i> Generar</button>
                        </div>
                    </div>  
                </form>


                <div class="row" style="padding-top: 10px;">
                        <div class="col-lg-4 col-md-12">
                           
                        </div>
                        <div class="col-lg-4 col-md-12">
                            
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <a href="{{route('reportes.recibos.pdf')}}"  class="btn btn-warning btn-block" target="_blank">
                                <i class="fa fa-file-pdf-o"></i> Generar PDF
                            </a>
                        </div>
                    </div>

            </div>
            <div class="body">
                <div class="table-responsive" id="resultado-tabla"> 
                    @include('reportes.view.tabla', ['registros' => $registros])
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
                    
            $('#fecha_inicial').datepicker(options);
            $('#fecha_final').datepicker(options);
        });

    </script>
@endsection