<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('global.sistema') }} - Control de Cobro</title>
    <style>
        .general{
            font-size: 10pt;
            font-family: 'sans-serif'
        }

        img{
            padding-left: 2px;
            width: 125px;
            float: left;
        }
        #listado{
            font-size: 12px;
            border-collapse: collapse;
        }
        .text-center{
            text-align: center;
        }
        .col-md-5{
            width: 5%;
        }

        #listado > thead , tr {
            border: 1px solid #ddd;
        }
        
        #listado > thead , th {
            border: 1px solid #ddd;
        }

        #listado > tbody , tr {
            border: 1px solid #ddd;
        }
        
        #listado > tbody > tr > td {
            border: 1px solid #ddd;
        }

        #listado > tbody > tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        @page { margin: 30px 50px; }
    </style>
</head>
<body class="general">
    <table width="100%">
        <tr>
            <td width="88%">
                <p style="padding-bottom: : 0px; text-align: center;"><strong>{{config('global.organizacion')}}</strong></p> 
                <p style="padding-top: -10px; text-align: center;"> <strong>CONTROL DE COBROS Correspondiente ( {{ Date::parse($fecha_i)->format('F Y')}} - {{ Date::parse($fecha_f)->format('F Y')}} )</strong></p>
                <p style="padding-top: -10px; text-align: center;"> <strong>Cantidades Expresadas en Q.</strong></p>
            </td>
            <td width="12%" valign="middle">
                <img src="{{ asset('alucid/img/logo2.png') }}">
            </td>
        </tr>
    </table>
    <br>
    <table id="listado" width="100%">
        <thead>
            <tr>
                <th style="width: 40px !important;" class="text-center">Contador</th>
                <th style="width: 40px !important;" class="text-center">Año</th>
                <th>Nombre del Beneficiado</th>
                @foreach($titulos as $key => $titulo)
                    <th style="width: 52px !important;" class="text-center" >{{$titulo}}</th>
                @endforeach
                <th style="width: 100px !important;" class="text-center">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $key => $item)
                <tr>
                    <td class="text-center">
                        {{$item->numero_contador}}
                    </td>
                    <td class="text-center">
                        {{$item->anio_lectura}}
                    </td>
                    <td>
                        {{$item->nombre_completo}}
                    </td>
                
                    @foreach($titulos as $key => $titulo)
                        <td style="text-align: right;">
                            {{$item->$key}} 
                        </td>
                    @endforeach

                    <td style="text-align: right;">
                        {{$item->total}} 
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</body>
</html>