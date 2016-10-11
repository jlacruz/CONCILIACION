<?php
class Usuarios extends CI_Controller 
{
	public function __construct()
    {
		parent::__construct();
		$this->load->helper(array('url','form','captcha')); 
		$this->load->library(array('session','form_validation','email','claves'));
		$this->load->database('default');
		$this->load->model(array('consultas_usuarios','consultas_organismos','consultas_dependencias','consultas_direcciones','consultas_departamentos','consultas_remitentes_destinatarios'));	
		$this->configuraEmail=new configEmail();
		//$this->load->model('consultas_usuarios');	
		//redirect('principal/logout', 'refresh');
                $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
		
	}
	
	public function index()
	{
	 	$this->load->template('operaciones_usuarios');
	}
	
	
	public function agregar()
	{
		$vars=array();
		$comboDependencias="";
		$comboDirecciones="";
		$comboDepartamentos="";
		$id_direccion="";
		$variablesSesion=$this->session->userdata('usuario');
	    //print_r($variablesSesion);
		//consultar Nivel
		$consultarRoles=$this->consultas_usuarios->consultar_roles_usuarios_x_id_subordinado_a($variablesSesion['rol']);
		$comboRoles='<select autocomplete="off" name="roles" id="roles" required="required">';
		foreach($consultarRoles as $valoresComboRoles)
		{
			$comboRoles.='<option value="'.$valoresComboRoles[0].'">'.$valoresComboRoles[1].'</option>';
		}
		$comboRoles.='</select>';
		
		//Si es Administrador General incluimos el combo de Organismos completo
		if($variablesSesion['rol']==7)
		{
			//Combo de Organismo
			$consultarOrganismos=$this->consultas_organismos->listar_organismos(0,0);
			$comboOrganismos='<select disabled="disabled" name="organismo" id="organismo" required="required">
						<option value="" selected="selected">Seleccione Organismo...</option>';
			foreach($consultarOrganismos as $valoresComboOrganismos)
			{
				$comboOrganismos.='<option value="'.$valoresComboOrganismos[0].'">'.$valoresComboOrganismos[1].'</option>';
			}
			$comboOrganismos.='</select>';

		}
		//Los otros usuarios que no son administrador General solo podrán agregar usuarios subordinados
		else
		{
			//Consultar Organismo del Usuario	
			$consultarDependenciaOrganismo=$this->consultas_usuarios->consultar_organismo_x_id_dependencia($variablesSesion['id_dependencia']);
			$comboOrganismos='<select name="organismo" id="organismo">
				<option value="'.$consultarDependenciaOrganismo[0][2].'">'.$consultarDependenciaOrganismo[0][3].'</option>
				</select>';
				
		   //Dependencia del Usuario	
			$comboDependencias='<select name="dependencia" id="dependencia">
				<option value="'.$consultarDependenciaOrganismo[0][0].'">'.$consultarDependenciaOrganismo[0][1].'</option>
				</select>';
			
			//Dirección del Usuario				
			$consultarDireccion=$this->consultas_direcciones->direcciones_consultar_todas(0,0,'',$variablesSesion['id_direccion'],0);
			$comboDirecciones='<select name="direccion" id="direccion">
				<option value="'.$consultarDireccion[0][0].'">'.$consultarDireccion[0][1].'</option>
				</select>';
			
			//Si es Coordinador mostramos el departamento al cual está asignado	
			if($variablesSesion['rol']==2)
			{
				$consultarDepartamento=$this->consultas_departamentos->departamentos_consultar_todas(0,0,'',$variablesSesion['id_departamento'],0);
				$comboDepartamentos='<select name="departamento" id="departamento">
				<option value="'.$consultarDepartamento[0][0].'">'.$consultarDepartamento[0][1].'</option>
				</select>';
			}	
			//Si es Director de Línea mostramos los departamentos	
			//Combo Departamentos
			elseif($variablesSesion['rol']==3)
			{
				$id_direccion=$consultarDireccion[0][0];
			}
			
		}
		
		
		//Combo Titulo
		$consultarTitulos=$this->consultas_usuarios->comboTitulos(0);
		$comboTitulos='<select name="titulo" id="titulo" required="required">
					<option value="" selected="selected">Seleccione Título...</option>';
		foreach($consultarTitulos as $valoresComboTitulos)
		{
			$comboTitulos.='<option value="'.$valoresComboTitulos[0].'">'.$valoresComboTitulos[1].'</option>';
		}
		$comboTitulos.='</select>';
		$clave=$this->claves->generar_clave(5);
		
		$vars['comboOrganismos']=$comboOrganismos;
		$vars['comboTitulos']=$comboTitulos;
		$vars['comboRoles']=$comboRoles;
		$vars['clave']=$clave;
		$vars['comboDependencias']=$comboDependencias;
		$vars['comboDirecciones']=$comboDirecciones;
		$vars['comboDepartamentos']=$comboDepartamentos;
		$vars['id_direccion']=$id_direccion;		
		
		$this->load->template('usuariosAgregar',$vars);
	}
	
