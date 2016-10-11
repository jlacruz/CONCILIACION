<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Consultas_usuarios extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //obtenemos las entradas de todos o un usuario, dependiendo
    // si le pasamos le id como argument o no
    public function consultar_usuario($usuario = false, $clave =false)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios',$parametros);
		return $consulta;
	
    }
	/*public function consultar_sub_menu($rol)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('opciones_x_rol',$parametros);
		return $consulta;
    }*/
	/*public function consultar_menu_padre($arraySubMenus)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('menues_padres',$parametros);
		return $consulta;
    }*/
	
/*	public function consultar_sub_opciones($arraySubMenus)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('sub_opciones',$parametros);
		return $consulta;
    }*/
	public function consultar_usuario_correo($usuario,$correo)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_correo',$parametros);
		return $consulta;
    }
	public function consultar_roles_usuarios()
    {
		$parametros = get_defined_vars();	
		$consulta=$this->db->SELECTPLSQL('usuarios_roles',$parametros);
		return $consulta;
    }
	/*public function consultar_roles_usuarios_x_id_subordinado_a($id_subordinado_a)
    {
		$parametros = get_defined_vars();	
		$consulta=$this->db->SELECTPLSQL('usuarios_roles_subordinados_a',$parametros);
		return $consulta;
    }*/
	public function guardar_usuario($cedula,$usuario,$clave,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$telefono_oficina,$telefono_movil,$correo1,$correo2,$roles,$direccion,$departamento,$dependencia,$titulo)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_guardar',$parametros);
		return $consulta;
    }
    
	public function consultar_usuarios_todos($paginacion="",$hasta="",$palabraClave="",$id_dependencia,$id_direccion,$id_departamento)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_consultar_todos',$parametros);
		return $consulta;
    }
	public function contar_usuarios($palabraClave)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_todos',$parametros);
		return $consulta;
    }
/*	public function consultar_opciones_x_operaciones($id_operacion,$id_rol)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('opciones_x_operaciones',$parametros);
		return $consulta;
    }*/
/*	public function insertar_opciones_x_usuario($cedula,$id_opciones)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_insertar_opciones',$parametros);
		return $consulta;
    }*/
/*	public function consultar_acceso_caso_uso($cedula,$controladorMetodo)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('acceso_caso_uso',$parametros);
		return $consulta;
	}*/
/*	public function consultar_sub_opciones_x_id_opcion($id_opcion)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('sub_opciones_x_id_opcion',$parametros);
		return $consulta;
	}*/
/*	public function insertar_sub_opciones_x_usuario($cedula,$id_opcion,$id_sub_opcion)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_insertar_sub_opciones',$parametros);
		return $consulta;
	 }*/
/*	public function limpiar_opciones($cedula)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_limpiar_opciones',$parametros);
		return $consulta;
	 }
	 
	public function consultar_usuario_especifico($cedula)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_especifico',$parametros);
		return $consulta;
	 }
	 public function consultar_usuario_especifico_x_id($id_usuario)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_especifico_x_id',$parametros);
		return $consulta;
	 }
	 
	public function consultar_todas_opciones()
    {
		$parametros=array();		
		$consulta=$this->db->SELECTPLSQL('opciones_todas',$parametros);
		return $consulta;		
    }*/
	public function modificar_usuarios($cedula,$usuario,$clave,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$telefono_oficina,$telefono_movil,$correo,$correo2,$estatus,$roles,$direccion,$departamento,$id_dependencia,$titulo,$razon_desactivado)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_modificar',$parametros);
		return $consulta;
    }
	public function modificar_mi_usuario($cedula,$clave,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$telefono_oficina,$telefono_movil,$correo,$correo2,$titulo)
    {
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_modificar_mi_usuario',$parametros);
		return $consulta;
    }
/*	public function consultar_dependencia_organismo($id_direccion)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('dependencias_organismo_x_id_direccion',$parametros);
		return $consulta;
	}*/
/*	public function usuarios_x_id_departamento_y_rol($id_departamento,$id_rol)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_x_id_departamento_y_rol',$parametros);
		return $consulta;
	}*/
/*	public function usuarios_x_id_direccion_y_rol($id_direccion,$id_rol)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_x_id_direccion_y_rol',$parametros);
		return $consulta;
	}
	public function usuarios_x_id_dependencia_y_rol($id_dependencia,$id_rol)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_x_id_dependencia_y_rol',$parametros);
		return $consulta;
	}
	public function consultar_organismo_x_id_dependencia($id_dependencia)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('organismo_x_id_dependencia',$parametros);
		return $consulta;
	}
	public function insertar_asignado_a($id_usuario,$asignar)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_asignado_a',$parametros);
		return $consulta;
	}
	public function actualizar_asignado_a($id_usuario,$asignar)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_actualizar_asignado_a',$parametros);
		return $consulta;
	}
	public function validarDisponibilidad($nombreUsuario)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_validar_disponibilidad',$parametros);
		return $consulta;
	}
	public function usuarios_validar_disponibilidad_correo($correo)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_validar_disponibilidad_correo',$parametros);
		return $consulta;
	}
	public function usuarios_validar_disponibilidad_cedula($cedula)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_validar_disponibilidad_cedula',$parametros);
		return $consulta;
	}
	public function usuario_asignado_a($id_usuario)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_asignado',$parametros);
		return $consulta;
	}*/
	public function guardar_token($correo,$token,$id_usuario)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('token_guardar_recuperar_clave',$parametros);
		return $consulta;
	}
	public function consultar_token($token)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('token_consultar_recuperar_clave',$parametros);
		return $consulta;
	}
	public function actualizar_clave($id_usuario,$clave)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_actualizar_clave_x_id',$parametros);
		return $consulta;
	}	
	public function comboTitulos($id_titulo=0)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_listar_titulos',$parametros);
		return $consulta;
	}
	/*public function guardar_gaceta_resolucion($id_usuario,$gaceta,$resolucion)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('gaceta_resolucion_guardar',$parametros);
		return $consulta;
	}
	public function consultar_gaceta_resolucion($id_usuario)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('gaceta_resolucion_consultar',$parametros);
		return $consulta;
	}
	public function actualizar_gaceta_resolucion($id_usuario,$gaceta,$resolucion)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('gaceta_resolucion_modificar',$parametros);
		return $consulta;
	}
	public function consultar_director_general_x_id_dependencia($dependencia)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('director_general_x_id_dependencia',$parametros);
		return $consulta;
	}
	
	public function usuarios_x_id_dependencia($dependencia)
	{
		$parametros = get_defined_vars();
		$consulta=$this->db->SELECTPLSQL('usuarios_x_id_dependencia',$parametros);
		return $consulta;
	}
	*/
	
	
}
?>
