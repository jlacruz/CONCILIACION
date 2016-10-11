<?php

class Usuariocontroler extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('umodel');
        $this->load->helper('date');
        $this->load->library('calendar');
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    
    public function usuario() {
       
        $this->load->template('usuario_view');
    }
    public function roles() {
        $arrayData = array();

        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_rol'] = $this->umodel->consultas('usuarios_roles', $arrayData);

        $this->load->template('usuario_view', $data);
    }
    
     public function proveedores() {
        $arrayData = array();

        $this->db_ubicacion_geografica = $this->load->database('default2', true);
        $data['lista_estados'] = $this->umodel->consultas('consultar_estado', $arrayData);


        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_servicio'] = $this->umodel->consultas('consultar_servicio', $arrayData);
        $data['lista_proveedores'] = $this->umodel->consultas('consultar_proveedores', $arrayData);


        $this->load->template('proveedor_view', $data);
    }
   
    public function consultar_usuario() 
     { 
     
        extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $cedula;

        $this->db_conciliacion = $this->load->database('default', true);
        $data= $this->umodel->consultas('existe_usuario', $arrayData);
        //print_r($data);
 
        $bandera=$data[0][0];
        
     if($bandera==1){
        
      echo '1';
       
    }  else {
       echo '<input value="'.$cedula.'"  type="text"  name="cedula" id="cedula"  placeholder="Cedula"  required pattern="[0-9]{7,10}"  maxlength="12" size="22" autocomplete="off"
       class="form-control" title= "Registre su Nro de Cedula"/> ';
      
        }
     }               

    
    public function registrar_usuario() {
        //print_r($_POST);
        extract($_POST);


        $arrayData = array();
        $arrayData[] = $cedula;
        $arrayData1[] = $cedula;
        $arrayData[] = $usuario;
        $arrayData[] = md5($clave);
        $arrayData[] = $p_nombre;
        $arrayData[] = $s_nombre;
        $arrayData[] = $p_apellido;
        $arrayData[] = $s_apellido;
        $arrayData[] = $telefono_local;
        $arrayData[] = $telefono_celular;
        $arrayData[] = $correo;
        $arrayData[] = $correo2;
        $arrayData[] = $rol;
        $arrayData[] = $titulo;
        
        
        $consultar_usuario = $this->umodel->consultas('existe_usuario', $arrayData1);
        //print_r($consultar_usuario);
         $bandera=$consultar_usuario[0][0];
        
         if($bandera==1 ){
			echo'<script>
        alert("Ya Existe un Usuario Registrado cin este Nro de Cedula");
        window.location.href = "http://172.16.10.211/CONCILIACION/index.php/usuariocontroler/roles";
        </script>';
			
		} else{
        
        $insertar_usuario = $this->umodel->consultas('usuarios_guardar', $arrayData);
        //exit;
        
        $this->session->set_flashdata('msg', 'SU REGISTRO FUE REALIZADO CON EXITO');
        redirect('usuariocontroler/roles', 'refresh');
    }

}
    



}

?>
