<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public static function isNull($value)
    {
        if (trim($value)=='' || $value == null) {
            return null;
        } else {
            return trim($value);
        }
    }
    
    public static function isNullRemplace($value)
    {
        if (trim($value)=='' || $value == null) {
            return null;
        } else {
            
            $search  = array('Á','É','Í','Ó','Ú','Ñ','Ü',"Ä","Ë","Ï","Ö","Ü","À","È","Ì","Ò","Ù",); 
            $replace = array('á','é','í','ó','ú','ñ', 'ü',"ä","ë","ï","ö","ü","à","è","ì","ò","ù"); 
            
            return str_replace($search,$replace,trim($value)); 
        }
    }}
