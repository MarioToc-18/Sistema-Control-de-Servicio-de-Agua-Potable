<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('global.sistema') }} - Listado Beneficiados</title>
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
        .text-right{
            text-align: right;
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
                
                <p style="padding-top: -5px; text-align: center;"> <strong>LISTADO DE BENEFICIADOS</strong></p>
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
                <th style="width: 80px !important;" class="text-center">NIT</th>
                <th style="width: 80px !important;" class="text-center">Contador</th>
                <th>Nombre del Beneficiado</th>
                <th style="width: 80px !important;">Telefono</th>
                <th style="width: 80px !important;">Total recibos pendientes</th>
                <th style="width: 100px !important;" class="text-center">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $key => $item)
                <tr>
                    <td class="text-center">
                        {{$item->nit}}
                    </td>
                    <td class="text-center">
                        {{$item->numero_contador}}
                    </td>
                     <td >
                        {{$item->nombre_completo}}
                    </td>
                    <td>
                        {{$item->telefono}}
                    </td>
                    <td class="text-center">
                        {{$item->recibos_pendiente}}
                    </td>
                    <td class="text-right">
                        {{number_format(($item->cuota_fija + $item->consumo + $item->exceso), 2,'.',',')}}
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</body>
</html>