<?php

class Consulproveedorcontroler extends CI_Controller {

    private $db_UBICACION_GEOGRAFICA;       
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('cpmodel');
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

    public function consulta() {

        $arrayData = array();
        
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->cpmodel->consultas('consultar_proveedores', $arrayData);
        

        $this->load->template('consulproveedor_view', $data);
    }
    
    public function consultaModificar() {

        $arrayData = array();
        
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->cpmodel->consultas('consultar_proveedores', $arrayData);
        

        $this->load->template('consulproveedor2_view', $data);
    }
  
      
    public function consultar_cuenta_contrato() {


        extract($_GET);

        $arrayData = array();
        $arrayData[] = $id_proveedor;
        $arrayData1[] = $id_proveedor;

        $this->db_conciliacion = $this->load->database('default', true);
        $datos_cuenta = $this->cpmodel->consultas('consultar_cuentacontrato', $arrayData);
         $existe_cuentacontrato = $this->cpmodel->consultas('existe_cuentacontrato_proveedor', $arrayData1);
        //print_r($existe_cuentacontrato);
        $bandera=$existe_cuentacontrato[0][0];
        
        if($bandera==0){
        
         echo'<script>
        alert("No Posee Cuentas Contrato Asociadas, Debe registrar una Nueva Cuenta Contrato");
         window.location.href = "http://172.16.10.211/CONCILIACION/index.php/cuentacontratocontroler/cuentacontrato";
         </script>';
            
          }else{ 
        $comboCuenta = "<select name='cuenta_contrato' id='cuenta_contrato' required='required'class='form-control'>";
        foreach ($datos_cuenta as $cuenta_contrato) {
         
            $comboCuenta.="<option value='" . $cuenta_contrato[0] . "'>$cuenta_contrato[1]</option>";
        }
        $comboCuenta.="</select>";

        echo $comboCuenta;
    }
}

    public function consultar_datosproveedor() {
        extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $id_proveedor;

        $this->db_conciliacion = $this->load->database('default', true);
        $data = $this->cpmodel->consultas('consultar_proveedorfactura', $arrayData);

        $cod_proveedor = $data[0][0];
        $descripcion = $data[0][1];
        $rif = $data[0][2];
        $direccion = $data[0][3];
        $persona_contacto = $data[0][4];
        $telefono = $data[0][5];
        $correo = $data[0][6];     
        $estado = $data[0][7];
        $ciudad = $data[0][8];
        $telefono2 = $data[0][9];
        echo $cod_proveedor . "~" . $descripcion . "~" . $rif . "~" . $direccion . "~" . $persona_contacto . "~" . $telefono . "~" . $correo . "~" . $estado . "~" . $ciudad . "~" . $telefono2;

        //return $data;
    }

     public function actualizar_proveedor() {
        $variablesSesion=$this->session->userdata('usuario');
        //print_r($_post);
        $nombre=$variablesSesion['nombre'];
        $apellido=$variablesSesion['p_apellido'];
	    $nom_analista=$variablesSesion['nombre']." ".$variablesSesion['p_apellido'];
	    $arrayData1[] = $nom_analista;
	    
	     $arrayData[] = $_POST['proveedores'];
	     $arrayData[] = $_POST['rif'];
	     $arrayData[] = $_POST['direccion'];
	     $arrayData[] = $_POST['persona_contacto'];
	     $arrayData[] = $_POST['telefono'];
	     $arrayData[] = $_POST['correo'];
	     $arrayData[] = $_POST['telefono2'];
      
        $modificar_proveedor = $this->cpmodel->consultas('modificar_proveedor', $arrayData);
        if ($modificar_proveedor[0][0]=='1'){
					
		 $configuracionSrvCorreo=$this->configuraEmail->configSrvEmail();
		 $this->email->initialize($configuracionSrvCorreo);
		 $this->email->from('sisconser@mijp.gob.ve', 'Sisconser' );
		 $this->email->to('franciscojavierlacruz@gmail.com','flcruz@mijp.gob.ve');
		 $this->email->subject( 'Modificacion de Datos de Proveedores' );
		 $this->email->message("Se ha Modificado El Proveedor: ".$arrayData[0]. " Por el Usuario: ".$arrayData1[0]);
		 $this->email->send();
		 
		$this->session->set_flashdata('msg', 'SU MODIFICACION FUE REALIZADA CON EXITO');
        redirect('consulproveedorcontroler/consulta', 'refresh');
		
	     }
        
    }

    public function listar_proveedores() {
        extract($_POST);

        $this->db_conciliacion = $this->load->database('default', true);
        $data2['lista'] = $this->cpmodel->consultas('listar_proveedor', $arrayData);
        print_r($data2);

        $nom_empresa = $data2[0][0];
        $cod_proveedor = $data2[0][1];
        $descripcion = $data2[0][2];
       
        echo $nom_empresa . "~" .$cod_proveedor . "~" . $descripcion;

        //return $data;
    }
}

?>

