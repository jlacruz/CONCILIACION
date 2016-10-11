<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller 
{
	
	public function __construct()
    {
		parent::__construct();
		
		$this->load->helper(array('url','form','captcha')); 
		
		$this->load->library('session');
		$this->load->library(array('session','form_validation','email'));
		$this->load->database('default');
		
		$this->load->model('consultas_usuarios');
		$this->load->model('fmodel');		
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
		// si no existe la sesión con la variable 'usuario_id'
		if ($variablesSesion['cedula']=="")
		{
			// redirigimos a la función login
			if($this->session->flashdata('msg')==3)
			{
				$this->session->set_flashdata('msg','Usuario o contraseña incorrectos');
			}
			redirect('principal/login', 'refresh');
		}
		else
		{
			// en caso contrario cargamos la vista principal
			$vars=array();
			//redirect('bandejas/listar', 'refresh');
			redirect('bienvenida', 'refresh');
		}
	}
	function login()
	{
		//Destruir Sesión
		//exit;
		if ($this->input->post('usuario'))
		{
			//exit;
			//Recogemos las variables 'usuario' y 'contrasena'
			$usuario = $this->input->post('usuario');
			$clave = md5($this->input->post('clave'));
			// cargamos el modelo para verificar el usuario/contraseña
			// si el usuario y contraseña son correctos
			$consultarUsuario=$this->consultas_usuarios->consultar_usuario($usuario, $clave);
 
		
			if($consultarUsuario=="")
			{
				$consultarUsuario[0][0]="";
			}
			if ($consultarUsuario[0][0]!='')
			{
				//Creamos las variables de Sesión
				$datasession = array('cedula'  => $consultarUsuario[0][0],'nombre'  => $consultarUsuario[0][2],'s_nombre'  => $consultarUsuario[0][3],'p_apellido'  => $consultarUsuario[0][4],
				's_apellido'  => $consultarUsuario[0][5],'descripcion_rol'  => $consultarUsuario[0][6],'login_ok' => TRUE,'rol'=>$consultarUsuario[0][1],'titulo'=>$consultarUsuario[0][7],'id_usuario'=>$consultarUsuario[0][8]);

						
				$this->session->set_userdata('usuario',$datasession);
				$variablesSesion=$this->session->userdata('usuario');
				// y redirigimos al controlador principal y va a la función index a verificar si hay variable de session
				redirect('principal', 'refresh');
			} 
			else 
			{
				// si el usuario y contraseña son incorrectos
				$this->session->set_flashdata('msg',3);
				redirect('principal', 'refresh');
			}
		} 
		else 
		{
			if($this->session->flashdata('msg')=="")
			{
				$this->session->sess_destroy();
			}
		  	$this->load->template('html_principal');
		}
	}
	
	// Función logout. Elimina las variables de sesión y redirige al controlador principal
	function logout()
	{
		$this->session->sess_destroy();
		// redirigimos al controlador principal
		redirect('principal/login', 'refresh');
	}
	
	//Vista recuperar clave
	function recuperarClave()
	{
		if(isset($_GET['token']))
		{
			$vars=array();
			$consultarExisteToken=$this->consultas_usuarios->consultar_token($_GET['token']);
			if($consultarExisteToken[0][0]!="")
			{
				$vars['id_usuario']=$consultarExisteToken[0][3];
				$this->load->template('cambiarClave',$vars);	
			}
			else
			{
				$this->session->set_flashdata('msg','El token no existe');
				redirect('principal/login', 'refresh');
			}
		}
		else
		{
    		$this->load->template('htmlRecuperarClave');
		}
	}

	//Consultar si existe el usuario y el correo
	function consultarUsuarioCorreo()
	{
		$usuario = $this->input->post('usuario');
		$correo = $this->input->post('correo');
		$consultarUsuarioCorreo=$this->consultas_usuarios->consultar_usuario_correo($usuario, $correo);
		$correo=$consultarUsuarioCorreo[0][6];
		$correo2=$consultarUsuarioCorreo[0][7];
		$vars=array();
		if($consultarUsuarioCorreo[0][0]=="")
		{
		    $mensaje="El Usuario no existe, por favor Verifique los datos";
			$this->session->set_flashdata('msg', $mensaje);
			redirect('principal/recuperarClave',$vars);
		}
		else
		{
			
                    $id_usuario = $consultarUsuarioCorreo[0][9];
            $token = md5($consultarUsuarioCorreo[0][6] . time());
            $guardarToken = $this->consultas_usuarios->guardar_token($correo, $token, $id_usuario);

            $url = '<a href="' . base_url() . 'index.php/principal/recuperarClave?token=' . $token . '">Clic aquí</a>';
            $configuracionSrvCorreo = $this->configuraEmail->configSrvEmail();
            $this->email->initialize($configuracionSrvCorreo);
            $this->email->from('correspondencia@mijp.gob.ve', 'Sistema de Conciliación de Servicios');
            $this->email->to($correo);
            $this->email->bcc($correo2);
            $this->email->subject('Recuperación de Contraseña - Sistema de Conciliación de Servicios  MPPRIJP');
            $this->email->message("Para recuperar su contraseña, siga el siguiente Link: " . $url);
            $this->email->send();


            $mensaje="Los pasos para recuperar su clave de acceso al Sistema han sido enviados a su Correo";
			$this->session->set_flashdata('msg', $mensaje);
			redirect('principal/login','refresh');
		}
	}
	function actualizarClave()
	{
		extract($_POST);
       
        $arrayData2[] = $id_usuario;
        $arrayData2[] = md5($clave);
        $data = $this->fmodel->consultas('modificar_clave', $arrayData2);
        //print_r($data):

        $this->session->set_flashdata('msg', 'SU MODIFICACION FUE REALIZADA CON EXITO');
        redirect('principal/login', 'refresh'); 
		
		
	 	}
 
 }
?>
