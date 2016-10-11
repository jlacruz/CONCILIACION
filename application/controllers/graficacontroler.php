<?php

class Graficacontroler extends CI_Controller {

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

    public function index() {

        $arrayData = array();
        $this->db_conciliacion = $this->load->database('default', true);
        $data['lista_proveedores'] = $this->fmodel->consultas('consultar_proveedores', $arrayData);

        $this->load->template('graficas_view', $data);
    }

     public function consulta_grafica() {


        if ($this->uri->segment(3) == "") {
            $desde = 0;
        } else {
            $desde = $this->uri->segment(3);
        }

        $pagination = 1;
        $hasta = $pagination;
        //print_r($_POST);
        $arrayData = array();
        extract($_POST);

        $arrayData[] = $proveedores;
        $arrayData1[] = $proveedores;
        //$arrayData2[] = $proveedores;


        $this->db_conciliacion = $this->load->database('default', true);
        $dataValor = $this->fmodel->consultas('reporte_grafica', $arrayData);
        //print_r($dataValor);
        
        $dataValor2 = $this->fmodel->consultas('consultar_proveedor_grafica', $arrayData1);
        //print_r($dataValor2);
         $bandera = $dataValor[0][0];
         //$bandera = $dataValor[0][1];
         //$bandera = $dataValor[0][2];

        if ($bandera == '') {

        echo'<script>
                alert("No posee registros para Graficar!");
                 window.location.href = "http://172.16.10.211/CONCILIACION/index.php/graficacontroler/index";
            </script>';
          
        }
 
        $this->load->library('highcharts');

		$valor_x_periodo=array();

		$facturas=array();
		$facturas[]=array();
		$ordenes=array();
		$ordenes[]=array();
		$indiceOrden=0;
		
		foreach($dataValor as $indice1 => $seriePeriodo)
		{
				if($seriePeriodo[0]!=0)
				{
					$facturas[$indice1][]=$seriePeriodo[0];
					
					$facturas[$indice1][]=$seriePeriodo[3];
					      if($seriePeriodo[3]==''){
							$seriePeriodo[3]==0;  
						  }
				} if($seriePeriodo[2]==''){
							$seriePeriodo[2]==0;  
						  }
				else
				{
					$ordenes[$indiceOrden][]=$seriePeriodo[1];
					$ordenes[$indiceOrden][]=$seriePeriodo[2];	
					$indiceOrden++;
					       
				}				
		}
		
		$periodoYmonto=array();
		$periodoYmonto[]=array();
		
		foreach($facturas as $indice1 => $cadaFactura)
		{
					
			$periodoYmonto[$indice1][]=$cadaFactura[0];
			$periodoYmonto[$indice1][]=$cadaFactura[1];
			$tieneOrden=0;
			
			foreach($ordenes as $indice2 => $cadaOrden)
			{
               
				if($cadaFactura[0]==$cadaOrden[0])
				{
					$periodoYmonto[$indice1][]=$cadaOrden[1];
					$tieneOrden=0;
				}
			
			}
			//Si no tiene Orden
			if($tieneOrden=='')
			{
				$periodoYmonto[$indice1][]=0;
			}
			
		}
	
		foreach($periodoYmonto as $indice => $seriePeriodo)
		{
			
				settype($seriePeriodo[1],'int');
				settype($seriePeriodo[2],'int');
				$valor_x[]=$seriePeriodo[0];
				$valor_x_facturado[]=$seriePeriodo[1];
				$valor_x_pagado[]=$seriePeriodo[2];

		}

		// some data series
		$data['facturado']['data'] =  $valor_x_facturado;
		$data['facturado']['name'] = "Facturado:";
		$data['pagado']['data'] = $valor_x_pagado;
		$data['pagado']['name'] = "Pagado:";
		$data['axis']['categories'] = $valor_x;
		
		$graph_data = $data;
			
		$this->load->library('highcharts');
	
		$this->highcharts->set_type('column'); // drauwing type
		$this->highcharts->set_title('GRAFICA DE CONCILIACION', $dataValor2); // set chart title: title, subtitle(optional)
		$this->highcharts->set_axis_titles('language', 'Cantidad'); // axis titles: x axis,  y axis
		
		$this->highcharts->set_xAxis($graph_data['axis']); // pushing categories for x axis labels
		$this->highcharts->set_serie($graph_data['facturado']); // the first serie
		$this->highcharts->set_serie($graph_data['pagado']); // second serie
		
		//@$credits->href = 'http://www.internetworldstats.com/stats7.htm';
		//@$credits->text = "Article on Internet Wold Stats";
		//$this->highcharts->set_credits($credits);
		
		$this->highcharts->render_to('my_div'); // choose a specific div to render to graph
		
		$data['charts'] = $this->highcharts->render(); // we render js and div in same time

        $this->load->template('reporte_grafico_view', $data);
    }
function _ar_data()
	{
		$data = $this->_data();
		foreach ($data['users']['data'] as $key => $val)
		{
			$output[] = (object)array(
				'users' 		=> $val,
				'population'	=> $data['popul']['data'][$key],
				'contries'		=> $data['axis']['categories'][$key]
			);
		}
		return $output;
	}

}

?>