	public function listar()
	{
		$variablesSesion=$this->session->userdata('usuario');
		//consultar Usuarios
		if($this->uri->segment(3)=="")
		{
			$desde=0;
			
		}
		else
		{
			$desde=$this->uri->segment(3);	
		}
		
		$palabraClave='';
		//print_r($_GET);
		if(isset($_GET['palabra']))
		{
			$palabraClave=$_GET['palabra'];	
		}
		
		
		$pagination = 8;
		$hasta=$pagination;
		
		//Si es Coordinador listamos solo los usuario Subordinados a su departamento
		if($variablesSesion['rol']==2)	
		{
			$consultarUsuarios=$this->consultas_usuarios->consultar_usuarios_todos($desde, $hasta,$palabraClave,0,0,$variablesSesion['id_departamento']);
			$consultarUsuariosContador=$this->consultas_usuarios->consultar_usuarios_todos(0,0,$palabraClave,0,0,$variablesSesion['id_departamento']);
		}
		//Si es Director de Línea o asistente listamos solo los usuario Subordinados a su Dirección
		elseif($variablesSesion['rol']==3 || $variablesSesion['rol']==6)	
		{
			$consultarUsuarios=$this->consultas_usuarios->consultar_usuarios_todos($desde, $hasta,$palabraClave,0,$variablesSesion['id_direccion'],0);
			$consultarUsuariosContador=$this->consultas_usuarios->consultar_usuarios_todos(0,0,$palabraClave,0,$variablesSesion['id_direccion'],0);
		}
		//Si es Director General o director adjunto listamos solo los usuario Subordinados a su Dependencia
		elseif($variablesSesion['rol']==4 || $variablesSesion['rol']==5)	
		{
			$consultarUsuarios=$this->consultas_usuarios->consultar_usuarios_todos($desde, $hasta,$palabraClave,$variablesSesion['id_dependencia'],0,0);
			$consultarUsuariosContador=$this->consultas_usuarios->consultar_usuarios_todos(0,0,$palabraClave,$variablesSesion['id_dependencia'],0,0);
		}	
		else
		{
			$consultarUsuarios=$this->consultas_usuarios->consultar_usuarios_todos($desde, $hasta,$palabraClave,0,0,0);
			$consultarUsuariosContador=$this->consultas_usuarios->consultar_usuarios_todos(0,0,$palabraClave,0,0,0);
		}
		$config['base_url'] = base_url().'index.php/usuarios/listar';
		$config['total_rows'] = count($consultarUsuariosContador);
		$config['uri_segment']     = 3;

		$config['per_page']        = $pagination;
		$config['is_ajax_paging']      =  TRUE; // default FALSE
		$config['paging_function'] = 'ajax_paging'; // Your jQuery paging
		
		$config['next_link'] = 'Siguiente »';
		$config['prev_link'] = '« Anterior';
		$config['last_link'] = 'Último »';
		$config['first_link'] = '« Primero';
		 
	
		/*echo "<pre>";
		print_r($consultarUsuarios);
		echo "</pre>";*/
		$this->pagination->initialize($config);
		$vars['desde']=$this->uri->segment(3);
		$vars['titulo'] = 'Usuarios';
		$vars['resultados'] = $consultarUsuarios;
	
		//Si no viene la palabra clave listamos normal
		if(isset($_GET['palabra']))
		{
			$vars['palabraClave']=$palabraClave;
		}
		
		//Si no viene la palabra clave listamos normal
		if($this->uri->segment(3)=="" && !isset($_GET['palabra']))
		{
			$this->load->template('usuariosListar',$vars);
			
		}
		//Si viene la palabra clave listamos
		else
		{
			$this->load->view('usuariosListar',$vars);	
		}
	}
	public function editar()
	{
		$variablesSesion=$this->session->userdata('usuario');
		//consultar organismo
		//print_r($_POST);
		$razon_desactivado='';
		if($this->input->post('modificar'))
		{
			extract($_POST);
			//$cedula=$this->input->post('cedula');
			
			//Guardar Datos
			$consulta=$this->db->iniciarTransaccion();
			
			//Debemos Limpiar todas las opciones
			$LimpiarOpciones=$this->consultas_usuarios->limpiar_opciones($id_usuario);
			if(isset($_POST['clave']))
			{
				$clave=md5($clave);
			}
			else
			{
				$clave=$_POST['clave_anterior'];
			}
			
			//si el usuario no tiene Departamento (Directores)
			if(!isset($departamento))
			{
				$departamento=0;	
			}
			if(!isset($direccion))
			{
				$direccion=0;	
			}
			
			//Consultar Usuario
			$modificarUsuario=$this->consultas_usuarios->modificar_usuarios($cedula,$usuario,$clave,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$telefono_oficina,$telefono_movil,$correo,$correo2,$estatus,$roles,$direccion,$departamento,$dependencia,$titulo,$razon_desactivado);
			
	
			//Opciones
			if(isset($_POST['opciones']))
			{
			$opcionesArray='';
			$separadorOpciones='';
			
				foreach($_POST['opciones'] as $valorOpciones)
				{
					$opcionesArray.=$separadorOpciones.$valorOpciones;
					$separadorOpciones=',';
				}
				$id_opciones= '{'.$opcionesArray.'}';
				$guardarOpcionesPorUsuario=$this->consultas_usuarios->insertar_opciones_x_usuario($id_usuario,$id_opciones);
			}
			
			//Asignado a
			if(isset($asignar))
			{
				$guardarAsignadoA=$this->consultas_usuarios->actualizar_asignado_a($id_usuario,$asignar);
			}
			else
			{
				$guardarAsignadoA[0][0]=1;	
			}
			
			
			//Si es Director General guardar Gaceta y Resolución
			if(isset($gaceta) && isset($resolucion))
			{
				$actualizarGacetaResolucion=$this->consultas_usuarios->actualizar_gaceta_resolucion($id_usuario,$gaceta,$resolucion);
			}
			else
			{
				$actualizarGacetaResolucion[0][0]=1	;
			}
			
			//Sub Opciones
			if(isset($_POST['subOpciones']))
			{
				foreach($_POST['subOpciones'] as $valorSubOpciones)
				{
					$valoresSubOpcionesSeparados=explode("-",$valorSubOpciones);
					$id_opcion=$valoresSubOpcionesSeparados[0];
					$id_sub_opcion=$valoresSubOpcionesSeparados[1];
					$guardarSubOpcionesPorUsuario=$this->consultas_usuarios->insertar_sub_opciones_x_usuario($id_usuario,$id_opcion,$id_sub_opcion);
				}
			}
			
			if($modificarUsuario[0][0]=="" || $guardarAsignadoA[0][0]=="" || $actualizarGacetaResolucion[0][0]=="")
			{
				$consulta=$this->db->cancelarTransaccion();
				$mensaje=2;
				exit;
			}
			else
			{
				//exit;
				$consulta=$this->db->aceptarTransacciones();
				
				 $url=base_url().'index.php/principal/';
				 $configuracionSrvCorreo=$this->configuraEmail->configSrvEmail();
				 $this->email->initialize($configuracionSrvCorreo);
				 $this->email->from('correspondencia@mijp.gob.ve', 'Sistema de Correspondencia' );
				 $this->email->to($correo);
				 $this->email->bcc($correo2);
				 $this->email->subject( 'Usuario Modificado - Sistema de Correspondencia');
				 $this->email->message("Su Usuario o Contraseña han sido modificado con éxito, para ingresar al sistema de correspondencia: <br>Usuario: ".$usuario."  <br>Contraseña: ".$clave."<br>siga el siguiente Link: ".$url);
				 $this->email->send();
				
				
				
				$mensaje=1;
			}
			$this->session->set_flashdata('msg', $mensaje);
			//exit;
			redirect('usuarios/listar', 'refresh');
		}
		else
		{
			extract($_GET);
			$variables=array();
			$comboOrganismos="";
			$comboDependencias="";
			$comboDirecciones="";
			$comboDepartamentos="";
			$id_direccion="";
			
			$cedula=base64_decode($vars);
			
			$cedula=explode("=",$cedula);
			$cedula=$cedula[1];
			
			$consultarUsuarioEspecifico=$this->consultas_usuarios->consultar_usuario_especifico($cedula);
			
			//Consultar Usuario asignado
			$id_usuario=$consultarUsuarioEspecifico[0][17];
			$usuarioAsignado=$this->consultas_usuarios->usuario_asignado_a($id_usuario);
			//print_r($usuarioAsignado);
			
			
			/*echo "<pre>";
			print_r($consultarUsuarioEspecifico);
			echo "</pre>";*/
			
			//$consultarRoles=$this->consultas_usuarios->consultar_roles_usuarios();
			
			//Combo Titulo
			$consultarTitulos=$this->consultas_usuarios->comboTitulos(0);
			$comboTitulos='<select autocomplete="off" name="titulo" id="titulo" required="required">
						<option value="">Seleccione Título...</option>';
			foreach($consultarTitulos as $valoresComboTitulos)
			{
				if($consultarUsuarioEspecifico[0][18]==$valoresComboTitulos[0])
						$selected='selected="selected"';
					else
						$selected='';
				$comboTitulos.='<option '.$selected.' value="'.$valoresComboTitulos[0].'">'.$valoresComboTitulos[1].'</option>';
			}
			$comboTitulos.='</select>';
						
			//Combo Roles
			$consultarRoles=$this->consultas_usuarios->consultar_roles_usuarios_x_id_subordinado_a($variablesSesion['rol']);
			$comboRoles='<select autocomplete="off" name="roles" id="roles">';
				foreach($consultarRoles as $valoresComboRoles)
				{
					if($consultarUsuarioEspecifico[0][13]==$valoresComboRoles[0])
						$selected='selected="selected"';
					else
						$selected='';
					$comboRoles.='<option '.$selected.' value="'.$valoresComboRoles[0].'">'.$valoresComboRoles[1].'</option>';
				}
				$comboRoles.='</select>';
			
			
			
		//Si es Administrador General incluimos el combo de Organismos completo
		if($variablesSesion['rol']==7)
		{
			//Combo de Organismo
			$consultarOrganismos=$this->consultas_organismos->listar_organismos(0,0);
			$comboOrganismos='<select disabled="disabled" name="organismo" id="organismo" required="required">
						<option value="" selected="selected">Seleccione Organismo...</option>';
			foreach($consultarOrganismos as $valoresComboOrganismos)
			{
				$comboOrganismos.='<option value="'.$valoresComboOrganismos[0].'">'.$valoresComboOrganismos[1].'</option>';
			}
			$comboOrganismos.='</select>';

		}
		//Los otros usuarios que no son administrador General solo podrán agregar usuarios subordinados
		else
		{
			//Consultar Organismo del Usuario	
			$consultarDependenciaOrganismo=$this->consultas_usuarios->consultar_organismo_x_id_dependencia($variablesSesion['id_dependencia']);
			$comboOrganismos='<select name="organismo" id="organismo">
				<option value="'.$consultarDependenciaOrganismo[0][2].'">'.$consultarDependenciaOrganismo[0][3].'</option>
				</select>';
				
		   //Dependencia del Usuario	
			$comboDependencias='<select name="dependencia" id="dependencia">
				<option value="'.$consultarDependenciaOrganismo[0][0].'">'.$consultarDependenciaOrganismo[0][1].'</option>
				</select>';
			
			//Dirección del Usuario				
			$consultarDireccion=$this->consultas_direcciones->direcciones_consultar_todas(0,0,'',$variablesSesion['id_direccion'],0);
			$comboDirecciones='<select name="direccion" id="direccion">
				<option value="'.$consultarDireccion[0][0].'">'.$consultarDireccion[0][1].'</option>
				</select>';
			
			//Si es Coordinador mostramos el departamento al cual está asignado	
			if($variablesSesion['rol']==2)
			{
				$consultarDepartamento=$this->consultas_departamentos->departamentos_consultar_todas(0,0,'',$variablesSesion['id_departamento'],0);
				$comboDepartamentos='<select name="departamento" id="departamento">
				<option value="'.$consultarDepartamento[0][0].'">'.$consultarDepartamento[0][1].'</option>
				</select>';
			}	
			//Si es Director de Línea mostramos los departamentos	
			//Combo Departamentos
			elseif($variablesSesion['rol']==3)
			{
				$id_direccion=$consultarDireccion[0][0];
			}
			
		}
			
			
			
			//Consultar id de la dependencia y el Organismo dado el id de la dirección que todos los usuarios los deben tener excepto el Director General
			//$id_dependencia=$consultarUsuarioEspecifico[0][17];
			$id_direccion=$consultarUsuarioEspecifico[0][14];
			$id_departamento=$consultarUsuarioEspecifico[0][15];
			$id_dependencia=$consultarUsuarioEspecifico[0][16];
			if($id_direccion!=0)
			{
				$consultarDependenciaOrganismo=$this->consultas_usuarios->consultar_dependencia_organismo($id_direccion);	
			}
			else
			{
				$consultarDependenciaOrganismo=$this->consultas_usuarios->consultar_organismo_x_id_dependencia($id_dependencia);
			}
			//print_r($consultarDependenciaOrganismo);
			//Si es Director General Consultamos su Gaceta y Resolución
			if($consultarUsuarioEspecifico[0][13]==4)
			{
				$consultarGacetaResolucion=$this->consultas_usuarios->consultar_gaceta_resolucion($id_usuario);
				$variables['gaceta']=$consultarGacetaResolucion[0][1];
				$variables['resolucion']=$consultarGacetaResolucion[0][2];
			}
				//print_r($consultarGacetaResolucion);
							
				$variables['comboRoles']=$comboRoles;
				$variables['id_direccion'] = $id_direccion;
				$variables['id_departamento'] = $id_departamento;
				$variables['resultados'] = $consultarUsuarioEspecifico;
				$variables['resultados2'] = $consultarDependenciaOrganismo;
				$variables['id_asignado_a'] = $usuarioAsignado[0][0];
				$variables['comboTitulos']=$comboTitulos;
				$variables['comboDependencias']=$comboDependencias;
				$variables['comboDirecciones']=$comboDirecciones;
				$variables['comboDepartamentos']=$comboDepartamentos;
				$variables['id_direccion']=$id_direccion;
				$variables['comboOrganismos']=$comboOrganismos;	
				//$variables['clave']=$clave;
				
				$this->load->template('usuariosModificar',$variables);
		}
		
	}
	public function modificarMiUsuario()
	{
		if($this->input->post('modificar'))
			{	
				extract($_POST);
				if(isset($_POST['clave']))
				{
					$clave=md5($clave);
				}
				else
				{
					$clave=$_POST['clave_anterior'];
				}
				
				$modificarMiUsuario=$this->consultas_usuarios->modificar_mi_usuario($cedula,$clave,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$telefono_oficina,$telefono_movil,$correo,$correo2,$titulo);

				if($modificarMiUsuario=="")
				{
					$mensaje=2;
				}
				else
				{
					$mensaje=1;
				}
				$this->session->set_flashdata('msg', $mensaje);
				redirect('usuarios/modificarMiUsuario',$vars="");
			
			}
			else
			{
				//Cédula del usuario que inició Sesión
				$variablesSesion=$this->session->userdata('usuario');
				$id_usuario=$variablesSesion['id_usuario'];
				$consultarUsuarioEspecifico=$this->consultas_usuarios->consultar_usuario_especifico_x_id($id_usuario);
				
				//Combo Titulo
				$consultarTitulos=$this->consultas_usuarios->comboTitulos(0);
				$comboTitulos='<select autocomplete="off" name="titulo" id="titulo" required="required">
							<option value="">Seleccione Título...</option>';
				foreach($consultarTitulos as $valoresComboTitulos)
				{
					if($consultarUsuarioEspecifico[0][18]==$valoresComboTitulos[0])
							$selected='selected="selected"';
						else
							$selected='';
					$comboTitulos.='<option '.$selected.' value="'.$valoresComboTitulos[0].'">'.$valoresComboTitulos[1].'</option>';
				}
				$comboTitulos.='</select>';
				
				$vars['resultados'] = $consultarUsuarioEspecifico;
				$vars['comboTitulos']=$comboTitulos;
				
				$this->load->template('usuariosModificarMiUsuario',$vars);	
			}
	}
	public function guardar()
	{
		if ($this->input->post('cedula'))
		{
			//Recogemos las variables
			extract($_POST);
			//Guardar Datos
			$consulta=$this->db->iniciarTransaccion();
			
			//Debemos Limpiar todas las opciones
			$LimpiarOpciones=$this->consultas_usuarios->limpiar_opciones($cedula);
			//print_r($_POST);
			
			//si el usuario no tiene Departamento (Directores)
			if(!isset($departamento))
			{
				$departamento=0;	
			}
			
			//si el usuario no tiene Dirección (Directores Generales)
			if(!isset($direccion))
			{
				$direccion=0;	
			}
			
			
			$guardarUsuario=$this->consultas_usuarios->guardar_usuario($cedula,$usuario,md5($clave),$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$telefono_oficina,$telefono_movil,$correo,$correo2,$roles,$direccion,$departamento,$dependencia,$titulo);
			$id_usuario=$guardarUsuario[0][0];
			
			//Opciones
			if(isset($_POST['opciones']))
			{
			$opcionesArray='';
			$separadorOpciones='';
			
				foreach($_POST['opciones'] as $valorOpciones)
				{
					$opcionesArray.=$separadorOpciones.$valorOpciones;
					$separadorOpciones=',';
				}
				$id_opciones= '{'.$opcionesArray.'}';
				$guardarOpcionesPorUsuario=$this->consultas_usuarios->insertar_opciones_x_usuario($id_usuario,$id_opciones);
			}
			
			
			//Sub Opciones
			if(isset($_POST['subOpciones']))
			{
				foreach($_POST['subOpciones'] as $valorSubOpciones)
				{
					$valoresSubOpcionesSeparados=explode("-",$valorSubOpciones);
					$id_opcion=$valoresSubOpcionesSeparados[0];
					$id_sub_opcion=$valoresSubOpcionesSeparados[1];
					$guardarSubOpcionesPorUsuario=$this->consultas_usuarios->insertar_sub_opciones_x_usuario($cedula,$id_opcion,$id_sub_opcion);
				}
			}
			
			
			//Asignado a
			if(isset($_POST['asignar']))
			{
				$guardarAsignadoA=$this->consultas_usuarios->insertar_asignado_a($id_usuario,$asignar);
			}
			else
			{
				$guardarAsignadoA[0][0]=1;
			}
			
			//Si es Director General guardamos la Gaceta y la resolución
			if(isset($_POST['gaceta']) && isset($_POST['resolucion']) )
			{
				$guardarGacetaResolucion=$this->consultas_usuarios->guardar_gaceta_resolucion($id_usuario,$gaceta,$resolucion);
			}
			else
			{
				$guardarGacetaResolucion[0][0]=1;
			}

			if($guardarUsuario[0][0]=="" || $guardarAsignadoA[0][0]=="" || $guardarGacetaResolucion[0][0]=="")
			{
				$consulta=$this->db->cancelarTransaccion();
				$mensaje=2;
				echo "NO SE REALIZARON LA(S) INSERCIONES";
				exit;
			}
			else
			{
				$consulta=$this->db->aceptarTransacciones();
			
				 $url=base_url().'index.php/principal/';
				 $configuracionSrvCorreo=$this->configuraEmail->configSrvEmail();
				 $this->email->initialize($configuracionSrvCorreo);
				 $this->email->from('correspondencia@mijp.gob.ve', 'Sistema de Correspondencia' );
				 $this->email->to($correo);
				 $this->email->bcc($correo2);
				 $this->email->subject( 'Nuevo Usuario - Sistema de Correspondencia');
				 $this->email->message("Su nuevo Usuario y Contraseña para ingresar al sistema de correspondencia: <br>Usuario: ".$usuario."  <br>Contraseña: ".$clave."<br>siga el siguiente Link para ingresar: ".$url);
				 $this->email->send();
				 $mensaje=1;
				//exit;
			}

			$this->session->set_flashdata('msg', $mensaje);
			redirect('usuarios/agregar',$vars="");
			
		}
	}
	
