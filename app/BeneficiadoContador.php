<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeneficiadoContador extends Model
{
    protected $table = 'beneficiados_contador';
    protected $primaryKey = 'id_beneficiado_contador';

    protected $fillable = [
        'id_beneficiado', 'rama', 'numero_contador', 'fecha_inicio', 'esta_eliminado'
    ];

    public function beneficiado(){
        return $this->belongsTo(Beneficiado::class, 'id_beneficiado', 'id_beneficiado');
    }

    public function recibos(){
        return $this->hasMany(Recibo::class, 'id_beneficiado_contador', 'id_beneficiado_contador');
    }

    public function nopagado(){
        return $this->hasMany(Recibo::class, 'id_beneficiado_contador', 'id_beneficiado_contador')
                    ->where('esta_pagado', FALSE);
    }

    

    public function getContadorFormatAttribute(){

        return str_pad($this->numero_contador, 4, "0", STR_PAD_LEFT);
    }
}
