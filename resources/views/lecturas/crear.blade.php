@extends('tema.general')

@section('htmlheadertitle', 'Lecturas')

@section('pagestyle')
    <link rel="stylesheet" href="{{ asset('alucid/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">

    <style>
        .p-l{
            padding-left: 10px;
        }
    </style>
@endsection



@section('headerpage')
    <div class="row">
	    <div class="col-lg-5 col-md-8 col-sm-12">                        
	        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Lecturas</h2>
	        <ul class="breadcrumb">
	            <li class="breadcrumb-item">
	            	<a href="javascript:void(0);">Lecturas</a>
	            </li>                            
	            <li class="breadcrumb-item active">Registrar Lectura</li>
	        </ul>
	    </div> 
        
	</div>
@endsection

@section('pagecontent')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header" style="padding-bottom: 5px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <h2 style="font-size: 20px" class="text-primary text-uppercase">{{$registro->beneficiado->nit}} - {{ $registro->beneficiado->nombre_completo}} - </h2> 
                            <h2 style="font-size: 20px" class="text-primary text-uppercase">RAMAL {{$registro->rama}} CONTADOR #{{ $registro->contador_format}}</h2> 
                            <h2 style="padding-top: 10px;">REGISTRO DE LECTURA</h2>      
                        </div>
                        <div class="pull-right">
                            <a href="{{route('lecturas.index')}}" class="btn btn-secondary"> <i class="icon-arrow-left"></i> <span> Regresar a Listado</span></a>
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
                <div class="row">
                    <div class="col-md-12">

                        @if($registro->recibos->last())
                        <table>
                            <tr>
                                <td class="text-right">Fecha de lectura anterior:</td>
                                <td class="p-l"><strong>{{Carbon\Carbon::parse($registro->recibos->last()->fecha_lectura)->format('d-m-Y')}}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-right">Lectura Anterior:</td>
                                <td class="p-l"><strong>{{ number_format($registro->recibos->last()->lectura_actual, 0,'.',',')}} </strong></td>
                            </tr>

                            <tr>
                                <td class="text-right">Recibos Pendientes:</td>
                                <td class="p-l"><strong>{{$registro->nopagado->count()}}</strong></td>
                            </tr>
                        </table>
                        @else
                            <center class="text-danger pull-left text-uppercase">El contador aún no cuenta con recibos</center>
                        @endif
                    </div>
                </div>
                <br>
                <form role="form" method="POST" action="{{route('lecturas.guardar')}}" autocomplete="off">
                   {{csrf_field()}}
                    <input type="hidden" name="id_beneficiado_contador" value="{{$registro->id_beneficiado_contador}}" >
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <label>Fecha de la Lectura</label>
                            <div class="input-group date" data-date-autoclose="true">
                                <input type="text" class="form-control" value="{{old('fecha_lectura')}}" name="fecha_lectura" id="fecha_lectura">
                                <div class="input-group-append" style="height: 34px;">                                            
                                    <button class="btn btn-outline-secondary" type="button" style=" border: 1px solid #ccc"><i class="fa fa-calendar"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                             <div class="form-group">
                                <label>Lectura Actual</label>
                                <input type="text" class="form-control" value="{{old('lectura_actual')}}" name="lectura_actual" id="lectura_actual">
                            </div>
                        </div>

                        
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar Lectura</button>
                </form>
                <br>
                
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
                
            $('#fecha_lectura').datepicker(options);
            $("#lectura_actual").blur(function(event){
                event.preventDefault();
                var valor = $(this).val();

                $(this).val(number_format(valor, 0, '.', ','))

            });    
        });

        function number_format(number,decimals,dec_point,thousands_sep) {
            number = number.replace(/,/g, "");
            number  = number*1;//makes sure `number` is numeric value
            var str = number.toFixed(decimals?decimals:0).toString().split('.');
            var parts = [];
            for ( var i=str[0].length; i>0; i-=3 ) {
                parts.unshift(str[0].substring(Math.max(0,i-3),i));
            }
            str[0] = parts.join(thousands_sep?thousands_sep:',');
            return str.join(dec_point?dec_point:'.');
        }


    </script>
@endsection