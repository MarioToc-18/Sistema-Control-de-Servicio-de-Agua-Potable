<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Recibo;
use App\TasaAgua;
use Response;
use Session;
use Date;
use View;
use Auth;
use DB;

class ReportesController extends Controller
{
     public function listadoRecibos(){

        $recibos = Recibo::all();
        $maximo = TasaAgua::max('medida');

        $view =  \View::make('reportes.listado-recibos', compact('recibos','maximo'))->render();
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($view)->setPaper('a4', 'portrait');
        return $pdf->stream('Listado de recibos.pdf');
    }


    public function rptListadoBeneficiados(){


        $sql = "SELECT 
                    b.id_beneficiado,
                    b.nit,
                    CONCAT_WS(' ',b.nombre1,b.nombre2,b.apellido1,b.apellido2) as nombre_completo,
                    b.telefono,
                    bc.numero_contador,
                    det.recibos_pendiente,
                    det.cuota_fija,
                    det.consumo,
                    det.exceso
                FROM
                beneficiados b
                LEFT JOIN beneficiados_contador bc on b.id_beneficiado = bc.id_beneficiado
                LEFT JOIN
                    (
                        SELECT 
                            id_beneficiado_contador, 
                            count(1) as recibos_pendiente,
                            sum(cuota_fija) as cuota_fija,
                            sum(consumo) as consumo,
                            sum(exceso) as exceso
                        FROM recibos
                        WHERE esta_pagado = false
                        GROUP BY id_beneficiado_contador
                    ) det on det.id_beneficiado_contador = bc.id_beneficiado_contador
                ORDER BY id_beneficiado, numero_contador";

        try {

            $registros = collect(DB::select($sql));
        } catch (\Exception $e) {

            $error = $e->getMessage();
            Session()->put('message-error', $error);
            return redirect()->back()->withInput();
        }
        
        $view =  \View::make('reportes.listado-beneficiados', compact('registros') )->render();
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($view)->setPaper('a4', 'portrait');
        return $pdf->stream('Listado de beneficiados.pdf');


    }



    public function rptRecibosFechas(){
        $fecha_i = Session::get('fecha_i');
        $fecha_f = Session::get('fecha_f');

        $mesInicial = $fecha_i->month;
        $mesFinal = $fecha_f->month;
        $consulta = null;

        $sql = "CALL reporte_recibos('".$fecha_i->format('Y-m-d')."','".$fecha_f->format('Y-m-d')."')";

        try {
            $consulta = collect(DB::select($sql));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Session()->put('message-error', $error);
            return redirect()->back()->withInput();
        }
        
        $response = self::getRegistros($consulta, $mesInicial, $mesFinal);

        $registros = $response->registros;
        $titulos   = $response->titulos;

        $view =  \View::make('reportes.control-cobros', compact('registros','titulos','fecha_i', 'fecha_f') )->render();
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->stream('Control de cobros.pdf');


    }

    public function recibosFechas(){

    	$fecha_f = Date::now();
    	$fecha_i = Date::parse($fecha_f->year.'-01-01');
        $mesFinal = $fecha_f->month;
        $mesInicial = $fecha_i->month;
        $consulta = null;
        Session::put('fecha_i', $fecha_i);
        Session::put('fecha_f', $fecha_f);
        Session::save();

    	$sql = "CALL reporte_recibos('".$fecha_i->format('Y-m-d')."','".$fecha_f->format('Y-m-d')."')";

    	try {
            $consulta = collect(DB::select($sql));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Session()->put('message-error', $error);
            return redirect()->back()->withInput();
        }
    	
        $response = self::getRegistros($consulta, $mesInicial, $mesFinal);

        $registros = $response->registros;
        $titulos   = $response->titulos;

    	return view('reportes.view.reporte-fechas',compact('registros','titulos','fecha_i', 'fecha_f'));
    } 


    public function generarResultados(Request $request){

        $fecha_i = Carbon::createFromFormat('d/m/Y', $request->fecha_inicial);
        $fecha_f = Carbon::createFromFormat('d/m/Y', $request->fecha_final);

        Session::put('fecha_i', $fecha_i);
        Session::put('fecha_f', $fecha_f);
        Session::save();

        $mesInicial = $fecha_i->month;
        $mesFinal = $fecha_f->month;
        $consulta = null;

        $sql = "CALL reporte_recibos('".$fecha_i->format('Y-m-d')."','".$fecha_f->format('Y-m-d')."')";

        try {
            $consulta = collect(DB::select($sql));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Session()->put('message-error', $error);
            return redirect()->back()->withInput();
        }
        
        $response = self::getRegistros($consulta, $mesInicial, $mesFinal);

        $registros = $response->registros;
        $titulos   = $response->titulos;

        return view('reportes.view.reporte-fechas',compact('registros','titulos','fecha_i', 'fecha_f'));
    }


