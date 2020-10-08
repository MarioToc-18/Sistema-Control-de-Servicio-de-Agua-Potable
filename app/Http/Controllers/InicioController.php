<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiado;
use App\BeneficiadoContador;
use App\Recibo;
use App\User;
use DB;

class InicioController extends Controller
{
	public $pageData = array();
    public function index(){

        $sql = "SELECT 
                    b.nit,
                    CONCAT_WS(' ',b.nombre1,b.nombre2,b.apellido1,b.apellido2) as nombre_completo,
                    b.telefono,
                    bc.numero_contador,
                    det.total
                FROM
                (
                    SELECT id_beneficiado_contador, count(1) as total FROM recibos
                    WHERE esta_pagado = false
                    GROUP BY id_beneficiado_contador
                ) det
                JOIN beneficiados_contador bc on det.id_beneficiado_contador = bc.id_beneficiado_contador
                JOIN beneficiados b on bc.id_beneficiado = b.id_beneficiado
                ORDER BY total DESC LIMIT 5";

        $morosos = collect(DB::select($sql));
    	$pageData['beneficiados'] = Beneficiado::all();
    	$pageData['contadores'] = BeneficiadoContador::all();
    	$pageData['recibos'] = Recibo::all();
    	$pageData['recibosPendientes'] = Recibo::where('esta_pagado', false)
    										   ->where('esta_trasladado', false)->get();
		$pageData['recibosVencidas'] = Recibo::where('esta_pagado', false)
    										   ->where('esta_trasladado', true)->get();
    	$pageData['recibosCobradas'] = Recibo::where('esta_pagado', true)->get();
        $pageData['usuarios'] = User::all();
    	$pageData['morosos'] = $morosos;
        
        return view('home', $pageData);
    }
}
