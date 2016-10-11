<?php

class Listarproveedorcontroler extends CI_Controller {

    //private $db_sigefirrh;

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

    public function usuario() {

        $this->load->template('listarproveedor_view');
    }


    public function buscarDatosproveedor() {

      if ($this->uri->segment(3) == "") {
            $desde = 0;
        } else {
            $desde = $this->uri->segment(3);
        }

        $pagination = 100;    /*cantidad de registros por pagina*/
        $hasta = $pagination;

        //print_r($_POST);
        extract($_GET);
        $arrayData = array();

       
        $arrayData1[] = $hasta;
        $arrayData1[] =  $desde;
        $this->db_conciliacion = $this->load->database('default', true);
        $datos_proveedor = $this->pmodel->consultas('listar_proveedor', $arrayData);  
        //print_r($datos_proveedor); 
             
        $cantidadTuplas = $this->pmodel->consultas('contar_proveedores', $arrayData);
        //print_r($cantidadTuplas);
        
        $datos=count($datos_proveedor);
        
        $cantidad = $cantidadTuplas[0][0];

        ///////////////listar/////////////////////
        $config['base_url'] = base_url().'index.php/listarproveedorcontroler/buscarDatosproveedor';
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
 
        $config['anchor_class'] = 'follow_link';
        $config['anchor_class'] = 'follow_link';

 
        $this->pagination->initialize($config);
        $vars['desde'] = $this->uri->segment(3);
        //$vars['titulo'] = 'Funcionario';
        $vars['resultados'] = $datos_proveedor;

        if ($this->uri->segment(3) == "") {
            $this->load->template('listarproveedor_view', $vars);
        } else {
            $this->load->view('listarproveedor_view', $vars);
        }
    }

//======================================================================================================//	
    public function MostrarDetalle() {
    
         extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $id_proveedor;

        $this->db_conciliacion = $this->load->database('default', true);
        $data2 = $this->cpmodel->consultas('consultar_proveedorfactura', $arrayData);

        $cod_proveedor = $data2[0][0];
        $descripcion = $data2[0][1];
        $rif = $data2[0][2];
        $direccion = $data2[0][3];
        $persona_contacto = $data2[0][4];
        $telefono = $data2[0][5];
        $correo = $data2[0][6];
        $estado = $data2[0][7];
        $ciudad = $data2[0][8];
        echo $cod_proveedor . "~" . $descripcion . "~" . $rif . "~" . $direccion . "~" . $persona_contacto . "~" . $telefono . "~" . $correo . "~" . $estado . "~" . $ciudad;

        $this->load->template('consulproveedor_view', $data2);

   
    }

}

?>
