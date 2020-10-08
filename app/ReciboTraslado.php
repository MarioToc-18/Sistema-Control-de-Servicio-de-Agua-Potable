<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboTraslado extends Model
{
    
    protected $table = 'recibos_traslado';
    protected $primaryKey = 'id_recibo_traslado';

    protected $fillable = [
        'id_recibo_original', 
        'id_recibo_nuevo',
        'fecha_transaccion',
        'esta_eliminado'
    ];


}
