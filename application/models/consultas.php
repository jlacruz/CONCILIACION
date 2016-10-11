<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Consultas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no
    public function consultas($funcion,$parametros)
    {
		//$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL($funcion,$parametros);		
		return $consulta;	
    }	
}
?>