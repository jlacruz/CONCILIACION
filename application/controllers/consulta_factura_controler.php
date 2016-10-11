<?php

class Consulta_factura_controler extends CI_Controller {

    private $db_sigefirrh;

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('fmodel');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->library('calendar');
        $this->configuraEmail=new configEmail();
		$this->load->library(array('session','form_validation','email'));
    }
//=============================================================================================================================================================================//
//=============================================================================================================================================================================//
    public function gestion_factura() {

        $arrayData = array();
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->fmodel->consultas('consultar_proveedores', $arrayData);

        $this->load->template('consultar_factura_view', $data);
    }
//=============================================================================================================================================================================//
//=============================================================================================================================================================================//
    public function buscarDatos() {
		

        if ($this->uri->segment(3) == "") {
            $desde = 0;
        } else {
            $desde = $this->uri->segment(3);
        }

        $pagination = 10;
        $hasta = $pagination;

        //print_r($_GET);
        extract($_GET);
        $arrayData = array();
        $arrayData[] = $proveedores;
        $arrayData[] = $periodo;
        $arrayData[] = $f_numero;
        
        $this->db_conciliacion = $this->load->database('default', true);
        $datos_factura = $this->fmodel->consultas('consultar_factura', $arrayData);
        //print_r($datos_fuctura);
        
        $cantidadTuplas = $this->fmodel->consultas('consultar_factura', $arrayData);

        $cantidad = $cantidadTuplas[0][0];


        ///////////////listar/////////////////////
        $config['base_url'] = base_url() . 'index.php/consulta_factura_controler/buscarDatos';
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
        $vars['periodo'] = $periodo;
        $vars['f_numero'] = $f_numero;

        if ($this->uri->segment(3) == "") {
            $this->load->template('listar_factura_detalle_view', $vars);
        } else {
            $this->load->view('listar_factura_detalle_view', $vars);
        }
    }

//======================================================================================================================================================================//
//=============================================================================================================================================================================//	
    public function MostrarDetalle() {
        extract($_GET);
       // print_r($_GET);
 
        $arrayData = array();
        $arrayData[] = $proveedores;
        $arrayData[] = $periodo;
        $arrayData[] = $f_numero;

        
        $this->db_conciliacion = $this->load->database('default', true);
        $data = $this->fmodel->consultas('consultar_factura', $arrayData);
        //print_r($data);

        $vars = array();
        $vars['v_nom_empresa'] = $data[0][0];
        $vars['v_cod_proveedor'] = $data[0][1];
        $vars['v_cuenta_contrato'] = $data[0][2];
        $vars['v_descripcion'] = $data[0][3];
        $vars['v_f_numero'] = $data[0][4];
        $vars['v_f_monto'] = $data[0][5];
        $vars['v_observacion'] = $data[0][6];
        $vars['v_fecha_carga'] = $data[0][7];
        $vars['v_fecha_factura'] = $data[0][8];
        $vars['v_periodo'] = $data[0][9];
        $vars['v_id_factura'] = $data[0][10];
        $vars['v_id_contrato'] = $data[0][11];
        $vars['v_id_usuario'] = $data[0][12];
        $vars['v_mes'] = $data[0][13];
        $vars['comboMes'] = $this->consultar_cuenta_contrato($proveedores, $vars['v_mes']);
        $vars['comboCuenta'] = $this->consultar_cuenta_contrato($proveedores, $vars['v_id_contrato']);
        
        
        $this->load->template('consulfactura2_view', $vars);
    }
