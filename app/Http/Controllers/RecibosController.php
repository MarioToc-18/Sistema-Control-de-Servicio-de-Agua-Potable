<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\BeneficiadoContador;
use App\Recibo;
use App\ReciboTraslado;
use App\TasaAgua;
use Session;
use View;
use Auth;
use DB;


class RecibosController extends Controller
{
    public function index(){

    	$recibos = Recibo::where('esta_eliminado', false)
    					->where('esta_trasladado', false)
						->where('esta_pagado', false)
						->with('contador.beneficiado')
						->get();

        return view('recibos.index', compact('recibos'));

    }

    public function cobrados(){

        $recibos = Recibo::where('esta_eliminado', false)
                        ->where('esta_trasladado', false)
                        ->where('esta_pagado', true)
                        ->with('contador.beneficiado')
                        ->get();

        return view('recibos.cobrados', compact('recibos'));

    }

    public function pagar($id){

    	$registro = Recibo::where('id_recibo', $id)->with('contador.beneficiado')->first();

        return view('recibos.pagar', compact('registro'));

    }


    public function guardar(Request $request){

        $id = $request->id_recibo;
        $recibo = Recibo::where('id_recibo', $id)->first();
        $cobro = floatval(str_replace(',', '', $request->total_cobro));

        if($recibo->total != $cobro){
            Session::flash('message-warning', 'El monto tiene que ser igual al recibo');
            return redirect()->back()->withInput(); 
        }
        
        while (true) {
            $traslado = ReciboTraslado::where('id_recibo_nuevo', $id)->first();

            if($traslado){
                $reciboPagar = Recibo::where('id_recibo', $traslado->id_recibo_original)->first();
                $reciboPagar->update(['esta_pagado' => true]);
                $id = $traslado->id_recibo_original;
            }else{
                break;
            }
        }

        $fecha_cobro = Carbon::createFromFormat('d/m/Y', $request->fecha_cobro);
        $recibo->update(
            [
                'fecha_efectiva' => $fecha_cobro,
                'esta_pagado' => TRUE
            ]
        );


        Session()->put('message-info', 'Se ha realizado el cobro del recibo #'.$recibo->serie.' '.$recibo->numero);
        return redirect()->route('recibos.index');

    }

    
    public function imprimir($id){

        $recibo = Recibo::where('id_recibo', $id)->with('contador.beneficiado')->first();
        $maximo = TasaAgua::max('medida');

        $view =  \View::make('reportes.recibo', compact('recibo','maximo'))->render();
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($view)->setPaper('a4', 'portrait');
        return $pdf->stream('Recibo '.$recibo->serie .' '.$recibo->numero.'.pdf');
    }   

     


}
