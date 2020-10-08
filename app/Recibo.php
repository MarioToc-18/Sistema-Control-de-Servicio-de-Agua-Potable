<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    
    protected $table = 'recibos';
    protected $primaryKey = 'id_recibo';

    protected $fillable = [
        'id_beneficiado_contador', 
        'fecha_lectura',
        'anio_lectura', 
        'mes_lectura', 
        'fecha_max_pago', 
        'serie', 
        'numero',
        'lectura_anterior',
        'lectura_actual', 
        'cuota_fija',
        'consumo',
        'exceso',
        'cuota_pendiente',
        'fecha_efectiva',
        'esta_trasladado',
        'esta_pagado',
        'esta_eliminado'
    ];

    public function traslados(){
        return $this->hasMany(ReciboTraslado::class, 'id_recibo', 'id_recibo_original');
    }

    public function contador(){
        return $this->belongsTo(BeneficiadoContador::class, 'id_beneficiado_contador', 'id_beneficiado_contador');
    }

}
