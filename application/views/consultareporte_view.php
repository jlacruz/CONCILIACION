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


$facturado = 0;

$pagado = 0;

$saldo = 0;

$diferencia=0;
?>


<?php

$nombre_format_francais = number_format($saldo, 0, ',', '');
$nombre_format_francais1 = number_format($pagado, 0, ',', '');
$nombre_format_francais2 = number_format($facturado, 0, ',', '');


if ($data[0][0] != "") {
    //print_r($data);

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
</form>
<div id="body">
    <?php echo form_open('consultareporte/reporteConciliacion', $attributes)?>
    <div id='table-responsive' class="table-responsive">
        <table class="table table-hover">
            <tr>
                <td height="40" colspan="6" bgcolor="#EBECEC"><div align="center"><strong>CONCILIACI&Oacute;N DE SERVICIOS </strong></div></td>
            </tr>
            <tr>
                <td height="28" colspan="6"><div align="center">Estado de Cuenta Anual</div></td>
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
                <td bgcolor="#F7F7F7"><?php echo form_input($periodoV) ?></td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table class="table table-hover">
            <tr>
                <td colspan="6" bgcolor="#EBECEC"><strong>MOVIMIENTOS</strong></td>
            </tr>

        </table>
        <table class="table table-hover">
            <tr>
                <td class="active" align="center"><strong>Nro de Factura</strong></td>
                <td class="active" align="center"><strong>Cuenta Contrato</strong></td>
                <td class="active" align="center"><strong>Nro de &Oacute;rden</strong></td>
                <td class="active" align="center"><strong>Fecha</strong></td>
                <td class="active" align="center"><strong>Mes</strong></td>
                <td class="active" align="center"><strong>Pago</strong></td>
                <td class="active" align="center"><strong>Facturaci&oacute;n</strong></td>
                <td class="active" align="center"><strong>Diferencias</strong></td>
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


echo $resultados = '
   <table class="table table-hover">
      <tr>
          <td class="active" align="center" bgcolor="#EBECEC"><FONT COLOR="#EBECEC"> ========================================== </FONT></td>
          <td class="active" align="center" bgcolor="#EBECEC"><FONT COLOR="#EBECEC">===============</FONT></td>
          <td class="active" align="center" bgcolor="#EBECEC"><STRONG>TOTALES</STRONG></td>
          <td class="active" align="center" bgcolor="#EBECEC"><FONT COLOR="#EBECEC">===========</FONT></td>
          <td class="active" align="center" bgcolor="#EBECEC"><FONT COLOR="#EBECEC">===============</FONT></td>
          <td class="active" align="center" bgcolor="#EBECEC"><FONT COLOR="#EBECEC">===============</FONT></td>
      </tr>
     <tr>
        <td></td>
        <td></td>
            <td><strong>TOTAL FACTURADO</strong></td>	
            <td><FONT COLOR="#fff">_____________________</FONT></td>

            <td><strong><FONT COLOR="#fff">_____</FONT>' . $nombre_format_francais1 . '</strong></td>
            <td></td>
     </tr>

     <tr>
        <td></td>
        <td></td>
            <td><strong>TOTAL PAGADO</strong></td>	
            <td><strong><FONT COLOR="#fff">___________________</FONT>' . $nombre_format_francais3 . '</strong></td>
            <td></td>
            <td></td>
    </tr>

    <tr>
        <td></td>
        <td></td>
                <td><strong>RESULTADO</strong></td>	
                <td></td>
                <td></td>
                <td><strong>' . $nombre_format_francais2 . '</strong></td>
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