    private static function getRegistros($consulta, $mesInicial, $mesFinal ) 
    {

        $response = null;

        $registros = array();
        $titulos = array();

        foreach ($consulta as $key => $item) {

            $nombre = trim($item->nombre1.' '.$item->nombre2.' '.$item->apellido1.' '.$item->apellido2) ;
            $nombre = str_replace("  ", " ", $nombre);
            $total = 0;
            $registro['anio_lectura'] = $item->anio_lectura;
            $registro['id_beneficiado'] = $item->id_beneficiado;
            $registro['numero_contador'] = $item->numero_contador;
            $registro['anio_lectura'] = $item->anio_lectura;
            $registro['nit'] = $item->nit;
            $registro['nombre_completo'] = $nombre;

            if( 1 >= $mesInicial && 1 <= $mesFinal){ 
                $registro['enero'] = is_null($item->enero) ? '' : number_format($item->enero,2,'.',',');
                $total +=  $item->enero;
                $titulos['enero'] = 'ENE'; 
            }
            if( 2 >= $mesInicial && 2 <= $mesFinal){ 
                $registro['febrero'] = is_null($item->febrero) ? '' : number_format($item->febrero,2,'.',',');
                $total +=  $item->febrero;
                $titulos['febrero'] = 'FEB'; 
            }
            if( 3 >= $mesInicial && 3 <= $mesFinal){ 
                $registro['marzo'] = is_null($item->marzo) ? '' : number_format($item->marzo,2,'.',',');
                $total +=  $item->marzo;
                $titulos['marzo'] = 'MAR'; 
            }
            if( 4 >= $mesInicial && 4 <= $mesFinal){ 
                $registro['abril'] = is_null($item->abril) ? '' : number_format($item->abril,2,'.',',');
                $total +=  $item->abril;
                $titulos['abril'] = 'ABR'; 
            }
            if( 5 >= $mesInicial && 5 <= $mesFinal){ 
                $registro['mayo'] = is_null($item->mayo) ? '' : number_format($item->mayo,2,'.',',');
                $total +=  $item->mayo;
                $titulos['mayo'] = 'MAY'; 
            }
            if( 6 >= $mesInicial && 6 <= $mesFinal){ 
                $registro['junio'] = is_null($item->junio) ? '' : number_format($item->junio,2,'.',',');
                $total +=  $item->junio;
                $titulos['junio'] = 'JUN'; 
            }
            if( 7 >= $mesInicial && 7 <= $mesFinal){ 
                $registro['julio'] = is_null($item->julio) ? '' : number_format($item->julio,2,'.',',');
                $total +=  $item->julio;
                $titulos['julio'] = 'JUL'; 
            }
            if( 8 >= $mesInicial && 8 <= $mesFinal){ 
                $registro['agosto'] = is_null($item->agosto) ? '' : number_format($item->agosto,2,'.',',');
                $total +=  $item->agosto;
                $titulos['agosto'] = 'AGO'; 
            }
            if( 9 >= $mesInicial && 9 <= $mesFinal){ 
                $registro['septiembre'] = is_null($item->septiembre) ? '' : number_format($item->septiembre,2,'.',',');
                $total +=  $item->septiembre;
                $titulos['septiembre'] = 'SEP'; 
            }
            if( 10 >= $mesInicial && 10 <= $mesFinal){ 
                $registro['octubre'] = is_null($item->octubre) ? '' : number_format($item->octubre,2,'.',',');
                $total +=  $item->octubre;
                $titulos['octubre'] = 'OCT'; 
            }
            if( 11 >= $mesInicial && 11 <= $mesFinal){ 
                $registro['noviembre'] = is_null($item->noviembre) ? '' : number_format($item->noviembre,2,'.',',');
                $total +=  $item->noviembre;
                $titulos['noviembre'] = 'NOV'; 
            }
            if( 12 >= $mesInicial && 12 <= $mesFinal){ 
                $registro['diciembre'] = is_null($item->diciembre) ? '' : number_format($item->diciembre,2,'.',',');
                $total +=  $item->diciembre;
                $titulos['diciembre'] = 'DIC'; 
            }

            if($key == 0){
                $titulos = $titulos;
            }

            $registro['total'] = number_format($total, 2, '.', ',');
            $registros[] = (object) $registro;
        }

        $response['registros'] = $registros;
        $response['titulos'] = $titulos;


        return (object) $response;

    }



}
