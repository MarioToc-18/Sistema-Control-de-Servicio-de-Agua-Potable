<?php

use Illuminate\Database\Seeder;
use App\Beneficiado;

class BeneficiadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $registros = [
            [
            'nombre1' => 'Mario',
            'nombre2' => null,
            'apellido1' => 'Toc',
            'apellido2' => null,
            'telefono' => '42937421',
            'direccion' => 'Sololá, Sololá'
            ],
            ['nombre1'=>'Esteban', 'nombre2'=> 'Saturnino', 'apellido1'=>'Cosiguá', 'apellido2'=>'Par'],
            ['nombre1'=>'Jose', 'nombre2'=> 'Maria', 'apellido1'=>'Palax', 'apellido2'=>'Roquel'],
            ['nombre1'=>'Alberto', 'nombre2'=> null, 'apellido1'=>'Palax', 'apellido2'=>'Guarcax'],
            ['nombre1'=>'Mario', 'nombre2'=> 'Alberto', 'apellido1'=>'Palax', 'apellido2'=>'Roquel'],
            ['nombre1'=>'Juan', 'nombre2'=> 'Antonio', 'apellido1'=>'Palax', 'apellido2'=>'Roquel'],
            ['nombre1'=>'Regina', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Guarcax'],
            ['nombre1'=>'Camilo', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Guarcax'],
            ['nombre1'=>'Lucio', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Chiyal'],
            ['nombre1'=>'Alfredo', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Guarcax'],
            ['nombre1'=>'Rufino', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Guarcax'],
            ['nombre1'=>'Francisco', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Sicajau'],
            ['nombre1'=>'Bernardo', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Pablo'],
            ['nombre1'=>'Antonio', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Sicajau'],
            ['nombre1'=>'Gregorio', 'nombre2'=> null, 'apellido1'=>'Saloj', 'apellido2'=>'Julajuj'],
            ['nombre1'=>'Esteban', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Ajú'],
            ['nombre1'=>'Juana', 'nombre2'=> null, 'apellido1'=>'Magzul', 'apellido2'=>'Cumes'],
            ['nombre1'=>'Marcelo', 'nombre2'=> null, 'apellido1'=>'Gonzáles', 'apellido2'=>'Guarcax'],
            ['nombre1'=>'Iglesia', 'nombre2'=> null, 'apellido1'=>'Roca de los Siglos', 'apellido2'=>null],
            ['nombre1'=>'Pablo', 'nombre2'=> null, 'apellido1'=>'Quisquina', 'apellido2'=>'Solares']

        ];


        foreach($registros as $item){
            Beneficiado::create($item);
        }
    }
}
