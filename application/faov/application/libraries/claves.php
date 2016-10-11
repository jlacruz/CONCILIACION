<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class claves 
{
    function generar_clave($longitud)
	{ 
           $cadena="[^A-Z0-9]"; 
           return substr(preg_replace($cadena, "", md5(rand())) . 
           preg_replace($cadena, "", md5(rand())) . 
           preg_replace($cadena, "", md5(rand())), 
           0, $longitud); 
    } 
    //Ejemplo de utilización para una clave de 10 caracteres: 
}