<?php
//echo "-->".$v_cod_proveedor;

$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('consulordencontroler/actualizar_orden', $attributes)
?>
<?php
$nom_empresa = array(
    'name' => 'nom_empresa',
    'id' => 'nombre',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'text',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()',
    'value' => $v_nom_empresa
);
$periodo = array(
    'name' =>'periodo',
    'id' =>'periodo',
    'maxlength' => '4',
    'size' => '18',
    'type' => 'int',
    'placeholder' => 'periodo',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
   'required pattern'=>'[0-9]{4}',
    'value' => $v_periodo,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
    );

$fecha_carga = array(
    'name' => 'fecha_carga',
    'id' => 'fecha_carga',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'date',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'placeholder' => 'fecha_carga',
    'required' => 'required',
    'value' => $v_fecha_carga,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);


$fecha_orden = array(
    'name' => 'fecha_orden',
    'id' => 'fecha_orden',
    'maxlength' => '50',
    'class' => 'form-control',
    'size' => '14',
    'type' => 'text',
    'value' => $v_fecha_orden,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$fecha_carga = array(
    'name' => 'fecha_carga',
    'id' => 'fecha_carga',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_fecha_carga,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$o_monto = array(
    'name' => 'o_monto',
    'id' => 'o_monto',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'int',
    'required' => 'required',
    'class' => 'form-control',
    'required pattern'=>'[-\w.]+[0-9]{2}',
    'value' => $v_o_monto,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$cod_proveedor = array(
    'name' => 'cod_proveedor',
    'id' => 'cod_proveedor',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'int',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()',
    'value' => $v_cod_proveedor
);
$descripcion = array(/* servicio */
    'name' => 'descripcion',
    'id' => 'descripcion',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'text',
    'readonly' => 'readonly',
    'class' => 'form-control',
    'value' => $v_descripcion,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);


$observacion = array(
    'name' => 'observacion',
    'id' => 'observacion',
    'maxlength' => '300',
    'size' => '98',
    'type' => 'text',
    'value' => $v_observacion,
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$id_orden = array(
    'name' => 'id_orden',
    'id' => 'id_orden',
    'maxlength' => '300',
    'size' => '98',
    'type' => 'hidden',
    'value' => $v_id_orden,
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$o_numero = array(
    'name' => 'o_numero',
    'id' => 'o_numero',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'hidden',
    'value' => $v_o_numero,
    'placeholder' => 'Nro Orden.',
    'required' => 'required',
    'class' => 'form-control',
    'required' => 'required',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
// para deshabilitar botones
?>

<div id="body">
	
	<div class="table-responsive">
  <table class="table">

        <tr>
            <td height="45" colspan="6" bgcolor="#EBECEC"><div align="center">
                    <h2>Orden de Pago</h2>
                </div></td>
        </tr>
        <tr>
            <td height="21" colspan="6" >&nbsp;</td>
        </tr>
        <tr>
            <td width="128" height="43" ><div align="right">Proveedor: </div></td>
            <td width="263" ><div align="left" ><?php echo $v_nom_empresa?><?php echo form_input($id_orden) ?><?php echo form_input($o_numero) ?></div></td>
            <td width="136" ><div align="right">Cod. Proveedor: </div></td>
            <td width="145" ><div align="left"><?php echo $v_cod_proveedor ?></div></td>
            <td width="146" ><div align="right">Per&iacute;odo:</div></td>
            <td width="184"><div align="left"><?php echo form_input($periodo) ?></div></td>
        </tr>
        <tr>
            <td height="48"><div align="right">Sevicio:</div></td>
            <td><div align="left"><?php echo $v_descripcion ?></div></td>
            <td><div align="right">Fecha de carga:</div></td>
            <td><div align="left"><?php echo $v_fecha_carga?></div></td>
            <td><div align="right">Fecha Orden: </div></td>
            <td><div align="left"><?php echo form_input($fecha_orden) ?></div></td>
        </tr>
        <tr>
            <td height="46" ><div align="right">Monto(Bs): </div></td>
            <td ><div align="left"><?php echo form_input($o_monto) ?></div></td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
        
        <tr>
            <td height="52"><div align="right">Observaci&oacute;n: </div></td>
            <td colspan="5"><div align="left"><?php echo form_input($observacion) ?></div></td>
        </tr>
        <tr><td >&nbsp;</td>
            <td ><div class="radio" align="right">
            <label>
                <input class='estatus' type="radio" name="estatus" id="estatus_1" value="1" checked>
                Habilitar Orden
            </label>
            
        </div></td>
            <td ><div class="radio" align="center">
            <label>
                <input class='estatus' type="radio" name="estatus" id="estatus_2" value="0"  >
                <FONT COLOR="red">Deshabilitar Orden</FONT>
            </label>
                        
        </div></td>
            
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          
        <tr>
       <td height="50" colspan="6" align="center" ><div align="right">
        <p>&nbsp;</p>
        <p align="center">
   
            <input value='Actualizar' class='btn btn-primary' type='submit' name='actualizar' id='actualizar' />
            
        </td>
                
        </tr>
    </table>
    <table width="947"  border="0" align="center">
  <tr>
    <td><FONT COLOR="white">------esacio en blanco------ </FONT>* Si selecciona DESHABILITAR no podra acceder a la informacion referente a esta Orden</td>
  </tr>
</table>

</div>

</div>


<?php echo form_close() ?>



