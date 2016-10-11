<?php
//print_r($this->session->userdata('usuario'));
$controladorMetodo=$this->uri->segment(1)."/".$this->uri->segment(2);
//echo $acceso;
//exit;
if($this->session->userdata('usuario'))
	{

				//Obtenemos el rol de la sesión
				//El menu del usuario
				//$menu=$variablesSesion['menu'];
				$accesoCasoUso=array();
				$accesoCasoUso[1]="principal/";
				//creamos el menu como variable de session
				
				//Obtenemos el rol de la sesión
				$id_usuario=$variablesSesion['id_usuario'];
				
				//consultamos los submenues
				$consultarSubMenu=$this->consultas_usuarios->consultar_sub_menu($id_usuario);
			
				//obtenemos los id de los sub Menus para saber los padres
				$idSubMenus='{';
				$separadorIdSubMenues='';
				
    			//obtener el id sub opciones
				//obtenemos los id de los sub Menus para saber los padres
				$idOpciones='{';
			
				$subMenus=array();
				foreach($consultarSubMenu as $elementosSubMenu)
				{
					$idOpciones.=$separadorIdSubMenues.$elementosSubMenu[4];
					//$idSubOpciones.=$separadorIdSubMenues.$elementosSubMenu[5];
					$idSubMenus.=$separadorIdSubMenues.$elementosSubMenu[2];
					$separadorIdSubMenues=',';
			
				}
				//Preparamos el int[] del la función PGPLSQ que va de la siguiente forma ejemplo:{1,2,3}
				$idSubMenus.='}';
			
				//Consultamos los menues padre
				$consultarMenuesPadre=$this->consultas_usuarios->consultar_menu_padre($idSubMenus);
				
				$menu=array();
				$contadorMenuPadre=1;
				foreach($consultarMenuesPadre as $indiceMenuPadre => $elementosMenuesPadre)
				{
					//$elementosMenuesPadre[0];
					//echo "-->".$elementosMenuesPadre[2];
					if($elementosMenuesPadre[2]=="true")
					{
						$principal=1;
					}
					else
					{
						$principal=0;	
					}
					$menu[$indiceMenuPadre]= array('id'=>$elementosMenuesPadre[0],'menu_item' => $elementosMenuesPadre[1],'parent_id' => 0,'url'=>'javascript:void(0)','principal'=>$principal);
					
					$contadorMenuPadre++;
					if($elementosMenuesPadre[0]==$contadorMenuPadre)
					{
						$contadorMenuPadre++;
					}
				}
			
				/*Aquí se obtiene el último Id del menu padre y le sumamos 1 para no solapar los id anteriores, luego al contador de los submenus le sumamos 1 por que desfazamos al sumarle 1 indiceMenuPadre, asi que le sumamos 1 para que recorra las veces que son*/
				
				$recorreFilasOpciones=0;
				for($IndiceSubMenu=0;$IndiceSubMenu<=count($consultarSubMenu)-1;$IndiceSubMenu++)
				{
					//if($contadorMenuPadre)
					
					//validamos si es un Link vacio
					if($consultarSubMenu[$recorreFilasOpciones][3]=="#")
					{
						$url='javascript:void(0)';
					}
					else
					{
						$url=base_url().'index.php/'.$consultarSubMenu[$recorreFilasOpciones][3];	
					}

					$menu[]= array('id'=>$contadorMenuPadre,'menu_item' => $consultarSubMenu[$recorreFilasOpciones][1],'parent_id' => $consultarSubMenu[$recorreFilasOpciones][2],'url'=>$url);
					
					
					$accesoCasoUso[]=$consultarSubMenu[$recorreFilasOpciones][3];
					
					//Consultar Sub Opciones por cada opcion
					if($consultarSubMenu[$recorreFilasOpciones][5]!="{}")
					{
						$consultarSubOpciones=$this->consultas_usuarios->consultar_sub_opciones($consultarSubMenu[$recorreFilasOpciones][5]);
					
							//id de la sub Operación
							if($consultarSubOpciones!="")
							{
								$ids_parent_id=$contadorMenuPadre;
								foreach($consultarSubOpciones as $datosSubOpciones)
								{
									$contadorMenuPadre++;
									$menu[]= array('id'=>$contadorMenuPadre,'menu_item' => $datosSubOpciones[3],'parent_id' => $ids_parent_id,'url'=>base_url().'index.php/'.$datosSubOpciones[2]);
									$accesoCasoUso[]=$datosSubOpciones[2];
								}
							}
					  }
					$recorreFilasOpciones++;
					$contadorMenuPadre++;
				}	
	}
	/*echo "<pre>";
		print_r($menu);
	echo "</pre>";
	exit;*/
?>