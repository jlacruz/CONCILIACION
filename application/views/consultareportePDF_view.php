
 <?php $variablesSesion=$this->session->userdata('usuario'); ?>
        <?php
        $datestring = "%d-%m-%Y  ";
        $anio = date("Y");
        $attributes = array('class' => '', 'id' => '');
        ?>
        <?php
        $nom_empresa = array(
            'name' => 'nom_empresa',
            'id' => 'nom_empresa',
            'value' => $v2_nom_empresa
            
        );
         
        $descripcion = array(/* servicio */
            'name' => 'descripcion',
            'id' => 'descripcion',
            'value' => $v2_descripcion,
            'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
        );
        $idproveedor = array(/* servicio */
            'name' => 'id_proveedor',
            'id' => '$id_proveedor',
            'type' => 'hidden',
            'value' => $idProveedor
        );
        $periodoV = array(/* servicio */
            'name' => 'periodo',
            'id' => 'periodo',
            'type' => 'hidden',
            'value' => $periodo
        );
        $facturado = 0;
        $pagado = 0;
        $saldo = 0;
        $diferencia = 0;
        ?>
<?php
if ($data[0][0] != "") {
    $contenido = "";
    $facturado = 0;
    $diferencia = 0;
    $pagado = 0;
    foreach ($data as $resultado) {
		$nombre_format_francais1 = number_format($resultado[4], 2, ',', '. ');
		$nombre_format_francais2 = number_format($diferencia, 2, ',', '. ');
		$nombre_format_francais3 = number_format($resultado[3], 2, ',', '. ');

        $facturado = $facturado + $resultado[4];
        $pagado = $pagado + $resultado[3];
        $diferencia = $resultado[3] - $facturado;
        $saldo=$pagado-$facturado;
        $contenido.="<tr>
          <td>" . $resultado[0] . "</td>
          <td>" . $resultado[6] . "</td>
          <td>" . $resultado[1] . "</td>
          <td>" . $resultado[2] . "</td>
          <td>" . $resultado[5] . "</td>
          <td>" . $nombre_format_francais3 . "</td>
          <td>" . $nombre_format_francais1 . "</td>
          <td>" . $nombre_format_francais2 . "</td></tr>";
    }
} else {
    $contenido = '
                <div class="alert alert-danger">
                <strong>No se Encontraron datos para esta busquedad!</strong>
                <a class="alert-link" href="#">Volver a consultar.</a>
	         </div>';
}
?>

   <table class="table table-hover">

        <tr>
            <td colspan="6"  align="center"><strong><h3>SISTEMA DE CONCILIACI&Oacute;N DE SERVICIOS </h3> </strong></td>
             
        </tr>
        <tr>
            <td colspan="6" align="center"><strong><h4>DIRECCI&Oacute;N GENERAL DE LA OFICINA DE GESTI&Oacute;N ADMINISTRATIVA</h5> </strong></td>
             
        </tr>
        <tr>
            <td colspan="6" align="center" ><strong><h4>DIRECCI&Oacute;N DE FINANZAS </h5> </strong></td>
             
        </tr>
        <tr>
            <td colspan="6" align="center"><strong><h4>COORDINACI&Oacute;N DE CONTABILIDAD FISCAL </h5> </strong></td>
             
        </tr>
        <tr>
            <td colspan="6" align="center"><div align="center"><strong><h4>Estado de Cuenta Anual</h4></strong></div></td>
        </tr>
        <tr>
            <td width="150" height="46"><div align="center">Organismo: </div></td>
            <td width="100"><div align="left">MPPRIJP</div></td>
          <td width="93" ><div align="center">Proveedor:</div></td> 
          <td width="257"><div align="left"><?php echo $v2_nom_empresa ?></div></td>
          <td width="81" ><div align="center">Servicio:</div></td>
          <td width="209"><div align="left"><?php echo $v2_descripcion ?></div></td>
        </tr>
        <tr>
            <td>Fecha del Reporte:</td>
            <td align="left"><div align="left"> <?php echo mdate($datestring) ?> </div></td>
            <td ><?php echo form_input($idproveedor) ?></td>
            <td></td>
            <td><?php echo form_input($periodoV) ?></td>
            <td></td>
        </tr>  

        <tr>
            <td colspan="6" align="center"><strong>MOVIMIENTOS</strong></td>
        </tr>
    </table>
        <br/>
        <table width="821" align="center" border="0">
            
            <tr>
                <td width="90"  class="active"><div align="left"><strong>N. Factura</strong></div></td>
                <td width="138"  class="active"><div align="left"><strong>Cta Contrato</strong></div></td>
                <td width="103"  class="active"><div align="left"><strong>N. &Oacute;rden</strong></div></td>
                <td width="92"  class="active"><div align="left"><strong>Fecha</strong></div></td>
                <td width="65"  class="active"><div align="left"><strong>Mes</strong></div></td>
                <td width="134"  class="active"><div align="left"><strong>Pago</strong></div></td>
                <td width="114"  class="active"><div align="left"><strong>Facturaci&oacute;n</strong></div></td>
                <td width="131"  class="active"><div align="left"><strong>Diferencias</strong></div></td>
            </tr>
            
      
     
      
      
      
