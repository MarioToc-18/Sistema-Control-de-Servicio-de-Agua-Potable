<table class="table table-striped table-custom" id="listado">
    <thead>
        <tr>
            <th width="2%" class="text-center">Contador</th>
            <th width="2%" class="text-center">Año</th>
            <th>Nombre del Beneficiado</th>
            @foreach($titulos as $key => $titulo)
                <th>{{$titulo}}</th>
            @endforeach
            <th class="text-center">TOTAL</th>
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
                    <td style="width: 20px !important;">
                        <div>
                            <span style="float: left;"></span>
                            <span style="float: right;">
                                {{$item->$key}}  
                            </span>
                        </div>
                    </td>
                @endforeach

                <td >
                    <div >
                        <span style="float: left;"></span>
                        <span style="float: right;">
                            {{$item->total}} 
                        </span>
                    </div>
                    
                </td>
            </tr>

        @endforeach
    </tbody>
</table>