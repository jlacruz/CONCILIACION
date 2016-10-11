<?php

class Pmodel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
 public function consultas($funcion,$parametros)
    {
		$consulta=$this->db->SELECTPLSQL($funcion,$parametros);		
		return $consulta;	
    }	
 
 public function consultas_ciudad($id_estado)
    {
		$consulta=$this->db->SELECTPLSQL($id_estado);		
		return $consulta;	
    }	

}
?>

