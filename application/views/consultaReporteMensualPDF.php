
 <?php $variablesSesion=$this->session->userdata('usuario'); ?>

<html lang="es">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH ?>css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH ?>css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() .APPPATH ?>css/estilos.css" />
        


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
$nombre_format_francais = number_format($facturado, 2, ',', '. ');
$nombre_format_francais2 = number_format($resultado[5], 2, ',', '. ');
if ($data[0][0] != "") {
    $contenido = "";
    $facturado = 0;
    $diferencia = 0;
    $pagado = 0;
    foreach ($data as $resultado) {
		$nombre_format_francais = number_format($resultado[5], 2, ',', '. ');

         $facturado = $facturado + $resultado[5];
        /*$pagado = $pagado + $resultado[3];
        $diferencia = $resultado[3] - $facturado;
        $saldo=$facturado-$pagado;*/
        $contenido.="<tr>
          <td>" . $resultado[4] . "</td>
          <td>" . $resultado[2] . "</td>
          <td>" . $resultado[7] . "</td>
          <td>" . $resultado[8] . "</td>
          <td>" . $resultado[13] . "</td>
          <td>" . $nombre_format_francais  . "</td></tr>";
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
            <td colspan="6" bgcolor="#EBECEC"><strong><h3>SISTEMA DE CONCILIACI&Oacute;N DE SERVICIOS </h3> </strong></td>
             
        </tr>
        <tr>
            <td colspan="6" bgcolor="#EBECEC"><strong><h4>DIRECCI&Oacute;N GENERAL DE LA OFICINA DE GESTI&Oacute;N ADMINISTRATIVA</h5> </strong></td>
             
        </tr>
        <tr>
            <td colspan="6" bgcolor="#EBECEC"><strong><h4>DIRECCI&Oacute;N DE FINANZAS </h5> </strong></td>
             
        </tr>
        <tr>
            <td colspan="6" bgcolor="#EBECEC"><strong><h4>COORDINACI&Oacute;N DE CONTABILIDAD FISCAL </h5> </strong></td>
             
        </tr>
        <tr>
            <td height="28" colspan="6"><div align="center"><strong><h4>Estado de Cuenta Mensual</h4></strong></div></td>
        </tr>
        <tr>
            <td width="150" height="46" bgcolor="#F7F7F7"><div align="center">Organismo: </div></td>
            <td width="100"><div align="left">MPPRIJP</div></td>
            <td width="150" bgcolor="#F7F7F7"><div align="center">Proveedor:</div></td> 
            <td width="250"><div align="left"><?php echo $v2_nom_empresa ?></div></td>
            <td width="120" bgcolor="#F7F7F7"><div align="center">Servicio:</div></td>
            <td width="120"><div align="left"><?php echo $v2_descripcion ?></div></td>
        </tr>
        <tr>
            <td>Fecha del Reporte:</td>
            <td align="left"><div align="left"> <?php echo mdate($datestring) ?> </div></td>
            <td bgcolor="#F7F7F7"><?php echo form_input($idproveedor) ?></td>
            <td></td>
            <td bgcolor="#F7F7F7"><?php echo form_input($periodoV) ?></td>
            <td></td>
        </tr>  <tr>
            <td class="active" align="center" bgcolor="#EBECEC"><font color=white> _______________</font></td>
            <td class="active" align="center" bgcolor="#EBECEC"> <font color=white>_______________</font></td>
            <td class="active" align="center" bgcolor="#EBECEC"><font color=white>_________</font></td>
            <td class="active" align="center" bgcolor="#EBECEC"><font color=white>____________</font></td>
            <td class="active" align="center" bgcolor="#EBECEC"><font color=white>________________</font></td>
            <td class="active" align="center" bgcolor="#EBECEC"><font color=white>_______________</font></td>
        </tr>

        <tr>
            <td colspan="7" bgcolor="#EBECEC"><strong>MOVIMIENTOS</strong></td>
        </tr>
    </table>
        <br/>
        <table class="table table-hover">
            
           <tr>
                <td class="active" align="center"><strong>Nro de Factura</strong></td>
                <td class="active" align="center"><strong>Cta Contrato</strong></td>
               
                <td class="active" align="center"><strong>Fecha Factura</strong></td>
                <td class="active" align="center"><strong>Fecha Carga</strong></td>
                
                <td class="active" align="center"><strong>Mes</strong></td>
                <td class="active" align="center"><strong>Facturaci&oacute;n</strong></td>
            </tr>
       <tr>
          <td class="active" align="center" bgcolor="#EBECEC"><font color=white> _______________</font></td>
          
          <td class="active" align="center" bgcolor="#EBECEC"><font color=white>___________</font></td>
          <td class="active" align="center" bgcolor="#EBECEC"><font color=white>_________</font></td>
          
          <td class="active" align="center" bgcolor="#EBECEC"><font color=white>____________</font></td>
          <td class="active" align="center" bgcolor="#EBECEC"><font color=white>_______________</font></td>
      </tr>
     
      
      
      
<?php
$nombre_format_francais = number_format($facturado, 2, ',', '. ');
echo $contenido;
if ($saldo = -$saldo) {
    $saldo = 'A favor MIJP = '.$saldo;
} elseif ($saldo = $saldo) {
    $saldo =  'Acreencia ='. $saldo;
}
echo $resultados='



</table>
        
<table width="921" border="0">
  <tr>
    <td width="152">&nbsp;</td>
    <td width="60">&nbsp;</td>
    <td width="311">&nbsp;</td>
    <td width="189"><div align="right">
      <h4><strong>TOTAL FACTURADO: </strong></h4>
    </div></td>
    <td width="175"><div align="center">
      <h4><font color=white> _____</font>'. $nombre_format_francais . '</h4>
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
          <td width="150" class="active" align="center" >________________________</td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center">________________________</td>
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
          <td width="150" class="active" align="center"> <font color=white>Analista</font></td>
          <td class="active" align="center"> <font color=white>_______________</font></td>
          <td width="150" class="active" align="center" > <font color=white>Nombre y Apellido</font></td>
          <td class="active" align="center" ><font color=white>____________</font></td>
          <td class="active" align="center"><font color=white>Nombre y Apellido</font></td>
          <td class="active" align="center" ><font color=white>_______________</font></td>
      </tr></br>
      <tr>
        <td class="active" align="center" ><font color=white>_______</font></td>
          <td width="150" class="active" align="center"><h2> Analista</h2></td>
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
  <!--   <table class="table table-hover">

        <tr>
            <td colspan="5" bgcolor="#EBECEC"><strong><h3>ACTA DE CONCILIACI&Oacute;N DE SERVICIOS B&Aacute;SICOS</h3> </strong></td>
             
        </tr>
        <tr>
            <td colspan="6" bgcolor="#EBECEC"><strong><h4>DIRECCI&Oacute;N DE CONTABILIDAD FISCAL</h5> </strong></td>
             
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
            <td align="left"> <font color=white>_______</font>   Los representantes debidamente autorizados por la empresa <?php  echo  $v2_nom_empresa ?> y del MINISTERIO DEL PODER POPULAR PARA RELACIONES INTERIORES JUSTICIA Y PAZ,
            declaran que, analizados los antecedentes presentados por las partes en relaci&oacute;n con los derechos y obligaciones el per&iacute;odo <?php  echo  $v2_nom_empresa ?>, por el servicio de <?php echo $v2_descripcion ?>
            en los diversos entes adscritos y las oficinas pertenecientes a este ente Ministerial, resueltas las diferencias que se encontaron, asi como realizada la compensac&oacute;n
            de derecchos y obligaciones entre las partes on el fin de obtener el saldo deudor y acreedor respectivo se llego al acuerdo que el MINISTERIO DEL PODER POPULAR PARA RELACIONES INTERIORES JUSTICIA Y PAZ
            , deber&aacute; cancelar la deuda por Acreencia No preescrita a la ______empresa----   , ya que es un compromiso v&aacute;lidamente contra&iacute;do en ejercicios fiscales anteriores. Por la cantidad de
            <?php  echo  $saldo  ?></td>
          
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
            <td align="left"> <font color=white>_______</font>   Se elaboran tres (3) ejemplares en la Ciudad de Caracas, en fecha  <?php echo mdate($datestring) ?></td>
          
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

      
    </table> -->
        
    </body>        
</html>





