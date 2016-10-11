<?php

class Consulta_controler extends CI_Controller {

    private $db_ubicacion_geografica;

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('cmodel');
        $this->load->helper('date');
        $this->load->library('calendar');
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    public function consultar() {
        $arrayData = array();
        $this->db_faov = $this->load->database('default', true);

        $this->load->template('consulta_view');
    }
    
    
    public function gestionar() {
        print_r($_POST);
        extract($_POST);
        $arrayData = array();

        $arrayData[] = $anio;
        $arrayData[] = $mes;
        
        $this->db_sigefirrhh= $this->load->database('default2', true);
        $data = $this->cmodel->consultas('consultar_registros_faov', $arrayData);
        //print_r($data);             
         
        $ar=fopen("txt/".$_POST['anio']."-".$_POST['mes'].".txt","a") or
        die("Problemas en la creacion");
        foreach ($data as $columnas) {
        
       fputs($ar,$columnas[0].",");
       fputs($ar,$columnas[1].",");
       fputs($ar,$columnas[2].",");
       fputs($ar,$columnas[3].",");
       fputs($ar,$columnas[3].",");
       fputs($ar,$columnas[4].",");
       fputs($ar,$columnas[5].",");
       fputs($ar,$columnas[6].",");
       fputs($ar,$columnas[7].",");
       fputs($ar,$columnas[8]);
       fputs($ar,"\n");
       //fputs($ar,"--------------------------------------------------------");
       //fputs($ar,"\n");
      
       
         }
         //echo "Los datos se cargaron correctamente.";
            $this->load->template('txt_view');
        
          fclose($ar);
          
      }
     //El txt archivo txt ha sido generado exitosamente, para descargar el archivo haga clic aquí: <a href="/txt/".$anio."-".$mes.".txt">
}

?>


