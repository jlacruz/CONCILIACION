<?php

class Serviciocontroler extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('smodel');
        $this->load->helper('date');
        $this->load->library('calendar');
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    
    public function servicio() {
       
        $this->load->template('servicio_view');
    }
    
    public function registrar_servicio()  {
        //print_r($_POST);
        extract($_POST);


        $arrayData = array();
        $arrayData[] = $descripcion;
        
         $arrayData1[] = $descripcion;

        $this->db_conciliacion = $this->load->database('default', true);
       $data= $this->smodel->consultas('existe_servicio', $arrayData1);
       //print_r($data);
        
        //exit;
        $bandera=$data[0][0];
        
    if($bandera==1){
        
      echo'<script>
     alert("YA Existe Tipo de Servicio");
     window.location.href = "http://172.16.10.211/CONCILIACION/index.php/serviciocontroler/servicio";
     </script>';
      
    } else{
        
        
        $insertar_servicio = $this->smodel->consultas('insertar_servicio', $arrayData);
        //exit;

        $this->session->set_flashdata('msg', 'SU REGISTRO FUE REALIZADO CON EXITO');
        redirect('serviciocontroler/servicio', 'refresh');
    }
    
}


}

?>
