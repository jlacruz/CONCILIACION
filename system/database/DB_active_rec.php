<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_DB_active_record extends CI_DB_driver 
{
	function fdbDesConexion($conexion="")
		{
			pg_close();
		}
	function iniciarTransaccion()
		{
			return pg_query ("BEGIN WORK");
		}
	function aceptarTransacciones()
		{
			return pg_query ("COMMIT");
		}
	function cancelarTransaccion()
		{
			return pg_query ("ROLLBACK");
		}
	function SELECTPLSQL($funcion,$arrayParametros)
		{
			
			$parametros=array();
			foreach($arrayParametros as $indice=>$valores)
			{
				array_push($parametros,$valores);
			}
			
			if(count($parametros)>1)
				{
					$parametrosSeparados="";

						foreach($parametros as $indice=>$datos)
						{
								if($indice==0)
								{
									$parametrosSeparados.="'".$datos."'".",";
								}
								elseif($indice==1)
								{
									$parametrosSeparados.="'".$datos."'";
								}
								else
								{
									$parametrosSeparados.=","."'".$datos."'";	
								}
						}
				}
				elseif(count($parametros)==1)
				{
					$parametrosSeparados="'".$parametros[0]."'";
				}
				else
				{
					$parametrosSeparados="";
				}

			$sql="SELECT ".$funcion."(".$parametrosSeparados.");";
                        /*================================================*/
                        /*======= QUERY PARA IMPRIMIR LAS FUNCIONES ======*/
                        /*================================================*/
			//echo '<strong>'.$sql.'</strong><br />';
			$res = pg_query ($sql);

			$datosSelect=pg_fetch_array($res);
			$arrayFilasColumnas=array();
			
			//separar resultado en filas
			$separarFilas=explode("|",$datosSelect[0]);
			
			foreach($separarFilas as $indiceFilas=>$filas)
			{
				$separarColumnas=explode("~",$filas);
				foreach($separarColumnas as $indiceColumnas=>$columnas)
				{
					$arrayFilasColumnas[$indiceFilas][$indiceColumnas]=$columnas;
				}
			}
			if(count($arrayFilasColumnas)>0)
			return $arrayFilasColumnas;
			else
			return $arrayFilasColumnas[0][0]="";
		}	
}

/* End of file DB_active_rec.php */
/* Location: ./system/database/DB_active_rec.php */
