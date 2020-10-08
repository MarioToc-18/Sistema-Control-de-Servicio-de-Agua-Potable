@extends('tema.general')

@section('htmlheadertitle', 'Recibos')

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
	        <ul class="breadcrumb">
	            <li class="breadcrumb-item">
	            	<a href="javascript:void(0);">Recibos</a>
	            </li>                            
	            <li class="breadcrumb-item active">Realizar cobro</li>
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
                            <h2 style="font-size: 20px" class="text-primary text-uppercase">{{$registro->contador->beneficiado->nit}} - {{ $registro->contador->beneficiado->nombre_completo}} -</h2> 
                            <h2 style="font-size: 20px" class="text-primary text-uppercase">RAMAL {{$registro->contador->rama}} CONTADOR #{{ $registro->contador->contador_format}}</h2> 
                            <h2 style="padding-top: 10px;">REGISTRAR COBRO</h2>      
                        </div>
                        <div class="pull-right">
                            <a href="{{route('recibos.index')}}" class="btn btn-secondary"> <i class="icon-arrow-left"></i> <span> Regresar a Listado</span></a>
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
                        <h2 style="padding-top: 10px;">RECIBO {{$registro->serie}} {{$registro->numero}}</h2>   
                        <h2 style="padding-top: 0px;">Q. {{number_format($registro->total, 2, '.', ',')}}</h2>   
                        <table>
                            <tr>
                                <td class="text-right">Fecha de última Lectura:</td>
                                <td class="p-l"><strong>{{Carbon\Carbon::parse($registro->fecha_lectura)->format('d-m-Y')}}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-right">Lectura Anterior:</td>
                                <td class="p-l"><strong>{{number_format($registro->lectura_anterior, 0, '.', ',')}} </strong></td>
                            </tr>
                            <tr>
                                <td class="text-right">Lectura Actual:</td>
                                <td class="p-l"><strong>{{number_format($registro->lectura_actual, 0, '.', ',')}} </strong></td>
                            </tr>

                            <tr>
                                <td class="text-right">Consumido:</td>
                                <td class="p-l"><strong>{{number_format(($registro->lectura_actual - $registro->lectura_anterior) , 0, '.', ',')}} Litros</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <form role="form" method="POST" action="{{route('recibos.guardar')}}" >
                   {{csrf_field()}}
                    <input type="hidden" name="id_recibo" value="{{$registro->id_recibo}}">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <label>Fecha del cobro</label>
                            <div class="input-group date" data-date-autoclose="true">
                                <input type="text" class="form-control" value="{{old('fecha_cobro', Carbon\Carbon::now()->format('d/m/Y'))}}" name="fecha_cobro" id="fecha_cobro">
                                <div class="input-group-append" style="height: 34px;">                                            
                                    <button class="btn btn-outline-secondary" type="button" style=" border: 1px solid #ccc"><i class="fa fa-calendar"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                             <div class="form-group">
                                <label>Total del recibo</label>
                                <input type="text" class="form-control" value="{{old('total_cobro', $registro->total)}}" name="total_cobro" id="total_cobro">
                            </div>
                        </div>

                        
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="icon-wallet"></i> Guardar Cobro</button>
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
                
            $('#fecha_cobro').datepicker(options);
            $("#total_cobro").blur(function(event){
                event.preventDefault();
                var valor = $(this).val();

                $(this).val(number_format(valor, 2, '.', ','))

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