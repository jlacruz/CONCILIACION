<?php

class Consulusercontroler extends CI_Controller {

    // private $db_sistema_base;       
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('fmodel');
        $this->load->helper('date');
        $this->load->library('calendar');
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    public function usuario() {

        $this->load->template('consuluser_view');
    }
    public function roles() {
        $arrayData = array();

        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_rol'] = $this->fmodel->consultas('consultar_rol', $arrayData);

        $this->load->template('consuluser_view', $data);
    }
   
//======================================================================================================================================================================//
//=============================================================================================================================================================================//    
      public function buscarDatos() {
		//print_r($_POST);

        if ($this->uri->segment(3) == "") {
            $desde = 0;
        } else {
            $desde = $this->uri->segment(3);
        }

        $pagination = 1;
        $hasta = $pagination;

       // print_r($_POST);
        extract($_POST);
        $arrayData = array();

        $arrayData[] = $cedula;
        $this->db_conciliacion = $this->load->database('default', true);
        $data = $this->fmodel->consultas('buscar_usuario', $arrayData);
        //print_r($data);
        
        $cantidadTuplas = $this->fmodel->consultas('buscar_usuario', $arrayData);

        $cantidad = $cantidadTuplas[0][0];


        ///////////////listar/////////////////////
        $config['base_url'] = base_url() . 'index.php/consulusercontroler/buscarDatos';
        $config['total_rows'] = $cantidad;
        $config['uri_segment'] = 3;

        $config['per_page'] = $pagination;
        $config['is_ajax_paging'] = TRUE; // default FALSE
        $config['paging_function'] = 'ajax_paging'; // Your jQuery paging


        $config['full_tag_open'] = '<div><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';

        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Ultimo &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'siguiente &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Anterior';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        // $config['display_pages'] = FALSE;
        // 
        $config['anchor_class'] = 'follow_link';

        // $config['display_pages'] = FALSE;
        // 
        $config['anchor_class'] = 'follow_link';

        /* echo "<pre>";
          print_r($datos_funcionario);
          echo "</pre>"; */

        //$this->pagination->initialize($config);
        //$variables['desde'] = $this->uri->segment(3);
        $variables['resultados'] = $data;
        $variables['titulo'] = 'Funcionario';
        $variables['cedula'] = $cedula;
        

        if ($this->uri->segment(3) == "") {
            $this->load->template('listar_usuario_detalle_view', $variables);
        } else {
            $this->load->view('listar_usuario_detalle_view', $variables);
        }
    }

//======================================================================================================================================================================//
//=============================================================================================================================================================================//  
    public function MostrarDetalle() {
        //print_r($_POST);
        $arrayData = array();
        extract($_GET);

        
        $arrayData[] = $cedula;
        
        $this->db_conciliacion = $this->load->database('default', true);
        $data = $this->fmodel->consultas('buscar_usuario', $arrayData);
        //print_r($data);

        $variables = array();
        $variables['v_id_usuario'] = $data[0][0];
        $variables['v_cedula'] = $data[0][1];
        $variables['v_p_nombre'] = $data[0][2];
        $variables['v_s_nombre'] = $data[0][3];
        $variables['v_p_apellido'] = $data[0][4];
        $variables['v_s_apellido'] = $data[0][5];
        $variables['v_telefono_local'] = $data[0][6];
        $variables['v_telefono_celular'] = $data[0][7];
        $variables['v_correo'] = $data[0][8];
        $variables['v_correo2'] = $data[0][9];
        $variables['v_usuario'] = $data[0][10];
        $variables['v_rol'] = $data[0][11];
        $variables['v_fecha_registro'] = $data[0][12];
        
        
        $this->load->template('consuluser2_view', $variables);
    }    
    
//======================================================================================================================================================================//
//=============================================================================================================================================================================//    
    public function actualizar_usuario() {
       // print_r($POST);
        extract($_POST);
       
        $arrayData2[] = $id_usuario;
        $arrayData2[] = $rol;
        $arrayData2[] = $usuario;
        $arrayData2[] = $estatus;
        //$arrayData2[] = md5($clave);
        $data = $this->fmodel->consultas('modificar_usuario', $arrayData2);
        //print_r($data);
        //exit; 
        $this->session->set_flashdata('msg', 'SU MODIFICACION FUE REALIZADA CON EXITO');
        redirect('consulusercontroler/usuario', 'refresh');
            
    }
    
     public function usuario2() {
         $arrayData = array();

        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_rol'] = $this->fmodel->consultas('usuarios_roles', $arrayData);
        $this->load->template('usuario_view', $data);
        
        
       
    }
}
?>




