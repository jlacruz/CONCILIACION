<?php

class Consultacontroler extends CI_Controller {

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

    public function gestion_factura() {

        $arrayData = array();
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->fmodel->consultas('consultar_proveedores', $arrayData);

        $this->load->template('consulta_view', $data);
    }
 
    
    public function consulta_movimiento() {
        
        //print_r($_POST);
        $arrayData = array();
        extract($_POST);

        $arrayData[] = $id_proveedor;
        $arrayData1[] = $id_proveedor;
        $arrayData2[] = $id_proveedor;
        $arrayData[] = $periodo;
        $arrayData1[] = $periodo;
        $this->db_conciliacion = $this->load->database('default', true);
        $data = $this->fmodel->consultas('reporte_factura', $arrayData);
        $data1 = $this->fmodel->consultas('reporte_orden', $arrayData1);
        $data2 = $this->fmodel->consultas('nombre_proveedorservicio', $arrayData2);

        //print_r($data);
        //print_r($data1);
       // print_r($data2);
        
        $variables['v_f_numero'] = $data[0][0];
        $variables['v_f_monto'] = $data[0][1];
        $variables['v_fecha_factura'] = $data[0][2];
        
        $variables['v1_o_numero'] = $data1[0][0];
        $variables['v1_o_monto'] = $data1[0][1];
        $variables['v1_fecha_orden'] = $data1[0][2];
        
        $variables['v2_nom_empresa'] = $data2[0][0];
        $variables['v2_descripcion'] = $data2[0][1];
          

        $this->load->view('consulta2_view', $variables);
    }

    

}
?>



