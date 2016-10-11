<?php
	if(isset($id_acuse))
	{
		$consultarAdjunto=$this->consultas_correspondencia->acuse_consultar_especifico($id_acuse);
	}
	else
	{
		$consultarAdjunto=$this->consultas_correspondencia->consultar_adjuntos($id_adjunto,$registrada_o_redactada);	
	}
	/*echo "<pre>";
	print_r($consultarAdjunto);
	echo "</pre>";*/
	$img=pg_unescape_bytea($consultarAdjunto[0][2]);
	
    header("Content-Disposition:inline; filename=\"" . trim(htmlentities("Adjunto".$id_adjunto)) . "\"");
	if($consultarAdjunto[0][1]==1)
    	header("Content-Type: image/jpg");
	else
		header("Content-Type: application/pdf");
  
    echo $archivo=pg_unescape_bytea($consultarAdjunto[0][2]);
?>