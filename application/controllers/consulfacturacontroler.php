<?php

class Consulfacturacontroler extends CI_Controller{

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

        $this->load->template('consulfactura_view', $data);
    }

    public function consulta_factura() {
        $variablesSesion=$this->session->userdata('usuario');

        //print_r($_POST);
        $arrayData = array();
        extract($_POST);
        
        $arrayData[] = $id_proveedor;
        $arrayData[] = $periodo;
        $arrayData[] = $f_numero;
        
        $this->db_conciliacion = $this->load->database('default', true);
        $data = $this->fmodel->consultas('consultar_factura', $arrayData);

        if (isset($data[0][0], $data[0][4], $data[0][9])) {
            //print_r($data);
            $variables['v_nom_empresa'] = $data[0][0];
            $variables['v_cod_proveedor'] = $data[0][1];
            $variables['v_cuenta_contrato'] = $data[0][2];
            $variables['v_descripcion'] = $data[0][3];
            $variables['v_f_numero'] = $data[0][4];
            $variables['v_f_monto'] = $data[0][5];
            $variables['v_observacion'] = $data[0][6];
            $variables['v_fecha_carga'] = $data[0][7];
            $variables['v_fecha_factura'] = $data[0][8];
            $variables['v_periodo'] = $data[0][9];
            $variables['v_id_factura'] = $data[0][10];
            $variables['v_id_contrato'] = $data[0][11];
            $variables['v_id_usuario'] = $data[0][12];
            $variables['v_mes'] = $data[0][13];
            //echo $nom_empresa . "~" . $cod_proveedor . "~" . $cuenta_contrato . "~" . $descripcion . "~" . $f_numero . "~" . $f_monto . "~" . $observacion . "~" . $fecha_carga . "~" . $fecha_factura . "~" . $periodo;
            $variables['comboCuenta'] = $this->consultar_cuenta_contrato($id_proveedor, $variables['v_id_contrato']);
            $this->load->view('consulfactura2_view', $variables);
            } else {
                echo '</div>
                        <div class="alert alert-info">
                        <strong>No se Encontraron datos para esta busqueda!</strong>
                    </div>';
            }
        }

  
    public function consultar_cuenta_contrato($id_proveedor = 0, $cuentaSeleccionada = 0) {

        extract($_GET);
        //exit;
        $arrayData = array();
        $arrayData[] = $id_proveedor;

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

    public function actualizar_factura() {
        $variablesSesion=$this->session->userdata('usuario');
         //print_r($POST);
        extract($_POST);
        $arrayData[] = $id_factura;
        $arrayData[] = $id_contrato;
        $arrayData[] = $f_numero;
        $arrayData[] = $f_monto;
        $arrayData[] = $observacion;
        $arrayData[] = $fecha_factura;
        $arrayData[] = $periodo;
        $arrayData[] = $estatus;
        //$arrayData[] = $id_usuario;
        $arrayData[] = $variablesSesion["id_usuario"];


        $modificar_factura = $this->fmodel->consultas('modificar_factura', $arrayData);
        $this->session->set_flashdata('msg', 'SU MODIFICACION FUE REALIZADA CON EXITO');
        redirect('consulfacturarcontroler/consulta_factura', 'refresh');
    }

    function reporte() {
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        if ($this->input->post('fe_reporte')) {

            $fe_reporte = $this->input->post('fe_reporte');
            $this->db_b = $this->load->database('carnet', true);
            //print_r($this->db_b);

            $consultarFuncionario = $this->consultas_usuarios->consultar_reporte($fe_reporte);
            //print_r($consultarFuncionario);
            if ($consultarFuncionario[0][0] == 0) {
                echo "<script>
                alert('No se encontraron registro para la fecha seleccionada');
				location.href ='http://172.16.10.211/INTRANETD/sistemas/consultaPensionado/index.php/principal/procesar';
                </script>";
               
            }

            $datosTupla = "";
            foreach ($consultarFuncionario as $datosFilas) {

                $datosfuncionario = explode("@", $datosFilas[0]);
                $datosTupla.=
                        "<tr>
			    <td>" . $datosfuncionario[0] . "</td>	
			    <td>" . $datosfuncionario[1] . "</td>	
		       	    <td>" . $datosfuncionario[2] . "</td>	
			    <td>" . $datosfuncionario[3] . "</td>	
			    <td>" . $datosfuncionario[4] . "</td>	
			    <td>" . $datosfuncionario[6] . "</td>	
			</tr>";
            }

            $vars = array();
            $vars['datosTupla'] = $datosTupla;
            $vars['fecha'] = $fe_reporte;
            $html = $this->load->view('reporteFecha', $vars, true);
            $pdf->SetHtmlHeader('<img width="900px" height="100px" src="' . base_url() . APPPATH . 'imagenes/cabecera.png">');
            $pdf->WriteHTML($html);
            $pdf->SetHtmlFooter('<img width="900px" height="100px" src="' . base_url() . APPPATH . 'imagenes/footer2013.png">');
            $pdf->Output();
        } else {
            $this->load->template('html_reporte');
        }
    }

}
?>


