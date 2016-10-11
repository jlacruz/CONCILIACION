<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bienvenida extends CI_Controller 
{
	
	public function __construct()
    {
		parent::__construct();
		
		$this->load->helper(array('url','form','captcha')); 
		
		//$this->load->library('session');
		$this->load->library(array('session','form_validation','email'));
		//$this->load->database('default');
		
		$this->load->model('consultas_usuarios');	
	        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
		$this->configuraEmail=new configEmail();
	}
	public function index()
	{
		$variablesSesion=$this->session->userdata('usuario');
		//print_r($variablesSesion);
		$this->load->template('bienvenida');	    
	}
	
}