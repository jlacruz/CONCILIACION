<?php

class Fmodel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
 public function consultas($funcion,$parametros)
    {
		$consulta=$this->db->SELECTPLSQL($funcion,$parametros);		
		return $consulta;	
    }	

       
}
?>

