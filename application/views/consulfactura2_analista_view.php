
<?php
//echo "-->".$v_cod_proveedor;
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('consulta_factura_controler/actualizar_factura', $attributes)
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
    'readonly' => 'readonly',
    'placeholder' => 'fecha_carga',
    'class' => 'form-control',
    'required' => 'required',
    'value' => $v_fecha_carga,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$cuenta_contrato = array(
    'name' => 'cuenta_contrato',
    'id' => 'cuenta_contrato',
    'maxlength' => '50',
    'size' => '14',
    'class' => 'form-control',
    'type' => 'text',
    'value' => $v_cuenta_contrato,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$fecha_factura = array(
    'name' => 'fecha_factura',
    'id' => 'fecha_factura',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'value' => $v_fecha_factura,
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$fecha_carga = array(
    'name' => 'fecha_carga',
    'id' => 'fecha_carga',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'readonly' => 'readonly',
    'class' => 'form-control',
    'value' => $v_fecha_carga,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$f_monto = array(
    'name' => 'f_monto',
    'id' => 'f_monto',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'int',
    'required' => 'required',
    'class' => 'form-control',
    'required pattern'=>'[-\w.]+[0-9]{2}',
    'value' => $v_f_monto,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$cod_proveedor = array(
    'name' => 'cod_proveedor',
    'id' => 'cod_proveedor',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'int',
    'readonly' => 'readonly',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()',
    'value' => $v_cod_proveedor
);
$descripcion = array(/* servicio */
    'name' => 'descripcion',
    'id' => 'descripcion',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'text',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_descripcion,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);


$observacion = array(
    'name' => 'observacion',
    'id' => 'observacion',
    'maxlength' => '300',
    'size' => '98',
    'type' => 'text',
    'class' => 'form-control',
    'value' => $v_observacion,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$id_factura = array(
    'name' => 'id_factura',
    'id' => 'id_factura',
    'maxlength' => '300',
    'size' => '98',
    'type' => 'hidden',
    'class' => 'form-control',
    'value' => $v_id_factura,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$id_contrato = array(
    'name' => 'id_contrato',
    'id' => 'id_contrato',
    'maxlength' => '300',
    'size' => '98',
    'class' => 'form-control',
    'type' => 'hidden',
    'value' => $v_id_contrato,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$estatus = array(
    'name' => 'estatus',
    'id' => 'estatus',
    'maxlength' => '300',
    'size' => '98',
    'class' => 'form-control',
    'type' => 'radio',
    'checked' => 'checked',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$id_usuario = array(
    'name' => 'id_usuario',
    'id' => 'id_usuario',
    'maxlength' => '300',
    'size' => '98',
    'type' => 'hidden',
    'class' => 'form-control',
    'value' => $v_id_usuario,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$mes = array(
    'name' => 'mes',
    'id' => 'mes',
    'maxlength' => '12',
    'size' => '98',
    'type' => 'text',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_mes,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$f_numero = array(
    'name' => 'f_numero',
    'id' => 'f_numero',
    'maxlength' => '12',
    'size' => '98',
    'type' => 'text',
    'class' => 'form-control',
    'value' => $v_f_numero,
    'type' => 'hidden',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
?>

<div id="body">

    <div class="table-responsive">
        <table class="table">

            <tr>
                <td height="45" colspan="6" bgcolor="#EBECEC"><div align="center">
                        <h2>Factura</h2>
                    </div></td>
            </tr>
            <tr>
                <td height="21" colspan="6" >&nbsp;</td>
            </tr>
            <tr>
                <td width="128" height="43" ><div align="right">Proveedor: </div></td>
                <td width="263" ><div align="left" ><?php echo form_input($nom_empresa) ?><?php echo form_input($id_factura) ?><?php echo form_input($f_numero) ?></div></td>
                <td width="136" ><div align="right">Cod. Proveedor: </div></td>
                <td width="145" ><div align="left"><?php echo form_input($cod_proveedor) ?><?php echo form_input($id_usuario) ?></div></td>
                <td width="146" ><div align="right">Per&iacute;odo:</div></td>
                <td width="184"><div align="left"><?php echo form_input($periodo) ?></div></td>
            </tr>
            <tr>
                <td height="48"><div align="right">Sevicio:</div></td>
                <td><div align="left"><?php echo form_input($descripcion) ?></div></td>
                <td><div align="right">Fecha de carga:</div></td>
                <td><div align="left"><?php echo form_input($fecha_carga) ?><?php echo form_input($id_contrato) ?></div></td>
                <td><div align="right">Cuenta Contrato: </div></td>
                <td align="left" ><div id="id_contrato"><?php echo $comboCuenta; ?></div></td>
            </tr>
            <tr>
                <td height="46" ><div align="right">Monto(Bs): </div></td>
                <td ><div align="left"><?php echo form_input($f_monto) ?></div></td>
                <td><div align="right">Fecha Orden: </div></td>
                <td><div align="left"><?php echo form_input($fecha_factura) ?></div></td>
                <td><div align="right">Mes: </div></td>
                <td><div align="left"><?php echo form_input($mes) ?></div></td>
            </tr>

            <tr>
                <td height="52"><div align="right">Observaci&oacute;n: </div></td>
                <td colspan="5"><div align="left"><?php echo form_input($observacion) ?></div></td>
            </tr>
            <td >&nbsp;</td>
            <td><div class="radio" align="right">
                    <label>
                        <input class='estatus' type="radio" name="estatus" id="estatus_1" value="1" checked>
                        Habilitar Factura
                    </label></div>
            </td>

            <td><div class="radio" align="right">
                    <label>
                        <input class='estatus' type="radio" name="estatus" id="estatus_2" value="0" >
                        <FONT COLOR="red">Deshabilitar Factura</FONT>
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
    <td><FONT COLOR="white">------esacio en blanco------ </FONT>* Si selecciona DESHABILITAR no podra acceder a la informacion referente a esta Factura</td>
  </tr>
</table>
<div id='resultado'>

</div>

</div>


<?php echo form_close() ?>