<?php

$nombre_format_francais1 = number_format($facturado, 2, ',', '.');
$nombre_format_francais2 = number_format($saldo, 2, ',', '.');
$nombre_format_francais3 = number_format($pagado, 2, ',', '.');
echo $contenido;



if($facturado > $pagado)
{
    $nombre_format_francais2='Acreencia= '.$nombre_format_francais2;

}
if ($facturado < $pagado)
{
    $nombre_format_francais2= 'A favor MIJP='.$nombre_format_francais2;

}
echo $resultados='


</table>
     <table width="1292" border="0" >
			 <tr>
                <td colspan="8"  bgcolor="#F4F5F5" class="active"><div align="center"><strong><h2>TOTALES</h2></strong></div>
                <div align="left"></div><div align="left"></div><div align="left"></div><div align="left"></div><div align="left"></div><div align="left"></div><div align="left"></div></td>
                </tr>
			<tr>
              <td width="193"  class="active"><div align="left"><strong><h2>Total Facturado </h2></strong></div></td>
              <td width="51"  class="active"><div align="left"></div></td>
              <td width="98"  class="active"><div align="left"></div></td>
                <td width="84"  class="active"><div align="left"></div></td>
                <td width="312"  class="active"><div align="left"></div></td>
              <td width="168"  class="active"><div align="left"></div></td>
                <td colspan="2"  class="active"><div align="left"><h2>' . $nombre_format_francais1 . '</h2></div></td>
                </tr>
			<tr>
              <td width="193"  class="active"><div align="left"><strong><h2>Total Pagado</h2> </strong></div></td>
              <td width="51"  class="active"><div align="left"></div></td>
              <td width="98"  class="active"><div align="left"></div></td>
                <td width="84"  class="active"><div align="left"></div></td>
                <td width="312"  class="active"><div align="left"></div></td>
                <td colspan="3"  class="active"><div align="left"><h2>' . $nombre_format_francais3 . '</h2></div><div align="left"></div></td>
                </tr>
			<tr>
              <td width="193"  class="active"><div align="left"><strong><h2></h2></strong></div></td>
              <td width="51"  class="active"><div align="left"></div></td>
              <td width="98"  class="active"><div align="left"></div></td>
                <td width="84"  class="active"><div align="left"></div></td>
                <td width="312"  class="active"><div align="left"></div></td>
              <td width="168"  class="active"><div align="left"></div></td>
              <td width="121"  class="active"><div align="left"></div></td>
                <td width="229"  class="active"><div align="left"><h2></h2></div></td>
            </tr>
			
		
			 </table>
			<table width="1465" border="0" >
			
			<tr>
			  <td width="193"  class="active"><div align="left"><strong><h2>RESULTADO</h2></strong></div></td>
              <td width="36"  class="active"><div align="left"></div></td>
              <td width="73"  class="active"><div align="left"></div></td>
              <td width="62"  class="active"><div align="left"></div></td>
              <td width="236"  class="active"><div align="left"></div></td>
              <td width="184"  class="active"><div align="left"></div></td>
              <td width="322"  class="active"><div align="left"></div></td>
              <td width="314"  class="active"><div align="left"><h2>' . $nombre_format_francais2 . '</h2>
                  </div></td>
            </tr>					
      </table>

 '
  ?>     
        
        
      <table> 
    
     <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
      <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
      <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
      <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
      <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
      <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
    <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"><h2> Nombre y Apellido</h2></td>
          <td class="active" align="center"> <font color=white>_______________</font></td>
          <td width="150" class="active" align="center" ><h2>Nombre y Apellido</h2></td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center"><h2>Nombre y Apellido</h2></td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr>
       <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"> <font color=white>Analista</font></td>
          <td class="active" align="center"> <font color=white>_______________</font></td>
          <td width="150" class="active" align="center" > <font color=white>Nombre y Apellido</font></td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center"><font color=white>Nombre y Apellido</font></td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr></br>
      
       <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"><h2><?php echo $variablesSesion['nombre']." ".$variablesSesion['p_apellido'] ?></h2></td>
          <td class="active" align="center"> <font color=white>_______________</font></td></Br>
          <td width="150" class="active" align="center" >______________________________________</td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center">______________________________________</td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr>
      <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"> <font color=white>Analista</font></td>
          <td class="active" align="center"> <font color=white>_______________</font></td>
          <td width="150" class="active" align="center" > <font color=white>Nombre y Apellido</font></td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center"><font color=white>Nombre y Apellido</font></td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr></br>
      <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"><h2> Firma___________________</h2></td>
          <td class="active" align="center"> <font color=white>_______________</font></td>
          <td width="150" class="active" align="center" ><h2>Firma___________________</h2></td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center"><h2>Firma___________________</h2></td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr></br>
      <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"> <font color=white><h2>Analista</h2></font></td>
          <td class="active" align="center"> <font color=white>_______________</font></td>
          <td width="150" class="active" align="center" > <font color=white><h2>Nombre y Apellido</h2></font></td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center"><font color=white>Nombre y Apellido</font></td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr></br>
      <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"> <h2>Analista</h2></td>
          <td class="active" align="center"> <font color=white>_______________</font></td>
          <td width="150" class="active" align="center" ><h2>Coordinador de Contabilidad</h2></td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center"><h2>Director de Finanzas</h2></td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr></br>
      
      </table>
   
   
   
   
	  
  
   
   
