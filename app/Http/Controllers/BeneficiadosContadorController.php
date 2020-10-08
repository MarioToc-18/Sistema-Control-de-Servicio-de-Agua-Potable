<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiado;
use App\BeneficiadoContador;
use Carbon\Carbon;

class BeneficiadosContadorController extends Controller
{
    public function crear($id){


    	$registro = Beneficiado::where('id_beneficiado', $id)->first();
        if(!$registro){
            Session()->put('message-error', 'No se encontro el registro buscado');
            return redirect()->route('beneficiados');
        }

        return view('contador.crear', compact('registro'));
    }

    public function guardar(Request $request){

        
        $beneficiado = Beneficiado::where('id_beneficiado', $request->id_beneficiado)->with('contadores')->first();
        $this->validate($request,
            [
                'id_beneficiado' => 'required',
                'rama' => 'required|numeric',
                'numero_contador' => 'required|numeric',
                'fecha_inicio' => 'required'
            ],[
                'id_beneficiado.required'=>'Seleccione un beneficiado válido',
                'fecha_inicio.required'=>'La fecha de inicio de servicio es obligatorio'
            ]
        );


        $fecha = Carbon::createFromFormat('d/m/Y', $request->fecha_inicio);
        $request['fecha_inicio'] = $fecha;
        
        try {
            $registro = BeneficiadoContador::create($request->all());
            
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $rama = $request->rama;
            $numero_contador = $request->numero_contador;

            if (strpos($error, 'beneficiados_contador_rama_numero_contador_unique') !== false) {
                $error  = 'El número de rama y contador ya esta asignada ';
                $error .= '(RAMA: '.$rama.' NÚMERO CONTADOR: '.$numero_contador.')';
                $request['fecha_inicio'] = $fecha->format('d/m/Y');
                
                Session()->put('message-error', $error);
                return redirect()->back()->withInput();
            }
        }

        

        return redirect()->route('beneficiados')->withFlash('El contador se ha asignado a '.$beneficiado->nombre_completo);
    }


    public function eliminar(Request $request, $id){

        
        $contador = BeneficiadoContador::where('id_beneficiado_contador', $id)->with('recibos','nopagado')->first();

        if($contador->recibos->count() > 0){
            Session()->put('message-warning', 'No se puede eliminar contador, porque tiene recibos asociados');
            return redirect()->route('contador.crear', $request->id_beneficiado);
        }


        $contador->delete();
        Session()->put('message-error', 'Se ha eleiminado el contador del beneficiado');

        return redirect()->route('contador.crear', $request->id_beneficiado);
    }

}
