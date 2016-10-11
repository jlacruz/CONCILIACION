<?php

class Emailcontroler extends CI_Controller {

    // private $db_sistema_base;       
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('omodel');
        $this->load->helper('date');
        $this->load->library('calendar');
        $this->load->library('email');
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    public function cunsultar_analista() {

        $arrayData = array();
        $this->db_conciliacion = $this->load->database('default', true);
        $data['listar_nom_analista'] = $this->omodel->consultas('consultar_nombreusuario', $arrayData);


        $this->load->template('email_view', $data);
    }

   
     function insertar_solicitud() {
        $variablesSesion=$this->session->userdata('usuario');
        //print_r($_POST);
        extract($_POST);
        
        $arrayData = array();
 
        $nombre=$variablesSesion['nombre'];
        $apellido=$variablesSesion['p_apellido'];
	    $nom_analista=$variablesSesion['nombre']." ".$variablesSesion['p_apellido'];
        
        $arrayData[] = $nom_analista;
        $arrayData[] = $tipo_documento;
        $arrayData[] = $motivo;
        

        $insertar_email = $this->omodel->consultas('insertar_email', $arrayData);
        //exit;
        $this->session->set_flashdata('msg', 'SU SOLICITUD FUE ENVIADA CON EXITO');
        redirect('emailcontroler/cunsultar_analista', 'refresh');
    }
    
    
    function cunsultar_sol() {
       
     $this->load->template('consulsol_view');     
}
 
     public function cunsultar_modsol() {
		

        if ($this->uri->segment(3) == "") {
            $desde = 0;
        } else {
            $desde = $this->uri->segment(3);
        }

        $pagination = 10;
        $hasta = $pagination;

        print_r($_GET);
        extract($_POST);
        $arrayData = array();
        $arrayData[] = $tipo_documento;
        
        $this->db_conciliacion = $this->load->database('default', true);
        $datos_factura = $this->omodel->consultas('consular_solicitud', $arrayData);
        //print_r($datos_fuctura);
        
        $cantidadTuplas = $this->omodel->consultas('consular_solicitud', $arrayData);

        $cantidad = $cantidadTuplas[0][0];


        ///////////////listar/////////////////////
        $config['base_url'] = base_url() . 'index.php/emaildencontroler/cunsultar_modsol';
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

        $this->pagination->initialize($config);
        $vars['desde'] = $this->uri->segment(3);
        $vars['titulo'] = 'Funcionario';
        $vars['resultados'] = $datos_factura;
        $vars['tipo_documento'] =$tipo_documento;
       

        if ($this->uri->segment(3) == "") {
            $this->load->template('listar_solicitud_view', $vars);
        } else {
            $this->load->view('listar_solicitud_view', $vars);
        }
    }

    
}
?>


