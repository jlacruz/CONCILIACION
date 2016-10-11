<?php

class Consultarnomcontroler extends CI_Controller {

    private $db_sigefirrh;

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
    }

    public function consultanom() {

        $this->load->template('consultarNOM_view');
    }
	
	 public function buscarDatos() {
		 
		 if($this->uri->segment(3)=="")
		{
			$desde=0;
			
		}
		else
		{
			$desde=$this->uri->segment(3);	
		}
		
		$pagination = 3;
		$hasta=$pagination;
		
		//print_r($_POST);
        extract($_GET);
		
		$arrayData = array();
        $arrayData[] = $nombre;
		$arrayData[] = $apellido;
		$arrayData[] = $hasta;
		$arrayData[] = $desde;
        $this->db_sigefirrh = $this->load->database('default2', true);
        $datos_funcionario = $this->pmodel->consultas('consultar_sueldo_personal_mijp_activos_por_nombres', $arrayData);
		$arrayData2 = array();
        $arrayData2[] = $nombre;
		$arrayData2[] = $apellido;
		$cantidadTuplas = $this->pmodel->consultas('consultar_cantidad_funcionario_por_nombre', $arrayData2);
		
		$cantidad=$cantidadTuplas[0][0];
	
			
			///////////////listar/////////////////////
			$config['base_url'] = base_url().'index.php/consultarnomcontroler/buscarDatos';
			$config['total_rows'] = $cantidad;
			$config['uri_segment']     = 3;
	
			$config['per_page']        = $pagination;
			$config['is_ajax_paging']      =  TRUE; // default FALSE
			$config['paging_function'] = 'ajax_paging'; // Your jQuery paging
			
			$config['per_page']        = $pagination;
			$config['is_ajax_paging']      =  TRUE; // default FALSE
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
	
		$this->pagination->initialize($config);
		$vars['desde']=$this->uri->segment(3);
		$vars['titulo'] = 'Funcionario';
		$vars['resultados'] = $datos_funcionario;
		$vars['nombre']=$nombre;
		$vars['apellido']=$apellido;
			
		if($this->uri->segment(3)=="")
		{
			$this->load->template('listarFUN_view',$vars);
			
		}
		else
		{
			$this->load->view('listarFUN_view',$vars);	
		}
			
    }
	
	 public function MostrarDetalle() {
		 
		extract($_GET);
		$variables=array();
			
		extract($_POST);
		$cedula=base64_decode($vars);
		$cedula=explode("=",$cedula);
		$cedula=$cedula[1];
		$arrayData = array();
        $arrayData[] = $cedula;
         $this->db_sigefirrh = $this->load->database('default2', true);
        $datos = $this->pmodel->consultas('consultar_sueldo_personal_mijp_activos', $arrayData);
      		//print_r($datos);
		
			$vars=array();
			$vars['nombres']=$datos[0][0];
			$vars['nombres2']=$datos[0][1];
			$vars['apellidos']=$datos[0][2];
			if ($datos[0][3] == 'S'){
				$datos[0][3]='SOLTERO(A)';
				$vars['estadoCivil']=$datos[0][3];
			}
			if ($datos[0][3] == 'C'){
				$datos[0][3]='CASADO(A)';
				$vars['estadoCivil']=$datos[0][3];
			}
			if ($datos[0][3] == 'O'){
				$datos[0][3]='VIUDO(A)';
				$vars['estadoCivil']=$datos[0][3];
			}
			if ($datos[0][3] == 'D'){
				$datos[0][3]='DIVORCIADO(A)';
				$vars['estadoCivil']=$datos[0][3];
			}
			$vars['cedulaF']=$datos[0][4];
			$vars['direccion']=$datos[0][5];
			$vars['telefonoCasa']=$datos[0][6];
			$vars['telefonoMovil']=$datos[0][7];
			$vars['nivelacademico']=$datos[0][8];
			$vars['cargo']=$datos[0][9];
			$vars['fechaIngreso']=$datos[0][10];
			
			if ($datos[0][11] == 'A'){
				$datos[0][11]='ACTIVO(A)';
				$vars['estaus']=$datos[0][11];
			}
			if ($datos[0][11] == 'E'){
				$datos[0][11]='EGRESADO(A)';
				$vars['estaus']=$datos[0][11];
			}
			
			$vars['depertamento']=$datos[0][12];
			$vars['oficina']=$datos[0][13];
			$vars['sueldo']=$datos[0][14];
			if ($datos[0][15] == 'N'){
				$datos[0][15]='NO';
				$vars['hijos']=$datos[0][15];
			}else
			$datos[0][15]='SI';
				$vars['hijos']=$datos[0][15];
	
			$vars['ciudadResidencia']=$datos[0][16];
			$vars['fechaNac']=$datos[0][17];
			$vars['foto']=' <img src=" http://172.16.10.211/INTRANETD/sistemas/CARNETS_NUEVA_VERSION/CARNETS_NUEVA_VERSION/paginas/fotos/'.$datos[0][4].'.jpg" alt="foto" height="150px" width="150px"> ';
			$this->load->template('mostradatosCI_view',$vars);
		 
    }

    }

?>
