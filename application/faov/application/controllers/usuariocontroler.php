<?php

class Usuariocontroler extends CI_Controller {

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

    
    public function usuario() {
       
        $this->load->template('usuario_view');
    }
    public function roles() {
        $arrayData = array();

        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_rol'] = $this->cmodel->consultas('usuarios_roles', $arrayData);

        $this->load->template('usuario_view', $data);
    }
    
     public function proveedores() {
        $arrayData = array();

        $this->db_ubicacion_geografica = $this->load->database('default2', true);
        $data['lista_estados'] = $this->cmodel->consultas('consultar_estado', $arrayData);


        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_servicio'] = $this->cmodel->consultas('consultar_servicio', $arrayData);
        $data['lista_proveedores'] = $this->cmodel->consultas('consultar_proveedores', $arrayData);


        $this->load->template('proveedor_view', $data);
    }
   
   
    public function consultar_usuario() {
        //print_r($_POST);
        extract($_POST);


        $arrayData = array();
        $arrayData1[] = $cedula;
              
        $consultar_usuario = $this->cmodel->consultas('existe_usuario', $arrayData1);
        //print_r($consultar_usuario);
         $bandera=$consultar_usuario[0][0];
        
         if($bandera==1 ){
			echo'<script>
        alert("Ya Existe un Usuario Registrado con este Nro de Cedula");      
        </script>';
         echo '<input  id="cedula" name="cedula" type="text" size="12" required="required" class = "form-control" onkeyup ="javascript:this.value=this.value.toUpperCase()" 
         placeholder="Cedula" required pattern="[0-9]{7,10}" title=\'Cargue su Nro de C&eacute;dula\'>';       			
		
		} 
		else {
        echo '<input value="'.$cedula.'" id="cedula" name="cedula" type="text" size="12" class = "form-control" required="required" onkeyup ="javascript:this.value=this.value.toUpperCase()" 
        placeholder="Cedula" required pattern="[0-9]{7,10}" title=\'Cargue su Nro de C&eacute;dula\'>';
       
           }

        }

    
    public function registrar_usuario() {
        //print_r($_POST);
        extract($_POST);


        $arrayData = array();
        $arrayData[] = $cedula;
        $arrayData[] = $usuario;
        $arrayData[] = md5($clave);
        $arrayData2[] = md5($confirmar_clave);           
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
        

		 if($clave!=$confirmar_clave){
			echo'<script>
        alert("Las Claves NO Coinciden");
        window.location.href = "http://localhost/modelo/index.php/usuariocontroler/roles";
        </script>';
	    }else{
        
        $insertar_usuario = $this->cmodel->consultas('usuarios_guardar', $arrayData);
        //exit;
        
        $this->session->set_flashdata('msg', 'SU REGISTRO FUE REALIZADO CON EXITO');
        redirect('usuariocontroler/roles', 'refresh');
    }

}
   public function registrar()
	{
		//print_r($_POST);
		extract($_POST);
		$arrayData = array();
        $arrayData[] = $rif;
        $arrayData[] = $correo;
        $arrayData[] = md5 ($pw);
		$fecha_registro=date ('Y-m-d');
		//print_r($arrayData);
		$insertarUser = $this->cmodel->consultas('insertar_usuario_empresa', $arrayData);
		if ($insertarUser[0][0]=='1'){
		echo "<script>
					alert('EL USUARIO YA SE ENCUENTRA REGITRADO');
					</script>";
				
			 redirect('principal/registro', 'refresh');
				
				}else{
					
		 $configuracionSrvCorreo=$this->configuraEmail->configSrvEmail();
		 $this->email->initialize($configuracionSrvCorreo);
		 $this->email->from('correspondencia@mijp.gob.ve', 'Sistema Digesevisp' );
		 $this->email->to($correo);
		 $this->email->subject( 'Creacion de usuario sistema DIGESERVISP' );
		 $this->email->message("Su usuario es el siguiente: ".$correo. " y su clave es: ".$pw);
		 $this->email->send();
		
				echo "<script>
					alert('USUARIO REGISTRADO CON EXITO');
					</script>";
				
		 redirect('bienvenida/bienvenida', 'refresh');
		 
		 
 }
}

}

?>
