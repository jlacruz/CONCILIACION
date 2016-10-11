<?php

class Ordenpagocontroler extends CI_Controller {

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
        $this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
		$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
		$this->output->set_header("Pragma: no-cache");  
    }

    public function gestion_ordenpago() {

        $arrayData = array();
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->omodel->consultas('consultar_proveedores', $arrayData);


        $this->load->template('ordenpago_view', $data);
    }

    public function consultar_datos_proveedor() {
        extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $id_proveedor;
        if($id_proveedor=='0'){
			echo'
 Debe seleccionar un Proveedor
';
			
		}   else{

        $this->db_conciliacion = $this->load->database('default', true);
        $data = $this->omodel->consultas('consultar_proveedorfactura', $arrayData);
        // print_r($data); 
        $cod_proveedor = $data[0][0];
        $descripcion = $data[0][1];
        echo $cod_proveedor . "~" . $descripcion;
        //return $data;
    }
}
     public function consultar_orden() 
    { 
     
        extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $id_proveedor;
        $arrayData[] = $o_numero;

        $this->db_conciliacion = $this->load->database('default', true);
        $data= $this->omodel->consultas('existe_orden', $arrayData);
 
        $bandera=$data[0][0];
        
    if($bandera==1){
        
      echo '1';
       
    }  else {
       echo '<input value="'.$o_numero.'"  id="o_numero" name="o_numero[]" type="text" size="10" required="required" onkeyup ="javascript:this.value=this.value.toUpperCase()" required pattern="[a-zA-Z0-9]{3,18}" title=\'Campo Alfanumerico (Sin Guiones)\'>';
       
    }
              
  
        
    }
    

    function insertar_orden() 
    {
        $variablesSesion=$this->session->userdata('usuario');
        $proveedores = $_POST["proveedores"];
        $cantidad = count($_POST["o_numero"]);
        /*$cantidad = count($_POST["o_monto"]);
        $cantidad = count($_POST["observacion"]);
        $cantidad = count($_POST["anio"]);
        $cantidad = count($_POST["mes"]);
        $cantidad = count($_POST["dia"]);
        $cantidad = count($_POST["periodo"]);
        $id_usuario = $variablesSesion["id_usuario"];*/

        //print_r($_POST);

        if ($cantidad > 0) {
            for ($x = 0; $x < $cantidad; $x++) {

                $parametros = array();
                $parametros[] = $proveedores;
                $parametros[] = "" . strtoupper($_POST["o_numero"][$x] . "");
                $parametros[] = "" . strtoupper($_POST["o_monto"][$x] . "");
                $parametros[] = "" . strtoupper($_POST["observacion"][$x] . "");
 
                $anio=$_POST['anio'][$x];
	            $mes=$_POST['mes'][$x];
	            $dia=$_POST['dia'][$x];
	            $fecha_orden=$anio."-".$mes."-".$dia;
                
                $parametros[] = "".$fecha_orden."";
                $parametros[] = "" . strtoupper($_POST["periodo"][$x] . "");
                //print_r($parametros);

                $insertar_orden = $this->omodel->consultas('insertar_ordenpago', $parametros);
                //exit;
                 }
      
                //exit;
                if($insertar_orden[0][0]!=1){
                echo '<script>
                alert("La Orden No Fue guardada Exitosamente, recuerde que los montos deben expresarse solo con un punto y dos cifras decimales");
                window.location.href = "http://172.16.10.211/CONCILIACION/index.php/ordenpagocontroler/gestion_ordenpago";
                </script>';
                
                }else{
                    
					echo 
					 $this->session->set_flashdata('msg', 'SU REGISTRO FUE REALIZADO CON EXITO');
                redirect('ordenpagocontroler/gestion_ordenpago', 'refresh');
				     }
        
        }
    }

}
?>
        
             
           
