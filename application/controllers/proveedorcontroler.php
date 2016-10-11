<?php

class Proveedorcontroler extends CI_Controller {

    private $db_ubicacion_geografica;

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('pmodel');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->library('calendar');
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    public function proveedores() {
        $arrayData = array();
         

        $this->db_ubicacion_geografica = $this->load->database('default2', true);
        $data['lista_estados'] = $this->pmodel->consultas('consultar_estado', $arrayData);


        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_servicio'] = $this->pmodel->consultas('consultar_servicio', $arrayData);
        $data['lista_proveedores'] = $this->pmodel->consultas('consultar_proveedores', $arrayData);


        $this->load->template('proveedor_view', $data);
    }

    public function obtenerCiudad() {
        //print_r($_GET);
        extract($_GET);
        //exit;
        if ($id_estado!=''){
			
        $arrayData = array();
        $arrayData[] = $id_estado;

        $this->db_ubicacion_geografica = $this->load->database('default2', true);
        $datos_ciudad = $this->pmodel->consultas('consultar_ciudad', $arrayData);
       
        $comboCiudad = "<select name='ciudad' id='ciudad' required='required' class='form-control'>";
         $comboCiudad.="<option value=''>Seleccione...</option>";
   
        foreach ($datos_ciudad as $ciudad) {
            $comboCiudad.="<option value='" . $ciudad[1] . "'>$ciudad[0]</option>";
        }
        $comboCiudad.="</select>";

        echo $comboCiudad;
    }else{
		echo'<script>
        alert("Seleccione un Estado");
        window.location.href = "http://172.16.10.211/CONCILIACION/index.php/proveedorcontroler/proveedores";
        </script>';
		}
	}
              
  
       public function consultar_proveedor() 
     { 
     
        extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $nom_empresa;

        $this->db_conciliacion = $this->load->database('default', true);
        $data= $this->pmodel->consultas('existe_proveedor', $arrayData);
        //print_r($data);
 
        $bandera=$data[0][0];
        
     if($bandera==1){
        
      echo '1';
       
    }  else {
       echo '<input value="'.$nom_empresa.'"  type="text"  name="nom_empresa" id="nom_empresa" placeholder="Nombre de la Empresa" class="form-control" required pattern="[a-zA-Z0-9\s\.]{3,25}" onkeyup="javascript:this.value=this.value.toUpperCase()"/>';
      
        }
                    
    } 
    

    public function insertar_proveedor() {
        //$variablesSesion=$this->session->userdata('usuario');
        //print_r($_POST);
        extract($_POST);print_r($_POST);
        $id_servicio = $this->input->post("id_servicio");
        $nom_empresa = $this->input->post("nom_empresa");
        $rif = $this->input->post("rif");
        $estados = $this->input->post("estados");
        $ciudad = $this->input->post("ciudad");
        $direccion = $this->input->post("direccion");
        $persona_contacto_ = $this->input->post("persona_contacto_");
        $telefono = $this->input->post("telefono");
        $correo = $this->input->post("correo");
        $fecha = $this->input->post("fecha");
        $telefono2 = $this->input->post("telefono2");

        $arrayData = array(
                "id_servicio" => $id_servicio,
                "nom_empresa" => $nom_empresa,    
                "rif" => $rif,
                "estados" => $estados,               
                "ciudad" => $ciudad,
                "direccion" => $direccion,
                "persona_contacto_" => $persona_contacto_,  
                "telefono" => $telefono,
                "correo" => $correo,    
                "fecha" => $fecha,
                "telefono2" => $telefono2,                 
                );

        // $arrayData = array();
        // $arrayData[] = $id_servicio;
        // $arrayData[] = $nom_empresa;
        // $arrayData[] = $rif;
        // $arrayData[] = $estados;
        // $arrayData[] = $ciudad;
        // $arrayData[] = $direccion;
        // $arrayData[] = $persona_contacto_;
        // $arrayData[] = $telefono;
        // $arrayData[] = $correo;
        // $arrayData[] = $fecha;
        // $arrayData[] = $telefono2;
        //$arrayData[] = $variablesSesion["id_usuario"];
        
        //$arrayData1[] = $nom_empresa;

        $this->db_conciliacion = $this->load->database('default', true);
       //$data= $this->pmodel->consultas('existe_proveedor', $arrayData1);
       //print_r($data);
        
        //exit;
        //$bandera=$data[0][0];
        
        
        $insertar_proveedor = $this->pmodel->consultas('insertar_proveedor', $arrayData);
        //exit;
        //$this->session->set_flashdata('msg', 'SU REGISTRO FUE REALIZADO CON EXITO'); 
        //redirect('proveedorcontroler/proveedores', 'refresh');
    

}
    function listarProveedores() {
            $consultarListaProveedores = $this->consultas_listaProveedores > consultar_listaProveedores();
        }

   
    }

?>
