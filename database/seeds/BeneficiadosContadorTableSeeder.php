<?php

use Illuminate\Database\Seeder;
use App\BeneficiadoContador;

class BeneficiadosContadorTableSeeder extends Seeder
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
            'id_beneficiado_contador'=> 1,
            'id_beneficiado' => 1,
            'rama' => 1,
            'numero_contador' => 1,
            'fecha_inicio' => '2018-09-01'
            ]
        ];


        foreach($registros as $item){
            BeneficiadoContador::create($item);
        }
    }
}
