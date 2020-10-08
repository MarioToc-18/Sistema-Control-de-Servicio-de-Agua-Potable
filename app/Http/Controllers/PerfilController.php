<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;

class PerfilController extends Controller
{
    public function editar($id)
    {
        $registro = User::where('id_usuario', $id)->first();
        if(!$registro){
            Session()->put('message-error', 'No se encontro el registro que esta buscando');
            return redirect()->route('inicio');
        }

        return view('perfil.editar', compact('registro'));
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
        ];
        
        $this->validate($request,$rules,[]);

        $valores = array();
        $valores['nombre'] = $request->nombre;
        $valores['apellido'] = $request->apellido;
        $valores['telefono'] = $request->telefono;
        $valores['email'] = $request->email;
        $valores['direccion'] = $request->direccion;

        $registro->update($valores);
        Session()->put('message-info', 'Perfil actualizado en la base de datos');

        return redirect()->route('inicio');
    }

    public function usuario($id)
    {
        $registro = User::where('id_usuario', $id)->first();
        if(!$registro){
            Session()->put('message-error', 'No se encontro el registro que esta buscando');
            return redirect()->route('inicio');
        }

        return view('perfil.usuario', compact('registro'));
    }



    public function actualizarUsuario(Request $request, $id)
    {

        $registro = User::where('id_usuario', $id)->first();

        $rules = [
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
        $valores['usuario'] = $request->usuario;
        
        if (trim($request->password) !='')
        {
            $valores['password'] = bcrypt(trim($request->password));
        }

        $registro->update($valores);
        Session()->put('message-info', 'Usuario actualizado en la base de datos');

        return redirect()->route('inicio');
    }

}
