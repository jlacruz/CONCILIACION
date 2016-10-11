<?php

class Cuentacontratocontroler extends CI_Controller {

    private $db_ubicacion_geografica;

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
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
		$this->configuraEmail=new configEmail();
		$this->load->library(array('session','form_validation','email'));
    }

    public function cuentacontrato() {
        $arrayData = array();
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->cmodel->consultas('consultar_proveedores', $arrayData);


        $this->load->template('cuentacontrato_view', $data);
    }
    
    
     public function actualizar_cuentacontrato() {
        $arrayData = array();
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->cmodel->consultas('consultar_proveedores', $arrayData);


        $this->load->template('actualizar_cuentacontrato_view', $data);
    }
    
    
 public function consultar_cuentacontrato() 
     { 
     
        extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $id_proveedor;
        $arrayData[] = $cuenta_contrato;

        $this->db_conciliacion = $this->load->database('default', true);
        $data= $this->cmodel->consultas('existe_cuentacontrato', $arrayData);
        //print_r($data);
 
        $bandera=$data[0][0];
        
     if($bandera==1){
        
      echo '1';
       
    }  else {
       echo '<input value="'.$cuenta_contrato.'"  type="text"  name="cuenta_contrato[]" id="cuenta_contrato" style="width:170px;" placeholder="Cuenta Contrato"  required pattern="[0-9]{1,18}"  
       class="form-control" title= "Sin caracteres especiales (-)"/> ';
      
        }
                    
    }
     function insertar_cuentacontrato() {
        $variablesSesion=$this->session->userdata('usuario');
        $id_proveedor = $_POST["proveedores"];
        $cantidad = count($_POST["cuenta_contrato"]);
        $id_usuario = $variablesSesion["id_usuario"];

       // print_r($_POST);

        if ($cantidad > 0) {
            for ($x = 0; $x < $cantidad; $x++) {

                $parametrosCtaCto = array();
                $parametrosCtaCto[] = "" . strtoupper($_POST["cuenta_contrato"][$x] . "");
                $parametrosCtaCto[] = $id_proveedor;


               // print_r($parametrosCtaCto);

                $insertar_cuentacontrato = $this->cmodel->consultas('insertar_cuentacontrato', $parametrosCtaCto);
                 //exit;
            }
            
        }
        $this->session->set_flashdata('msg', 'SU REGISTRO FUE REALIZADO CON EXITO');
        redirect('cuentacontratocontroler/cuentacontrato', 'refresh');
    }
    
    

   function buscar_cuentacontrato2() {
        $variablesSesion=$this->session->userdata('usuario');
        //print_r($variablesSesion);
        //print_r($_POST);
        extract($_POST);

        $arrayData = array();
        $arrayData[] = $proveedores;
        $arrayData[] = $cuenta_contrato;
        $arrayData1[] = $proveedores;
        $arrayData1[] = $cuenta_contrato;
        
         $this->db_conciliacion = $this->load->database('default', true);
       $data= $this->cmodel->consultas('existe_cuentacontrato', $arrayData1);
       //print_r($data);
               
        //exit;
        $bandera=$data[0][0];
        
    if($bandera!=1){
        
        echo'<script>
     alert("NO Existe esta Cuenta Contrato!");
     window.location.href = "http://172.16.10.211/CONCILIACION/index.php/cuentacontratocontroler/actualizar_cuentacontrato";
     </script>';     
                                                                   
    }else{
        
       $this->db_conciliacion = $this->load->database('default', true);
       $data= $this->cmodel->consultas('consultar_cuentacontrato_modificar', $arrayData);
       //print_r($data);
        $vars = array();
        $vars['v_id_contrato'] = $data[0][0];
        $vars['v_cuenta_contrato'] = $data[0][1];      
        $vars['v_nom_empresa'] = $data[0][2];      
       
       $this->load->template('modificar_cuentacontrato_view', $vars);
       
    }
  }
  
     public function modificar_cuentacontrato() {
        $variablesSesion=$this->session->userdata('usuario');
        //print_r($_post);
        $nombre=$variablesSesion['nombre'];
        $apellido=$variablesSesion['p_apellido'];
	    $nom_analista=$variablesSesion['nombre']." ".$variablesSesion['p_apellido'];
	    $arrayData1[] = $nom_analista;

        $arrayData[] = $_POST['id_contrato'];
        $arrayData[] = $_POST['cuenta_contrato'];
        $arrayData[] = $_POST['estatus'];
      
        $modificar_cuenta_contrato = $this->cmodel->consultas('modificar_cuenta_contrato', $arrayData);
        //print_r($modificar_cuenta_contrato);
       
        
        if ($modificar_cuenta_contrato[0][0]=='1'){
					
		 $configuracionSrvCorreo=$this->configuraEmail->configSrvEmail();
		 $this->email->initialize($configuracionSrvCorreo);
		 $this->email->from('sisconser@mijp.gob.ve', 'Sisconser' );
		 $this->email->to('franciscojavierlacruz@gmail.com,conciliacion@mijp.gob.ve, dcalzadilla@mijp.gob.ve');
		 $this->email->subject( 'Modificacion de Cuenta Contrato' );
		 $this->email->message("Se ha Modificado la Siguiente Cuenta Contrato: ".$arrayData[1]. " Por el Usuario: ".$arrayData1[0]);
		 $this->email->send();
		 
		 
		 $this->session->set_flashdata('msg', 'SU MODIFICACION FUE REALIZADA CON EXITO');		
        redirect('cuentacontratocontroler/actualizar_cuentacontrato', 'refresh');
		
	     }
        
    }
  
}
?>