<!--===================================================================================================================== -->      
<!--===================================== SALTO DE PAGINA =============================================================== --> 
<!--===================================================================================================================== -->   



   
<!--<table class="table table-hover">

         <tr>
            <td colspan="6" align="center"><strong><h4>DIRECCI&Oacute;N GENERAL DE LA OFICINA DE GESTI&Oacute;N ADMINISTRATIVA</h5> </strong></td>
        </tr>
        <tr>
            <td colspan="6" align="center" ><strong><h4>DIRECCI&Oacute;N DE FINANZAS </h5> </strong></td>
        </tr>
        <tr>
          <td colspan="6" align="center"><h4>
            COORDINACI&Oacute;N DE CONTABILIDAD FISCAL
            </h5>
            </strong></td>
        </tr>
        <tr>
          <td colspan="6" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" align="center"><strong>ACTA DE CONCILACI&Oacute;N </strong></td>
        </tr>
        <tr>
          <td colspan="6" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" align="center"><strong><h4></td>
        </tr>
        <table>
         <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
         </table>
        
        <tr>
            <td align="left"> <div align="justify"><font color=white>_______</font>   Los representantes debidamente autorizados por la empresa 
              <?php  echo  $v2_nom_empresa ?>
              y del MINISTERIO DEL PODER POPULAR PARA RELACIONES INTERIORES JUSTICIA Y PAZ,
  declaran que, analizados los antecedentes presentados por las partes en relaci&oacute;n con los derechos y obligaciones el per&iacute;odo
    <?php  echo  $v2_nom_empresa ?>
            , por el servicio de <?php echo $v2_descripcion ?> en los diversos entes adscritos y las oficinas pertenecientes a este ente Ministerial, resueltas las diferencias que se encontaron, asi como realizada la compensac&oacute;n
            de derecchos y obligaciones entre las partes con el fin de obtener el saldo deudor y acreedor respectivo se llego al acuerdo que el MINISTERIO DEL PODER POPULAR PARA RELACIONES INTERIORES JUSTICIA Y PAZ
            , deber&aacute; cancelar la deuda por Acreencia No preescrita a la empresa
            <?php  echo  $v2_nom_empresa ?>
            , ya que es un compromiso v&aacute;lidamente contra&iacute;do en ejercicios fiscales anteriores. Por la cantidad de
            <?php  echo  $cambio  ?> 
            (
            <?php  echo  $saldo ?> 
            Bs)</div></td>
        </tr>
        <table>
         <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
         </table>
        <tr>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
            <td align="left"> <div align="center"><font color=white>_______</font>   Se elaboran tres (3) ejemplares en la Ciudad de Caracas, en fecha  <?php echo mdate($datestring) ?></div></td>
        </tr>
        <table>
         <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
         </table>
         <table>
         <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
         </table>
         <table>
         <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
         </table>
         <table>
         <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
         </table>
         <table>
         <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
         </table>
         <table>
         <tr>
          <td><font color=white> _______________</font></td>
          <td> <font color=white>_______________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>________________</font></td>
          <td><font color=white>_______________</font></td>
      </tr>
         </table>
 <table>
        <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"> Organismo Acreedor</td>
          <td class="active" align="center"> <font color=white>_______________</font></td>
          <td width="150" class="active" align="center" >Organismo Deudor</td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr>
 </table> 

      
    </table>-->


 
        
    </body>        
</html>





