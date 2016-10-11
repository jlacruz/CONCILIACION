<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');


?>
<?php
$nom_empresa = array(
    'name' => 'nom_empresa',
    'id' => 'nombre',
    'maxlength' => '50',
    'size' => '10',
    'type' => 'text',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()',
    'value' => $v2_nom_empresa
);

$descripcion = array(/* servicio */
    'name' => 'descripcion',
    'id' => 'descripcion',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'text',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v2_descripcion,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$idproveedor= array(/* servicio */
    'name' => 'id_proveedor',
    'id' => '$id_proveedor',
    'type' => 'hidden',
    'value' => $idProveedor
);

$periodoV= array(/* servicio */
    'name' => 'periodo',
    'id' => 'periodo',
    'type' => 'hidden',
    'value' => $periodo
);

$mes1= array(
    'name' => 'mes1',
    'id' => 'mes1',
    'type' => 'hidden',
    'value' => $mes1
);
$mes2= array(
    'name' => 'mes2',
    'id' => 'mes2',
    'type' => 'hidden',
    'value' => $mes2
);

$facturado = 0;

$pagado = 0;

$saldo = 0;

$diferencia=0;

$nombre_format_francais = number_format($facturado, 2, ',', ' ');
?>


<?php


if ($data[0][0] != "") {
    //print_r($data);

    $contenido = "";
    $facturado = 0;
    $diferencia = 0;
    $pagado = 0;
      
    //$resultado=$resultado[5];
   
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
          
          <td>" . $nombre_format_francais . "</td></tr>";
    }
} else {
    $contenido = '
                <div class="alert alert-danger">
                <strong>No se Encontraron datos para esta busquedad!</strong>
                <a class="alert-link" href="#">Volver a consultar.</a>
	         </div>';
}
?>
</form>
<div id="body">
    <?php echo form_open('reporteMensual/reporteConciliacionMensual', $attributes)?>
    <div id='table-responsive' class="table-responsive">
        <table class="table table-hover">
            <tr>
                <td height="40" colspan="6" bgcolor="#EBECEC"><div align="center"><strong>CONCILIACI&Oacute;N DE SERVICIOS </strong></div></td>
            </tr>
            <tr>
                <td height="28" colspan="6"><div align="center">Estado de Cuenta Mensual</div></td>
            </tr>
            <tr>
                <td width="137" height="46" bgcolor="#F7F7F7"><div align="center">Organismo: </div></td>
                <td width="151"><div align="left">MPPRIJP</div></td>
                <td width="116" bgcolor="#F7F7F7"><div align="center">Proveedor:</div></td> 
                <td width="249"><div align="left"><?php echo $v2_nom_empresa ?></div></td>
                <td width="75" bgcolor="#F7F7F7"><div align="center">Servicio:</div></td>
                <td width="306"><div align="left"><?php echo $v2_descripcion ?></div></td>
            </tr>
            <tr>
                <td height="39" bgcolor="#F7F7F7"><div align="center">Fecha del Reporte: </div></td>
                <td align="left"><div align="left"> <?php echo mdate($datestring) ?><td bgcolor="#F7F7F7"><?php echo form_input($idproveedor) ?></td> </div></td>
                
                
                
                <td>&nbsp;</td>
                <td bgcolor="#F7F7F7"><?php echo form_input($periodoV) ?><?php echo form_input($mes1) ?><?php echo form_input($mes2) ?></td>
                <td>&nbsp;</td>
            </tr>
            
        </table>
        <table class="table table-hover">
            <tr>
                <td colspan="7" bgcolor="#EBECEC"><strong>MOVIMIENTOS</strong></td>
            </tr>

        </table>
        <table class="table table-hover">
            <tr>
                <td class="active" align="center"><strong>Nro de Factura</strong></td>
                <td class="active" align="center"><strong>Cuenta Contrato</strong></td>
               <td class="active" align="center"><strong>Fecha Carga</strong></td>
                <td class="active" align="center"><strong>Fecha Factura</strong></td>
                
                
                <td class="active" align="center"><strong>Mes</strong></td>
                <td class="active" align="center"><strong>Facturaci&oacute;n</strong></td>
            </tr>

<?php
$nombre_format_francais = number_format($facturado, 2, ',', '. ');
echo $contenido;
if($saldo= -$saldo){
    $saldo='A favor MIJP= '.$saldo;

}
elseif ($saldo= $saldo){
    $saldo=-$saldo.'Acreecia';

}
echo $resultados = '
   <table class="table table-hover">
     
     <tr>
        <td></td>
        <td></td>
            <td><strong><FONT COLOR="#fff">____________________________________________________________________</FONT>TOTAL FACTURADO</strong></td>	
            <td><FONT COLOR="#fff"></FONT></td>

            <td><strong><FONT COLOR="#fff">------------------------------------------------------------------</FONT>' . $nombre_format_francais . '</strong></td>
            <td></td>
     </tr>
    <table width="1108">
    <tr>
        <td width="91"></td>
        <td width="644"><FONT COLOR="#fff"></FONT></td>
         
      <td width="96">  <input value="Imprimir" class="btn btn-primary" type="submit" name="imprimir" id="imprimir" > </td>	
                <td width="65"></td>
                <td width="91"></td>
                <td width="93"></td>
    </tr></table>';
    
  

   
?>
            
        </table>
         
       
    </div>
</div>

<?php echo form_close() ?>
