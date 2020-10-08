<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeneficiadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiados', function (Blueprint $table) {
            $table->increments('id_beneficiado');
            $table->string('nit')->unique()->nullable();
            $table->string('cui')->unique()->nullable();
            $table->string('nombre1');
            $table->string('nombre2')->nullable();
            $table->string('apellido1');
            $table->string('apellido2')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->default('Chaquijyá, Sololá');
            $table->string('email')->nullable();
            $table->boolean('esta_eliminado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiados');
        
    }
}
