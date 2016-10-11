<?php

class Facturacontroler extends CI_Controller {
       // private $db_sistema_base;       
	function __construct()
	{
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

        $this->load->template('factura_view', $data);
    }

   
    public function consultar_cuenta_contrato() 
    {
        
        
        extract($_GET);
        //exit;
        $arrayData = array();
        $arrayData[] = $id_proveedor;
         if($id_proveedor==''){
			echo'<script>
        alert("Debe seleccionar un Proveedor");
        window.location.href = "http://172.16.10.211/CONCILIACION/index.php/facturacontroler/gestion_factura";
        </script>';
			
		}
		
		
		   else{

        $this->db_conciliacion = $this->load->database('default', true);
        $datos_cuenta = $this->fmodel->consultas('consultar_cuentacontrato', $arrayData);
        $existe_cuentacontrato = $this->fmodel->consultas('existe_cuentacontrato_proveedor', $arrayData);
        //print_r($existe_cuentacontrato);
         
        $bandera=$existe_cuentacontrato[0][0];
        
        if($bandera==0){
        
         echo'<script>
        alert("No Posee Cuentas Contrato Asociadas");
         window.location.href = "http://172.16.10.211/CONCILIACION/index.php/facturacontroler/gestion_factura";
         </script>';
            
          } 
       
        $comboCuenta = "<select name='cuenta_contrato' id='cuenta_contrato' required='required'class='form-control'>";
        
        $comboCuenta.="<option value='' >Seleccione...</option>";
        foreach ($datos_cuenta as $cuenta_contrato) {
			
			
        $comboCuenta.="<option value='" . $cuenta_contrato[0] . "'>$cuenta_contrato[1]</option>";
        }
        $comboCuenta.="</select>";

        echo $comboCuenta;
        
        
	 }
        
    }
    public function consultar_datos_proveedor() 
    {
        extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $id_proveedor;
       

        $this->db_conciliacion = $this->load->database('default', true);
        $data= $this->fmodel->consultas('consultar_proveedorfactura', $arrayData);
       // print_r($data); 
        $cod_proveedor=$data[0][0];
        $descripcion=$data[0][1];
        echo $cod_proveedor."~".$descripcion;
        //return $data;
  
        
    }
   
     public function consultar_factura() 
    { 
     
        extract($_POST);
        //print_r($_POST);
        $arrayData = array();
        $arrayData[] = $id_proveedor;
        $arrayData[] = $f_numero;

        $this->db_conciliacion = $this->load->database('default', true);
        $data= $this->fmodel->consultas('existe_factura', $arrayData);
 
        $bandera=$data[0][0];
        
     if($bandera==1){
        
      echo '1';
       
    }  else {
       echo '<input value="'.$f_numero.'"  id="f_numero" name="f_numero[]" type="text" size="10" required="required" onkeyup ="javascript:this.value=this.value.toUpperCase()" required pattern="[a-zA-Z0-9]{3,28}" title=\'Campo Alfanumerico (Sin Guiones)\'>';
      
        }
                    
    }
                                
    function insertar_factura() 
    {
        
        $variablesSesion=$this->session->userdata('usuario');
        $id_contrato = $_POST["cuenta_contrato"];
        $cantidad = count($_POST["f_numero"]);        
        $id_usuario = $variablesSesion["id_usuario"];

        if ($cantidad > 0) {
            for ($x = 0; $x < $cantidad; $x++) {

                $parametros = array();
                $parametros[] = $id_contrato;
                //$parametros[] = $id_usuario;
                $parametros[] = "" . strtoupper($_POST["f_numero"][$x] . "");
                $parametros[] = "" . strtoupper($_POST["f_monto"][$x] . "");
                $parametros[] = "" . strtoupper($_POST["observacion"][$x] . "");
 
                $anio=$_POST['anio'][$x];
	            $mes=$_POST['mes'][$x];
	            $dia=$_POST['dia'][$x];
	            $fecha_factura=$anio."-".$mes."-".$dia;
                
                $parametros[] = "".$fecha_factura."";
                $parametros[] = "" . strtoupper($_POST["periodo"][$x] . "");

                $parametros[] = "" . strtoupper($_POST["mes1"][$x] . "");
                $parametros[] = $id_usuario;
                //print_r($parametros);

                $insertar_factura = $this->fmodel->consultas('insertar_factura', $parametros);
                
          }
      
               // exit;
                if($insertar_factura[0][0]!=1){
                echo '<script>
                alert("El registro No Fue guardado Exitosamente, recuerde que los montos deben expresarse solo con un punto y dos cifras decimales");
                window.location.href = "http://172.16.10.211/CONCILIACION/index.php/facturacontroler/gestion_factura";
                </script>';
                
                }else{
                    
					echo 
					 $this->session->set_flashdata('msg', 'SU REGISTRO FUE REALIZADO CON EXITO');
                redirect('facturacontroler/gestion_factura', 'refresh');
				}
      
      
      }
  } 

}
  
?>
