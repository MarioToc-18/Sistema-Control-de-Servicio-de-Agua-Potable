<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiado extends Model
{
    protected $table = 'beneficiados';
    protected $primaryKey = 'id_beneficiado';

    protected $fillable = [
        'nit', 'cui', 'nombre1', 'nombre2', 'apellido1', 'apellido2', 'telefono','direccion','email', 'esta_eliminado'
    ];


    public function getNombreCompletoAttribute()
	{
		$nombre = trim($this->nombre1.' '.$this->nombre2.' '.$this->apellido1.' '.$this->apellido2) ;
	    $nombre = str_replace("  ", " ", $nombre);
	    return $nombre;
	}

    public function contadores(){
        return $this->hasMany(BeneficiadoContador::class, 'id_beneficiado', 'id_beneficiado');
    }

    
}
