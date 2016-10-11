<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class fechas 
{
    function nombreMes($mes)
	{
		setlocale(LC_TIME, 'spanish');
		$nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
		return $nombre;
	} 
	function hora($hora,$minuto,$segundo)
	{
		//setlocale(LC_TIME, 'spanish');
		//$nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000));
		if($hora<12)
		{
			$am_pm="a.m";	
		}
		else
		{
			$am_pm="p.m";	
		}
		switch($hora)
		{
			case 13:
			$hora=1;
			break;
			
			case 14:
			$hora=2;
			break;
			
			case 15:
			$hora=3;
			break;
			
			case 16:
			$hora=4;
			break;
			
			case 17:
			$hora=5;
			break;
			
			case 18:
			$hora=6;
			break;
			
			case 19:
			$hora=7;
			break;
			
			case 20:
			$hora=8;
			break;
			
			case 21:
			$hora=9;
			break;
			
			case 22:
			$hora=10;
			break;
			
			case 23:
			$hora=11;
			break;
			
			case 00:
			$hora=12;
			break;
			
		}
		return $hora.":".$minuto.":".$segundo." ".$am_pm;
	} 
}