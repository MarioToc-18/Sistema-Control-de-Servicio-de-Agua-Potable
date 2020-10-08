<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class UsuariosController extends Controller
{
    public function index(){
    	$usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function crear(){
        return view('usuarios.crear');
    }

        public function guardar(Request $request){
    	$this->validate($request,
            [
                
                'nombre' => 'required|min:3|max:100',
                'apellido' => 'required|min:3|max:100',
                'telefono' => 'required|numeric',
                'email' => 'required|email|max:255|unique:usuarios',
                'direccion' => 'required|min:5',
                'usuario' => 'required|max:255|unique:usuarios',
                'password' => 'required|confirmed'
            ]
        );

        
        $registro = User::create($request->all());
        return redirect()->route('usuarios')->withFlash('El usuario se ha creado en la base de datos');
    }


    public function editar($id)
    {
        $registro = User::where('id_usuario', $id)->first();
        if(!$registro){
            Session()->put('message-error', 'No se encontro el registro que esta buscando');
            return redirect()->route('usuarios');
        }

        return view('usuarios.editar', compact('registro'));
    }



    public function actualizar(Request $request, $id)
    {

        $registro = User::where('id_usuario', $id)->first();

        $rules = [
                
                'nombre' => 'required|min:3|max:100',
                'apellido' => 'required|min:3|max:100',
                'telefono' => 'required|numeric',
                'email'     => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('usuarios','email')->ignore( $registro->id_usuario, 'id_usuario' )
                ],
                'direccion' => 'required|min:5',
                'usuario'     => [
                    'required',
                    'max:255',
                    Rule::unique('usuarios','usuario')->ignore( $registro->id_usuario, 'id_usuario' )
                ]
        ];

        if (trim($request->password) !=''){
            $rules['password'] = ['confirmed', 'min:5'];
        }
        
        $this->validate($request,$rules,[]);

        $valores = array();
        $valores['nombre'] = $request->nombre;
        $valores['apellido'] = $request->apellido;
        $valores['telefono'] = $request->telefono;
        $valores['email'] = $request->email;
        $valores['direccion'] = $request->direccion;
        $valores['usuario'] = $request->usuario;
        
        if (trim($request->password) !='')
        {
            $valores['password'] = bcrypt(trim($request->password));
        }

        $registro->update($valores);
        Session()->put('message-info', 'Usuario actualizado en la base de datos');

        return redirect()->route('usuarios');
    }

    public function eliminar(Request $request, $id)
    {
        
        $registro = User::where('id_usuario', $id)->first();

        if(!$registro){
            Session()->put('message-error', 'No se encontro el registro que esta buscando.');
            return redirect()->route('usuarios');
        }

        $registro->update(['esta_eliminado' => 1]);

        Session()->put('message-warning', 'Se ha inactivado al usuario: '.$registro->usuario);

        return redirect()->route('usuarios');
    }


    public function activar(Request $request, $id)
    {
        
        $registro = User::where('id_usuario', $id)->first();

        if(!$registro){
            Session()->put('message-error', 'No se encontro el registro que esta buscando.');
            return redirect()->route('usuarios');
        }

        $registro->update(['esta_eliminado' => 0]);

        Session()->put('message-info', 'Se ha activado al usuario: '.$registro->usuario);

        return redirect()->route('usuarios');
    }



}
