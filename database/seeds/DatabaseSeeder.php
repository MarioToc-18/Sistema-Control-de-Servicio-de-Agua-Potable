<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BeneficiadosTableSeeder::class);
        $this->call(BeneficiadosContadorTableSeeder::class);
        $this->call(RecibosTableSeeder::class);
        $this->call(RecibosTrasladoTableSeeder::class);
        $this->call(TasasAguaTableSeeder::class);
    }
}
