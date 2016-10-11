<?php

class Listarusuarioscontroler extends CI_Controller {

    //private $db_sigefirrh;

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('cmodel');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->library('calendar');
        $this->load->library('pagination');
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    public function usuario() {

        $this->load->template('listarusuarios_view');
    }

    public function buscarDatos() {

        if ($this->uri->segment(3) == "") {
            $desde = 0;
        } else {
            $desde = $this->uri->segment(3);
        }

        $pagination = 10;    /*cantidad de registros por pagina*/
        $hasta = $pagination;

        //print_r($_POST);
        extract($_GET);
        $arrayData = array();

       
        $arrayData1[] = $hasta;
        $arrayData1[] =  $desde;
        $this->db_conciliacion = $this->load->database('default', true);
        $datos_usuario = $this->cmodel->consultas('usuarios_todos', $arrayData1);
        //print_r($datos_usuario );
        
        $cantidadTuplas = $this->cmodel->consultas('contar_usuario', $arrayData);// funcion que cuenta la cantidad de registros de la tabla
        $datos=count($datos_usuario);
        

        $cantidad = $cantidadTuplas[0][0];
		

        ///////////////listar/////////////////////
        $config['base_url'] = base_url() . 'index.php/listarusuarioscontroler/buscarDatos';
        $config['total_rows'] = $cantidad;
        $config['uri_segment'] = 3;

        $config['per_page'] = $pagination;
        $config['is_ajax_paging'] = TRUE; // default FALSE
        $config['paging_function'] = 'ajax_paging'; // Your jQuery paging


        $config['full_tag_open'] = '<div><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div><!--pagination-->';

        $config['first_link'] = '&laquo; Primero';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Ultimo &raquo;';
        $config['last_tag_open'] = '<li class="http://172.16.10.211/CONCILIACION/index.php/listarusuarioscontroler/buscarDatos">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'siguiente &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Anterior';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="http://172.16.10.211/CONCILIACION/index.php/listarusuarioscontroler/buscarDatos">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
 
        $config['anchor_class'] = 'follow_link';
        $config['anchor_class'] = 'follow_link';

        /* echo "<pre>";
          print_r($datos_usuario);
          echo "</pre>"; */

        $this->pagination->initialize($config);
        $vars['desde'] = $this->uri->segment(3);
        //$vars['titulo'] = 'Funcionario';
        $vars['resultados'] = $datos_usuario;
        

        if ($this->uri->segment(3) == "") {
            $this->load->template('listarusuarios_view', $vars);
        } else {
            $this->load->view('listarusuarios_view', $vars);
        }
    }

//======================================================================================================//	
    public function MostrarDetalle() {

        extract($_GET);
        $variables = array();

        extract($_POST);
        
        $cedula = $cedula[1];
        $arrayData = array();
        $arrayData[] = $cedula;
        $this->db_conciliacion = $this->load->database('default', true);
        $datos_funcionario = $this->cmodel->consultas('buscar_usuario', $arrayData);
        //print_r($datos_funcionario);
        $datos = explode("@@", $datos_funcionario[0][0]);
        //print_r($datos);

        $vars = array();
        $vars['v_id_usuario'] = $datos[0];
        $vars['v_cedula'] = $datos[1];
        $vars['v_p_nombre'] = $datos[2];
        $vars['v_s_nombre'] = $datos[2]; 
        $vars['v_p_apellido'] = $datos[3];
        $vars['v_s_apellido'] = $datos[4];
        $vars['v_telefono_local'] = $datos[5];
        $vars['v_telefono_celular'] = $datos[6];
        $vars['v_correo'] = $datos[7];
        $vars['v_correo2'] = $datos[8];
        $vars['v_usuario'] = $datos[9];
        $vars['v_rol'] = $datos[10];
        $vars['v_fecha_registro'] = $datos[11];
        
        $this->load->view('consuluser2_view', $variables);

    }

}

?>