	public function comboUsuariosAsignar()
	{
		//print_r($_GET);
		$id_rol=$_GET['id_rol'];
		$ExisteUsuario="";
		$consulta[0][0]="";
		
		//Analistas
		
		//Consultamos la lista de los usuario a los cuales vamos a asignar (Si es Analista, le asignamos al Coordinador del Departamento Seleccionado)
		if(isset($_GET['id_departamento']) && $id_rol==1)
		{
			$id_departamento=$_GET['id_departamento'];
			if($id_departamento!="")
			{
				$consulta=$this->consultas_usuarios->usuarios_x_id_departamento_y_rol($id_departamento,2);
			}
		}
		//Coordinadores, Asistente del Director General, Adjunto
		
		//Consultamos la lista de los usuario a los cuales vamos a asignar (Si es Coordinador le asignamos un Director de Línea de la Dirección Seleccionada)
		else if(isset($_GET['id_direccion']) && ($id_rol==2 || $id_rol==5 || $id_rol==6))
		{
			$id_direccion=$_GET['id_direccion'];
			$id_departamento=$_GET['id_departamento'];
			
				//Aqui verificamos que el Coordinador, Adjunto o asistente no este agregado a ese Departamento, preguntamos si no está editando el usuario, para que no haga esta validación
				if(!isset($_GET['editar']))
				{
					$consulta=$this->consultas_usuarios->usuarios_x_id_departamento_y_rol($id_departamento,$id_rol);
				}

				//print_r($consulta);
				//Aquí hacemos la consulta a quien va asignado en este caso a un (Director de Línea)
				if($consulta[0][0]=="")
				{
					$consulta=$this->consultas_usuarios->usuarios_x_id_direccion_y_rol($id_direccion,3);
				}
				else
				{
					$ExisteUsuario=1;
				}
		}
		else if(isset($_GET['id_direccion']) &&  $id_rol==8)
		{
			$id_direccion=$_GET['id_direccion'];
			$consulta=$this->consultas_usuarios->usuarios_x_id_direccion_y_rol($id_direccion,3);
	
		}
		
		//Directores de Línea y Directores Generales
		
		elseif(isset($_GET['id_dependencia']))
		{
			//print_r($_GET);
			$id_dependencia=$_GET['id_dependencia'];
			if($id_rol==3  && $id_dependencia!="")
			{
				//Verificamos si la dirección no tiene Director de Línea
				if(isset($_GET['id_direccion']))
				{
					$id_direccion=$_GET['id_direccion'];
					$consulta=$this->consultas_usuarios->usuarios_x_id_direccion_y_rol($id_direccion,3);
				}
				else
				{
					$consulta[0][0]="";
				}
				//Consultamos la lista de los usuario a los cuales vamos a asignar (Si es Director de Línea, le asignamos el Director general de la Dependencia Seleccionada)	
				if($consulta[0][0]=="")
				{
					$consulta=$this->consultas_usuarios->usuarios_x_id_dependencia_y_rol($id_dependencia,4);
				}
				else
				{
					$ExisteUsuario=2;
				}

			}
			else if(($id_rol==4 || $id_rol==5 || $id_rol==6) && $id_dependencia!="")
			{
				$consulta=$this->consultas_usuarios->usuarios_x_id_dependencia_y_rol($id_dependencia,$id_rol);
				if($consulta[0][0]!="")
				{
					$ExisteUsuario=3;
				}
			}
			
			
			
		}
		//Si existe el usuario asignado a la Dependencia, Dirección o Departamento mandamos un mensaje de Error
		if($ExisteUsuario!="")
		{
			echo '<div style="float:left;margin-top:10px" class="error">Ya existe un usuario asignado a esta Dependencia, Dirección o Departamento</div>
			<div style="float:left;z-index:-10;position:absolute;margin:20px 0 0 100px"><input style="border:none;width:0px;height:0px" size="1" oninvalid="setCustomValidity(\'Verifique los datos\')" type="text" name="repetido" value="" required></div>';
			
		}
		elseif($id_rol=="")
		{
			echo '<div style="float:left;margin-top:10px" class="error">Debe seleccionar el rol del usuario</div>
			<div style="float:left;z-index:-10;position:absolute;margin:20px 0 0 100px"><input style="border:none;width:0px;height:0px" size="1" oninvalid="setCustomValidity(\'Verifique los datos\')" type="text" name="repetido" value="" required></div>';	
		}
		//Si no, incluimos el cambo que muestra a quien va asignado
		else
		{
			if($consulta[0][0]!="")
				{
					if(isset($_GET['id_asignado_a']))
					{
						$id_asignado_a=$_GET['id_asignado_a'];
					}
					else
					{
						$id_asignado_a='';
					}
					$combo='<select required="required" name="asignar" id="asignar">';
					foreach($consulta as $valoresComboAsignar)
					{
						if($id_asignado_a==$valoresComboAsignar[5])
						{
							$selected='selected="selected"';	
						}
						else
						{
							$selected='';	
						}
						$combo.='<option '.$selected.' value="'.$valoresComboAsignar[5].'">'.$valoresComboAsignar[6].' '.$valoresComboAsignar[1].' '.$valoresComboAsignar[3].'</option>';
					}
					$combo.='</select>';
					echo "Asignado a:<br>".$combo;
				}
				else
				{
					//Si no es Director General mostramos el combo vacio para mostrar que no hay autorizador registrados
					if($id_rol!=4)
					{
						echo $combo='<select required="required" name="asignar" id="asignar"><option value="">Seleccione...</option></select>';
					}
				}
		}
	}
	public function validarDisponibilidad()
	{
		$nombreUsuario=$_POST['nombreUsuario'];
		$consulta=$this->consultas_usuarios->validarDisponibilidad($nombreUsuario);
		//print_r($consulta);
		if($consulta[0][0]=="")
			{
				$respuesta=1;
			}
			else
			{
				$respuesta=0;
			}
		echo $respuesta;
	}
	public function validarDisponibilidadCorreo()
	{
		$correo=$_POST['correo'];
		$consulta=$this->consultas_usuarios->usuarios_validar_disponibilidad_correo($correo);
		if($consulta[0][0]=="")
			{
				$respuesta=1;
			}
			else
			{
				$respuesta=0;
			}
		echo $respuesta;
	}
	
	public function validarCedula()
	{
		$cedula=$_POST['cedula'];
		$consulta=$this->consultas_usuarios->usuarios_validar_disponibilidad_cedula($cedula);
		if($consulta[0][0]=="")
			{
				$respuesta=1;
			}
			else
			{
				$respuesta=0;
			}
		echo $respuesta;
	}
	
	
}
?>