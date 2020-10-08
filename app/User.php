<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre', 'apellido','telefono', 'email', 'direccion', 'usuario', 'password','esta_eliminado'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getEstadoAttribute()
    {
        if($this->esta_eliminado == true){
            return 'Inactivo';
        }else{
            return 'Activo';
        }
    }

    public function getNombresAttribute()
	{
	    return trim($this->nombre.' '.$this->apellido);
	}

    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre.' '.$this->apellido);
    }
}
