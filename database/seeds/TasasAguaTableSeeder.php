<?php

use Illuminate\Database\Seeder;
Use App\TasaAgua;

class TasasAguaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $registros = [
            [ 'medida' => 1000, 'costo' => 2.5, 'total' => 2.5],
            [ 'medida' => 2000, 'costo' => 2.5, 'total' => 5],
            [ 'medida' => 3000, 'costo' => 2.5, 'total' => 7.5],
            [ 'medida' => 4000, 'costo' => 2.5, 'total' => 10],
            [ 'medida' => 5000, 'costo' => 2.5, 'total' => 12.5],
            [ 'medida' => 6000, 'costo' => 3, 'total' => 15.5],
            [ 'medida' => 7000, 'costo' => 3, 'total' => 18.5],
            [ 'medida' => 8000, 'costo' => 3, 'total' => 21.5],
            [ 'medida' => 9000, 'costo' => 3, 'total' => 24.5],
            [ 'medida' => 10000, 'costo' => 3, 'total' => 27.5],
            [ 'medida' => 11000, 'costo' => 3.5, 'total' => 31],
            [ 'medida' => 12000, 'costo' => 3.5, 'total' => 34.5],
            [ 'medida' => 13000, 'costo' => 3.5, 'total' => 38],
            [ 'medida' => 14000, 'costo' => 3.5, 'total' => 41.5],
            [ 'medida' => 15000, 'costo' => 3.5, 'total' => 45],
            [ 'medida' => 16000, 'costo' => 4, 'total' => 49],
            [ 'medida' => 17000, 'costo' => 4, 'total' => 53],
            [ 'medida' => 18000, 'costo' => 4, 'total' => 57],
            [ 'medida' => 19000, 'costo' => 4, 'total' => 61],
            [ 'medida' => 20000, 'costo' => 4, 'total' => 65],
            [ 'medida' => 21000, 'costo' => 5, 'total' => 70],
            [ 'medida' => 22000, 'costo' => 5, 'total' => 75],
            [ 'medida' => 23000, 'costo' => 5, 'total' => 80],
            [ 'medida' => 24000, 'costo' => 5, 'total' => 85],
            [ 'medida' => 25000, 'costo' => 5, 'total' => 90],
            [ 'medida' => 26000, 'costo' => 5, 'total' => 95],
            [ 'medida' => 27000, 'costo' => 5, 'total' => 100],
            [ 'medida' => 28000, 'costo' => 5, 'total' => 105],
            [ 'medida' => 29000, 'costo' => 5, 'total' => 110],
            [ 'medida' => 30000, 'costo' => 5, 'total' => 115],
            [ 'medida' => 31000, 'costo' => 5, 'total' => 120],
            [ 'medida' => 32000, 'costo' => 5, 'total' => 125],
            [ 'medida' => 33000, 'costo' => 5, 'total' => 130],
            [ 'medida' => 34000, 'costo' => 5, 'total' => 135],
            [ 'medida' => 35000, 'costo' => 5, 'total' => 140],
            [ 'medida' => 36000, 'costo' => 5, 'total' => 145],
            [ 'medida' => 37000, 'costo' => 5, 'total' => 150],
            [ 'medida' => 38000, 'costo' => 5, 'total' => 155],
            [ 'medida' => 39000, 'costo' => 5, 'total' => 160],
            [ 'medida' => 40000, 'costo' => 5, 'total' => 165],
            [ 'medida' => 41000, 'costo' => 5, 'total' => 170],
            [ 'medida' => 42000, 'costo' => 5, 'total' => 175],
            [ 'medida' => 43000, 'costo' => 5, 'total' => 180],
            [ 'medida' => 44000, 'costo' => 5, 'total' => 185],
            [ 'medida' => 45000, 'costo' => 5, 'total' => 190],
            [ 'medida' => 46000, 'costo' => 5, 'total' => 195],
            [ 'medida' => 47000, 'costo' => 5, 'total' => 200],
            [ 'medida' => 48000, 'costo' => 5, 'total' => 205],
            [ 'medida' => 49000, 'costo' => 5, 'total' => 210],
            [ 'medida' => 50000, 'costo' => 5, 'total' => 215],
            [ 'medida' => 51000, 'costo' => 5, 'total' => 220],
            [ 'medida' => 52000, 'costo' => 5, 'total' => 225],
            [ 'medida' => 53000, 'costo' => 5, 'total' => 230],
            [ 'medida' => 54000, 'costo' => 5, 'total' => 235],
            [ 'medida' => 55000, 'costo' => 5, 'total' => 240],
            [ 'medida' => 56000, 'costo' => 5, 'total' => 245],
            [ 'medida' => 57000, 'costo' => 5, 'total' => 250],
            [ 'medida' => 58000, 'costo' => 5, 'total' => 255],
            [ 'medida' => 59000, 'costo' => 5, 'total' => 260],
            [ 'medida' => 60000, 'costo' => 5, 'total' => 265],
            [ 'medida' => 61000, 'costo' => 5, 'total' => 270],
            [ 'medida' => 62000, 'costo' => 5, 'total' => 275],
            [ 'medida' => 63000, 'costo' => 5, 'total' => 280],
            [ 'medida' => 64000, 'costo' => 5, 'total' => 285],
            [ 'medida' => 65000, 'costo' => 5, 'total' => 290],
            [ 'medida' => 66000, 'costo' => 5, 'total' => 295],
            [ 'medida' => 67000, 'costo' => 5, 'total' => 300],
            [ 'medida' => 68000, 'costo' => 5, 'total' => 305],
            [ 'medida' => 69000, 'costo' => 5, 'total' => 310],
            [ 'medida' => 70000, 'costo' => 5, 'total' => 315],
            [ 'medida' => 71000, 'costo' => 5, 'total' => 320],
            [ 'medida' => 72000, 'costo' => 5, 'total' => 325],
            [ 'medida' => 73000, 'costo' => 5, 'total' => 330],
            [ 'medida' => 74000, 'costo' => 5, 'total' => 335],
            [ 'medida' => 75000, 'costo' => 5, 'total' => 340],
            [ 'medida' => 76000, 'costo' => 5, 'total' => 345],
            [ 'medida' => 77000, 'costo' => 5, 'total' => 350],
            [ 'medida' => 78000, 'costo' => 5, 'total' => 355],
            [ 'medida' => 79000, 'costo' => 5, 'total' => 360],
            [ 'medida' => 80000, 'costo' => 5, 'total' => 365],
            [ 'medida' => 81000, 'costo' => 5, 'total' => 370],
            [ 'medida' => 82000, 'costo' => 5, 'total' => 375],
            [ 'medida' => 83000, 'costo' => 5, 'total' => 380],
            [ 'medida' => 84000, 'costo' => 5, 'total' => 385],
            [ 'medida' => 85000, 'costo' => 5, 'total' => 390],
            [ 'medida' => 86000, 'costo' => 5, 'total' => 395],
            [ 'medida' => 87000, 'costo' => 5, 'total' => 400],
            [ 'medida' => 88000, 'costo' => 5, 'total' => 405],
            [ 'medida' => 89000, 'costo' => 5, 'total' => 410],
            [ 'medida' => 90000, 'costo' => 5, 'total' => 415],
            [ 'medida' => 91000, 'costo' => 5, 'total' => 420],
            [ 'medida' => 92000, 'costo' => 5, 'total' => 425],
            [ 'medida' => 93000, 'costo' => 5, 'total' => 430],
            [ 'medida' => 94000, 'costo' => 5, 'total' => 435],
            [ 'medida' => 95000, 'costo' => 5, 'total' => 440],
            [ 'medida' => 96000, 'costo' => 5, 'total' => 445],
            [ 'medida' => 97000, 'costo' => 5, 'total' => 450],
            [ 'medida' => 98000, 'costo' => 5, 'total' => 455],
            [ 'medida' => 99000, 'costo' => 5, 'total' => 460],
            [ 'medida' => 100000, 'costo' => 5, 'total' => 465]

        ];

        foreach($registros as $registro){
            TasaAgua::create($registro);
        } 


    }
}