//=============================================================================================================================================================================//
//=============================================================================================================================================================================//
    public function consultar_cuenta_contrato($proveedores = 0, $cuentaSeleccionada = 0) {

        extract($_GET);
        //exit;
        $arrayData = array();
        $arrayData[] = $proveedores;

        $this->db_conciliacion = $this->load->database('default', true);
        $datos_cuenta = $this->fmodel->consultas('consultar_cuentacontrato', $arrayData);
        $comboCuenta = "<select name='cuenta_contrato' id='cuenta_contrato' required='required'class='form-control'>";
        foreach ($datos_cuenta as $cuenta_contrato) {
            if ($cuentaSeleccionada == $cuenta_contrato[0]) {
                $selected = "selected='selected'";
            } else {
                $selected = '';
            }
            $comboCuenta.="<option " . $selected . " value='" . $cuenta_contrato[0] . "'>" . $cuenta_contrato[1] . "</option>";
        }
        $comboCuenta.="</select>";

        return $comboCuenta;
    }
 //=============================================================================================================================================================================//   
 //=============================================================================================================================================================================//
    public function consultar_mes($proveedores = 0, $mesSeleccionado = 0) {

        extract($_GET);
        //exit;
        $arrayData = array();
        $arrayData[] = $proveedores;

        $this->db_conciliacion = $this->load->database('default', true);
        $datos_mes = $this->fmodel->consultas('consultar_factura', $arrayData);
        $comboMes = "<select name='mes' id='mes' required='required'class='form-control'>";
        foreach ($datos_mes as $mes) {
            if ($mesSeleccionado == $mes[0]) {
                $selected = "selected='selected'";
            } else {
                $selected = '';
            }
            $comboMes.="<option " . $selected . " value='" . $mes[13] . "'>" . $mes[14] . "</option>";
        }
        $comboMes.="</select>";

        return $comboMes;
    }
 //=============================================================================================================================================================================//   
 //=============================================================================================================================================================================//   
    
  public function actualizar_factura() {
       
 //Array ( [nom_empresa] => AGUAS DE MERIDA [id_factura] => 88 [f_numero] => 11 [cod_proveedor] => P-9 [id_usuario] => 1 [periodo] => 2015 [descripcion] => AGUA [fecha_carga] => 2015-06-05 [id_contrato] => 46 [cuenta_contrato] => 47 [f_monto] => 25000 [fecha_factura] => 2015-10-01 [mes] => NOVIEMBRE [observacion] => PRUEBA POR MES [estatus] => 1 [actualizar] => Actualizar )        
        $variablesSesion=$this->session->userdata('usuario');
        $nombre=$variablesSesion['nombre'];
        $apellido=$variablesSesion['p_apellido'];
	    $nom_analista=$variablesSesion['nombre']." ".$variablesSesion['p_apellido'];
	    $arrayData1[] = $nom_analista;
	    
        $arrayData[] = $_POST['id_factura'];
        $arrayData[] = $_POST['cuenta_contrato'];
        $arrayData[] = $_POST['f_numero'];
        $arrayData[] = $_POST['f_monto'];
        $arrayData[] = $_POST['observacion'];
        $arrayData[] = $_POST['fecha_factura'];
        $arrayData[] = $_POST['periodo'];
     if($_POST['mes']=='ENE'){
		 $mess=1;
		 }
     if($_POST['mes']=='FEB'){
		 $mess=2;
		 }	
     if($_POST['mes']=='MAR'){
		 $mess=3;
		 }		
     if($_POST['mes']=='ABR'){
		 $mess=4;
		 }	
     if($_POST['mes']=='MAY'){
		 $mess=5;
		 }	
    if($_POST['mes']=='JUN'){
		 $mess=6;
		 }	
    if($_POST['mes']=='JUL'){
		 $mess=7;
		 }
    if($_POST['mes']=='AGO'){
		 $mess=8;
		 }
    if($_POST['mes']=='SEP'){
		 $mess=9;
		 }	
    if($_POST['mes']=='OCT'){
		 $mess=10;
		 }	
    if($_POST['mes']=='NOV'){
		 $mess=11;
		 }
    if($_POST['mes']=='DIC'){
		 $mess=12;
		 }            
                 
        $arrayData[] = $mess;
        $arrayData[] = $_POST['estatus'];
       //$arrayData[] = $id_usuario;
        $arrayData[] = $variablesSesion["id_usuario"];
       
//idfactura, contrato, fnumero, fmonto, obs, ffactura, per, me, esta, usu)

        
        $modificar_factura = $this->fmodel->consultas('modificar_factura', $arrayData);
         if ($modificar_factura[0][0]=='1'){
					
		 $configuracionSrvCorreo=$this->configuraEmail->configSrvEmail();
		 $this->email->initialize($configuracionSrvCorreo);
		 $this->email->from('sisconser@mijp.gob.ve', 'Sisconser' );
		 $this->email->to('franciscojavierlacruz@gmail.com,conciliacion@mijp.gob.ve, jgpenuela@mijp.gob.ve');
		 $this->email->subject( 'Modificacion de Datos de Facturas' );
		 $this->email->message("Se ha Modificado La Factura Nro: ".$arrayData[2].  " Por el Usuario: ".$arrayData1[0]);
		 $this->email->send();
		 
		$this->session->set_flashdata('msg', 'SU MODIFICACION FUE REALIZADA CON EXITO');		
        redirect('consulta_factura_controler/gestion_factura', 'refresh');
		
	     }       
        
    }
 
}
?>

