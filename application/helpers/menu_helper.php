<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function prepareList(array $items, $pid = 0) 
{
	$output = array();
	$a=1;
    foreach ($items as $item) 
	{
        if ((int) $item['parent_id'] == $pid)
		 {
			 //echo $item['parent_id']."<br>";
            if ($children = prepareList($items, $item['id']))
			 {
                $item['children'] = $children;
            }
            $output[] = $item;

			/*if($a==3)
			break;*/
        }
		$a++;
    }
    return $output;
}

function nav($menu_items, $child = false,$expandir="")
{
	 	$CI =& get_instance();
        $CI->load->database();
       // echo $CI->db->hostname; // give the config name here (hostname)
	    $CI->load->model(array('consultas_bandejas','consultas_usuarios'));
		
    $output = '';

    if (count($menu_items)>0) 
	{

        $output .= ($child === false) ? '<ul class="mtree transit">' : '<ul '.$expandir.' class="">' ;
		$variablesSesion=$CI->session->userdata('usuario');
		$rol=$variablesSesion['rol'];
        
		//Adjunto
				if($rol==5)
				{
					$id_dependencia_adjunto=$variablesSesion['id_dependencia'];
					$consultarDirectorDelAdjunto=$CI->consultas_usuarios->consultar_director_general_x_id_dependencia($id_dependencia_adjunto);
					$id_usuario=$consultarDirectorDelAdjunto[0][13];
				}
				else
				{
					$variablesSesion=$CI->session->userdata('usuario');
					$id_usuario=$variablesSesion['id_usuario'];
				}
		
		foreach ($menu_items as $item) 
		{
			if(isset($item['principal']))
			{
				if($item['principal']==1)
				{
					$expandir="id='expandido'";	
				}
				else
				{
					$expandir="";	
				}
			}
			else
			{
				$expandir="";
			}
            $output .= '<li '.$expandir.'>';
			
			//Verificamos si son las bandejas de Recibidas 
			$urlBandejas=explode('?',$item['url']);
		
			if(count($urlBandejas)>1)
			{
				$idBandeja=explode("=",$urlBandejas[1]);
				
				$contadorBandeja=$CI->consultas_bandejas->bandejas_consultar_no_leidas($id_usuario,$idBandeja[1]);
				//print_r($contadorBandeja);
				if($contadorBandeja[0][0]>0)
				{
					$contador_bandeja="<strong>( ".$contadorBandeja[0][0]." )</strong>";
				}
				else
				{
					$contador_bandeja="( ".$contadorBandeja[0][0]." )";
				}
			}
			else
			{
				$contador_bandeja="";
			}
			
            $output .= '<a href="'.$item['url'].'">' . $item['menu_item'] ." ".$contador_bandeja.'</a>';
			
            //check if there are any children
            if (isset($item['children']) && count($item['children'])) 
			{
				//print_r($item['children']);
                $output .= nav($item['children'], true,$expandir);
            }
            $output .= '</li>';
        }
        $output .= '</ul>';
    }
    return $output;
}
?>
