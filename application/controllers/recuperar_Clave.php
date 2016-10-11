<?php

class recuperar_Clave extends CI_Controller {

    // private $db_sistema_base;       
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('fmodel');
        $this->load->helper('date');
        $this->load->library('calendar');
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    public function recuperar() {

        $this->load->template('recuperarClave_view');
    }

//======================================================================================================================================================================//
//======================================================================================================================================================================//    
    public function actualizar_clave() {
       // print_r($POST);
        extract($_POST);
       
        $arrayData2[] = $correo;
        $arrayData2[] = $cedula;
 
        $data = $this->fmodel->consultas('modificar_usuario', $arrayData2);
        //print_r($data);
        //exit; 
        $this->session->set_flashdata('msg', 'SU MODIFICACION FUE REALIZADA CON EXITO');
        redirect('principal/login', 'refresh');        
        
       
    }
   
     public function usuario2() {
         $arrayData = array();

        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_rol'] = $this->fmodel->consultas('usuarios_roles', $arrayData);
        $this->load->template('usuario_view', $data);
        
        
       
    }
}
?>




