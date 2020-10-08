<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $usuarios = [
            [
            'nombre' => 'Mario',
            'apellido' => 'Toc',
            'telefono' => '42937421',
            'direccion' => 'Sololá, Sololá',
            'email' => 'mario.toc@htomail.com',
            'usuario' => 'mario.toc',
            'password' => bcrypt(123),
            'imagen' => 'img/perfil/sinfoto.png'
            ]
        ];


        foreach($usuarios as $usuario){
            User::create($usuario);
        }
    }
}
