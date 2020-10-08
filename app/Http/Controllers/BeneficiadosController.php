<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Beneficiado;
use App\Master;

class BeneficiadosController extends Controller
{
    
    public function index(){
    	$beneficiados = Beneficiado::where('esta_eliminado', false)->with('contadores')->get();

        //return $beneficiados;

        $newBeneficiados = array();

        foreach ($beneficiados as $key => $item) {
            
            $numero_contador = null;
            $rama = null;

            if(count($item->contadores) == 1){
                $contador = reset($item->contadores);
                $numero_contador = collect($contador)->first()->numero_contador;
                $rama = 1;
            }elseif(count($item->contadores) > 1){
                foreach ($item->contadores as $value) {
                    $numero_contador .= $value->numero_contador.',';
                    $rama .= $value->rama.',';
                }

                $numero_contador = trim($numero_contador, ',');
                $rama = trim($rama, ',');

            }

            $nombre = trim($item->nombre1.' '.$item->nombre2.' '.$item->apellido1.' '.$item->apellido2) ;
            $nombre = str_replace("  ", " ", $nombre);

            $new['id_beneficiado'] = $item->id_beneficiado;
            $new['nombre_completo'] = $nombre;
            $new['rama'] = $rama;
            $new['numero_contador'] = $numero_contador;
            $new['telefono'] = $item->telefono;
            $new['direccion'] = $item->direccion;
            $newBeneficiados[] = (object) $new;

        }

        $beneficiados = $newBeneficiados;

        return view('beneficiados.index', compact('beneficiados'));
    }

    public function crear(){
        return view('beneficiados.crear');
    }

    public function guardar(Request $request){


        
        $this->validate($request,
            [
                'cui' => 'numeric|digits:13|unique:beneficiados',
                'nombre1' => 'required|min:3|max:100',
                'nombre2' => 'min:3|max:100',
                'apellido1' => 'required|min:3|max:100',
                'apellido2' => 'min:3|max:100',
                'email' => 'email|max:255|unique:beneficiados',
                'telefono' => 'required|numeric',
                'direccion' => 'required|min:5'
            ],[
                'nombre1.required'=>'El primer nombre es requerido',
                'nombre1.min'=>'El primer nombre minimo tiene que tener 3 letras',
                'nombre2.min'=>'El segundo nombre minimo tiene que tener 3 letras',
                'apellido1.required'=>'El primer apellido es requerido',
                'apellido1.min'=>'El primer apellido minimo tiene que tener 3 letras',
                'apellido2.min'=>'El segundo apellido minimo tiene que tener 3 letras',

            ]
        );

        
        $request['cui'] = Master::isNull($request->cui);
        $registro = Beneficiado::create($request->all());
        return redirect()->route('beneficiados')->withFlash('El beneficiado se ha creado en la base de datos');
    }


    public function editar($id)
    {
        $registro = Beneficiado::where('id_beneficiado', $id)->first();
        if(!$registro){
            Session()->put('message-error', 'No se encontro el registro buscado');
            return redirect()->route('beneficiados');
        }

        return view('beneficiados.editar', compact('registro'));
    }


    public function actualizar(Request $request, $id)
    {

        $registro = Beneficiado::where('id_beneficiado', $id)->first();

        

        $rules = [
            'cui'       => [
                            'min:13',
                            'numeric',
                            'digits:13',
                            Rule::unique('beneficiados','cui')->ignore( $registro->id_beneficiado, 'id_beneficiado' )
            ],
            'nombre1'   => 'required|min:3|max:100',
            'nombre2' => 'min:3|max:100',
            'apellido1'  => 'required|min:3|max:100',
            'apellido2' => 'min:3|max:100',

            'telefono'  => 'required|numeric',
            'email'     => [
                            'email',
                            'max:255',
                            Rule::unique('beneficiados','email')->ignore( $registro->id_beneficiado, 'id_beneficiado' )
            ],
            'direccion' => 'required|min:5'
        ];
        
        $mensajes =[
                'nombre1.required'=>'El primer nombre es requerido',
                'nombre1.min'=>'El primer nombre minimo tiene que tener 3 letras',
                'nombre2.min'=>'El segundo nombre minimo tiene que tener 3 letras',
                'apellido1.required'=>'El primer apellido es requerido',
                'apellido1.min'=>'El primer apellido minimo tiene que tener 3 letras',
                'apellido2.min'=>'El segundo apellido minimo tiene que tener 3 letras',

            ];
            
        $this->validate($request,$rules,$mensajes);
        $request['cui'] = Master::isNull($request->cui);
        
        $registro->update($request->all() );
        Session()->put('message-info', 'Beneficiado actualizado en la base de datos');

        return redirect()->route('beneficiados');
    }

    public function eliminar(Request $request, $id)
    {
        
        $registro = Beneficiado::where('id_beneficiado', $id)->with('contadores')->first();

        if($registro->contadores->count() > 0){
            Session()->put('message-error', 'No se puede eliminar porque tiene contadores asignados');
            return redirect()->route('beneficiados');
        }

        $registro->update(['esta_eliminado' => 1]);

        Session()->put('message-warning', 'Se ha inactivado al beneficiado '.$registro->nit.' - '. $registro->nombre_completo);

        return redirect()->route('beneficiados');
    }


}
