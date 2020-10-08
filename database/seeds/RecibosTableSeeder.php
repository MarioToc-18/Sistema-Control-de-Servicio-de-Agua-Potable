<?php

use Illuminate\Database\Seeder;
use App\Recibo;

class RecibosTableSeeder extends Seeder
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
            'id_recibo' => 1,
            'id_beneficiado_contador' => 1,
			'fecha_lectura'=> '2018-08-01',
			'mes_lectura'=> 8,
            'anio_lectura'=> 2018,
			'fecha_max_pago'=> '2018-08-16',
			'serie'=> 'A',
			'numero'=> 101,
			'lectura_anterior'=> null,
			'lectura_actual'=> 6000,
			'cuota_fija'=> 10.00,
			'consumo'=> 15.50,
			'exceso'=> null,
            'cuota_pendiente'=> null,
			'total'=> 25.50,
			'fecha_efectiva'=> null,
			'esta_trasladado'=> true,
			'esta_pagado'=> false,
			'esta_eliminado'=> false
            ],
            [
            'id_recibo' => 2,
            'id_beneficiado_contador' => 1,
            'fecha_lectura'=> '2018-09-01',
            'mes_lectura'=> 9,
            'anio_lectura'=> 2018,
            'fecha_max_pago'=> '2018-09-16',
            'serie'=> 'A',
            'numero'=> 102,
            'lectura_anterior'=> 6000,
            'lectura_actual'=> 12000,
            'cuota_fija'=> 10.00,
            'consumo'=> 15.50,
            'exceso'=> null,
            'cuota_pendiente'=> 25.50,
            'total'=> 51.00,
            'fecha_efectiva'=> null,
            'esta_trasladado'=> false,
            'esta_pagado'=> false,
            'esta_eliminado'=> false
            ]
        ];


        foreach($registros as $item){
            Recibo::create($item);
        }
    }
}

