<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('global.sistema') }} - Recibos</title>

    <link rel="stylesheet" href="{{ asset('css/recibos.css') }}">
</head>
<body class="general">
    @php
        $conteo = 0;
    @endphp

    @foreach($recibos as $recibo)
    <div class="recibo">
        <table width="100%">
            <tr>
                <td width="88%">
                    <p class="recibo-title"><strong>{{config('global.organizacion')}}</strong></p> 
                </td>
                <td width="12%" valign="middle">
                    <img src="{{ asset('alucid/img/logo2.png') }}">
                    <span class="text-bold" style="padding-top: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;{{ $recibo->serie }} {{ $recibo->numero }}</span>
                </td>
            </tr>
            
        </table>
        <p class="text-left" style="margin-top: 0"><strong>Nombre del beneficiado:</strong> {{$recibo->contador->beneficiado->nombre_completo}}</p>
        <p class="text-left-pdt"><strong>DATOS DEL SERVICIO</strong></p>

        <table width="100%" class="text-left-pdt">
            <tr >
                <td width="10%" class="text-bold">Contador</td>
                <td width="8%">{{$recibo->contador->contador_format}}</td>
                <td width="15%" class="text-bold">Mes de lectura</td>
                <td width="11%">{{ Date::parse($recibo->fecha_lectura)->format('F') }}</td>
                <td width="17%" class="text-bold">Lectura anterior</td>
                <td width="10%">{{number_format($recibo->lectura_anterior, 0,'.',',')}}</td>
                <td width="14%" class="text-bold">Lectura actual</td>
                <td width="15%">{{number_format($recibo->lectura_actual, 0,'.',',')}}</td>
            </tr>
        </table>

        <table width="40%" align="center" class="table" >

            <tr>
                <th class="col-md-60">Metros Cúbicos</th>
                <th class="col-md-40">Quetzales</th>
            </tr>

            <tr style="padding-top: -10px; padding-bottom: -10px">
                <td class="col-md-60">Cuota Fija</td>
                <td class="col-md-40" valign="top">
                    <div>
                       Q. <span style="float: right;">{{number_format($recibo->cuota_fija, 2,'.',',')}}</span>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="col-md-60" valign="top">
                    @php
                        $consumo = $recibo->lectura_actual - $recibo->lectura_anterior;
                        if($consumo > $maximo){
                            $consumo = $maximo;
                        }
                    @endphp
                    <table width="100%">
                        <tr>
                            <td style="text-align: left">
                                Consumo
                            </td>
                            <td class="text-right">
                                {{number_format($consumo, 0,'.',',')}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="col-md-40" valign="top">
                    Q. <span style="float: right;">{{number_format($recibo->consumo, 2,'.',',')}}</span>
                </td>
            </tr>
            
            <tr>
                <td class="col-md-60" valign="top">
                    @php
                        $consumo = $recibo->lectura_actual - $recibo->lectura_anterior;
                        $exceso = $consumo - $maximo;
                        if($exceso > 0){
                            $exceso = number_format($exceso, 0,'.',',');
                        }else{
                            $exceso = 0;
                        }
                    @endphp
                    <table width="100%">
                        <tr>
                            <td style="text-align: left">
                                Exceso
                            </td>
                            <td class="text-right">
                                {{$exceso}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="col-md-40" valign="top">
                    Q. <span style="float: right;">{{number_format($recibo->exceso, 2,'.',',')}}</span>
                </td>
            </tr>
            
            <tr>
                <td class="col-md-60" valign="top">
                    Cuota pendiente
                </td>
                <td class="col-md-40" valign="top">
                    Q. <span style="float: right;">{{number_format($recibo->cuota_pendiente, 2,'.',',')}}</span>
                </td>
            </tr>
            
            <tr class="text-bold">
                <td class="col-md-60" valign="top">
                    TOTAL A PAGAR
                </td>
                <td class="col-md-40" valign="top">
                    Q. <span style="float: right;">{{number_format($recibo->total, 2,'.',',')}}</span>
                </td>
            </tr>

        </table>

        <p class="text-left-pdt"><strong>Fecha sugerida de pago: {{Carbon\Carbon::parse($recibo->fecha_max_pago)->format('d/m/Y')}}</strong>
            <span class="text-right bold" style="padding-left: 320px; font-weight: bold; font-size: 16px;">
                @if($recibo->fecha_efectiva !=null)
                    COBRADO
                @elseif($recibo->esta_trasladado == true)
                    VENCIDO
                @endif                
            </span>
        </p>
        <p class="text-center-pdt text-bold alerta">Se recomienda pasar a pagar de inmediato, para evitar que el servicio sera cortado <small style="text-align: right; padding-left: 35px; font-size: 12px; color: black; font-style:italic;">Ramal: {{$recibo->contador->rama}}</small></p>
    </div>

    @php
        $conteo++;
    @endphp

    @if($conteo == 3)
        @php
            $conteo = 0;
        @endphp
    @else
        <hr>
    @endif
    @endforeach
</body>
</html>