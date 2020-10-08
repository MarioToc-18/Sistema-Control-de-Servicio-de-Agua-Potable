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

class ImprimirController extends Controller
{

    public function index(){

    	$recibos = Recibo::where('esta_eliminado', false)
    					->where('esta_trasladado', false)
						->where('esta_pagado', false)
						->with('contador.beneficiado');

		if(Session::get('recibos')){
			$recibos->whereNotIn('id_recibo', Session::get('recibos'));
		}
		$recibos = $recibos->get();


        return view('imprimir.index', compact('recibos'));

    }

    public function agregar($id){

    	$recibo = Recibo::where('id_recibo', $id)->first();

    	if(!$recibo){
            Session::flash('message-warning', 'El recibo seleccionado no exite');
            return redirect()->route('imprimir.index'); 
        }

        $recibos = Session::get('recibos');
        if(!$recibos){
        	$recibos = array();
        	$recibos[] = $recibo->id_recibo;
        }else{
        	foreach ($recibos as $key => $value) {
        		if($value == $recibo->id_recibo){
        			Session::flash('message-warning', 'El recibo seleccionado ya esta en la cola');
            		return redirect()->route('imprimir.index'); 
            		break;
        		}
        	}

        	$recibos[] = $recibo->id_recibo;

        }

        Session::put('recibos', $recibos);
        Session::save();
       	
       	Session::flash('message-info', 'El recibo seleccionado se agregó exitosamente a la cola');
        return redirect()->route('imprimir.index');

    }

    public function generar(){

    	if(count(Session::get('recibos')) < 1){
            Session::flash('message-warning', 'No se ha seleccionado ningún recibo, por favor seleccione uno o varios recibos');
            return redirect()->route('imprimir.index'); 
        }
    	$recibos = Recibo::whereIn('id_recibo', Session::get('recibos'))->get();

        $maximo = TasaAgua::max('medida');
        $view =  \View::make('reportes.listado-recibos', compact('recibos','maximo'))->render();
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($view)->setPaper('a4', 'portrait');
    	
    	Session::forget('recibos');
        return $pdf->stream('Listado de recibos.pdf');


    }
}
