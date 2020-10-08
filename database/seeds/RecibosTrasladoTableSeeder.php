<?php

use Illuminate\Database\Seeder;
use App\ReciboTraslado;

class RecibosTrasladoTableSeeder extends Seeder
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
                'id_recibo_original' => 1, 
	            'id_recibo_nuevo' => 2,
	            'fecha_transaccion' => '2018-09-01',
            ]
        ];


        foreach($registros as $item){
            ReciboTraslado::create($item);
        }
    }
}
