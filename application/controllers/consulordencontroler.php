<?php

class Consulordencontroler extends CI_Controller {

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
		$this->configuraEmail=new configEmail();
		$this->load->library(array('session','form_validation','email'));
		
    }

    public function gestion_ordenpago() {

        $arrayData = array();
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->fmodel->consultas('consultar_proveedores', $arrayData);

        $this->load->template('consulorden_view', $data);
    }

  public function buscarDatos() {
		

        if ($this->uri->segment(3) == "") {
            $desde = 0;
        } else {
            $desde = $this->uri->segment(3);
        }

        $pagination = 10;
        $hasta = $pagination;

        //print_r($_GET);
        extract($_POST);
        $arrayData = array();
        $arrayData[] = $proveedores;
        //$arrayData[] = $periodo;
        $arrayData[] = $o_numero;
        $this->db_conciliacion = $this->load->database('default', true);
        $datos_factura = $this->fmodel->consultas('consultar_orden', $arrayData);
        //print_r($datos_fuctura);
        
        $cantidadTuplas = $this->fmodel->consultas('consultar_orden', $arrayData);

        $cantidad = $cantidadTuplas[0][0];


        ///////////////listar/////////////////////
        $config['base_url'] = base_url() . 'index.php/consulordencontroler/buscarDatos';
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
        $vars['proveedores'] =$proveedores;
        //$vars['periodo'] = $periodo;
        $vars['o_numero'] = $o_numero;

        if ($this->uri->segment(3) == "") {
            $this->load->template('listar_orden_detalle_view', $vars);
        } else {
            $this->load->view('listar_orden_detalle_view', $vars);
        }
    }

//======================================================================================================//	
  public function MostrarDetalle() {
        extract($_GET);
        print_r($_GET);
 
        $arrayData = array();
        $arrayData[] = $proveedores;
        //$arrayData[] = $periodo;
        $arrayData[] = $o_numero;

        
        $this->db_conciliacion = $this->load->database('default', true);
        $data = $this->fmodel->consultas('consultar_orden', $arrayData);
        //print_r($data);

        $vars = array();
        $vars['v_nom_empresa'] = $data[0][0];
        $vars['v_cod_proveedor'] = $data[0][1];
        $vars['v_descripcion'] = $data[0][2];
        $vars['v_o_numero'] = $data[0][3];
        $vars['v_o_monto'] = $data[0][4];
        $vars['v_observacion'] = $data[0][5];
        $vars['v_fecha_carga'] = $data[0][6];
        $vars['v_fecha_orden'] = $data[0][7];
        $vars['v_periodo'] = $data[0][8];
        $vars['v_id_orden'] = $data[0][9];
        $vars['v_estatus'] = $data[0][9];
        
        
        $this->load->template('consulorden2_view', $vars);
    }

   
    
  public function actualizar_orden() {
        $variablesSesion=$this->session->userdata('usuario');

        $nombre=$variablesSesion['nombre'];
        $apellido=$variablesSesion['p_apellido'];
	    $nom_analista=$variablesSesion['nombre']." ".$variablesSesion['p_apellido'];
	    $arrayData1[] = $nom_analista; 
         
         
        $arrayData[] = $_POST['id_orden'];
        $arrayData[] = $_POST['o_numero'];
        $arrayData[] = $_POST['o_monto'];
        $arrayData[] = $_POST['observacion'];
        $arrayData[] = $_POST['fecha_orden'];
        $arrayData[] = $_POST['periodo'];
        $arrayData[] = $_POST['estatus']; 
     


        $modificar_orden = $this->fmodel->consultas('modificar_ordenpago', $arrayData);
        if ($modificar_orden[0][0]=='1'){
					
		 $configuracionSrvCorreo=$this->configuraEmail->configSrvEmail();
		 $this->email->initialize($configuracionSrvCorreo);
		 $this->email->from('sisconser@mijp.gob.ve', 'Sisconser' );
		 $this->email->to('franciscojavierlacruz@gmail.com,conciliacion@mijp.gob.ve, jgpenuela@mijp.gob.ve');
		 $this->email->subject( 'Modificacion de Datos de Orden de Pago' );
		 $this->email->message("Se ha Modificado La orden de Pago Nro: ".$arrayData[0]. " Por el Usuario: ".$arrayData1[0]);
		 $this->email->send();
		 
		 $this->session->set_flashdata('msg', 'SU REGISTRO FUE REALIZADO CON EXITO'); 
         redirect('consulordencontroler/gestion_ordenpago', 'refresh');
		
	     }
   
        
    }
 
}
?>

