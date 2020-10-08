<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BeneficiadoContador;
use App\Recibo;
use Carbon\Carbon;
use DB;
use Date;

class LecturasController extends Controller
{
    public function index(){

    	$contadores = BeneficiadoContador::where('esta_eliminado', false)->with('beneficiado','recibos','nopagado')->get();
        return view('lecturas.index', compact('contadores'));

    }


    public function crear($id){

    	$registro = BeneficiadoContador::where('id_beneficiado_contador', $id)->with('beneficiado','recibos')->first();

        return view('lecturas.crear', compact('registro'));

    }

    public function guardar(Request $request){

    	$id = $request->id_beneficiado_contador;

        
        $lectura_actual = intval(str_replace(',', '', $request->lectura_actual));
        $lectura_anterior = Recibo::where('id_beneficiado_contador', $request->id_beneficiado_contador)
                                ->where('esta_eliminado', false)
                                ->where('esta_trasladado', false)
                                ->get()
                                ->last();
        

        if($lectura_anterior){
            $lectura_anterior = intval($lectura_anterior->lectura_actual);
            
            if($lectura_actual >= $lectura_anterior){

                $lectura = $lectura_actual;

            }else{
                $lectura = 0;
            }

        }else{
            $lectura_anterior = 0;
            $lectura = 0;
        }

        

        $request['lectura'] = $lectura;
        $this->validate(
            $request,
            [
                'fecha_lectura' => 'required',
                'lectura_actual' => 'required',
                'lectura' => 'integer|min:'.$lectura_anterior
            ],
            [
                'fecha_lectura.required' => 'La fecha de lectura es obligatorio',
                'lectura_actual.required' => 'La lectura actual es obligatorio',
                'lectura.min'=>'La lectura tiene que ser igual o mayor que la lectura anterior',
            ]
        );

    	$fecha_lectura = Date::createFromFormat('d/m/Y', $request->fecha_lectura);

        $anio = $fecha_lectura->format('Y');
        $mes = $fecha_lectura->format('F');
        $recibo = null;

        try {
            $recibo = collect(DB::select("CALL generar_recibo($id, '$fecha_lectura',$lectura_actual)"))->first();
        } catch (\Exception $e) {
            $error = $e->getMessage();
            if (strpos($error, 'recibos_id_beneficiado_contador_mes_lectura_anio_lectura_unique') !== false) {
                Session()->put('message-error', 'Ya existe una lectura del mes que esta ingresando ('.$mes.'-'.$anio.')');
                return redirect()->back()->withInput();
            }
        }
    	
        $recibo = Recibo::where('id_recibo', $recibo->id_recibo)->with('contador')->first();

        Session()->put('message-success', 'Se ha creado la lectura correspondiente al contador #'.$recibo->contador->contador_format);
        return redirect()->route('lecturas.index');

    }

}
