
<?php
//echo "-->".$v_cod_proveedor;
//print_r($variablesSesion);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('cuentacontratocontroler/modificar_cuentacontrato', $attributes)
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

$cuenta_contrato = array(
    'name' => 'cuenta_contrato',
    'id' => 'cuenta_contrato',
    'maxlength' => '50',
    'size' => '14',
    'class' => 'form-control',
    'type' => 'text',
    'value' => $v_cuenta_contrato,
    'required pattern'=>'[0-9]{1,18}',
    'title'=>'Sin caracteres especiales',
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

?>

<div id="body">

    <div class="table-responsive">
    <table class="table">

    <tr>
        <td height="45" colspan="6" bgcolor="#EBECEC"><div align="center">
                <h2>Actualizar Cuenta Contrato</h2>
            </div></td>
    </tr>
    
    <tr>
        <td width="128" height="43" ><div align="right">Proveedor: </div></td>
        <td width="263" ><div align="left" ><?php echo form_input($nom_empresa) ?></div></td>
                <td width="136" ><div align="right">Cuenta Contrato: </div></td>
                <td width="145" ><div align="left"><?php echo form_input($cuenta_contrato) ?><?php echo form_input($id_contrato) ?>  </div></td>
    </tr>
    <td >&nbsp;</td>
    <td><div class="radio" align="right">
            <label>
                <div align="left">
                  <input class='estatus' type="radio" name="estatus" id="estatus_1" value="1" checked>
                Habilitar                </div>
            </label></div>    </td>
    <td><div class="radio" align="right">
            <label>
                <div align="left">
                  <input class='estatus' type="radio" name="estatus" id="estatus_2" value="0" >
                  <FONT COLOR="red">Deshabilitar </FONT>                    </div>
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
    <td><FONT COLOR="white">------esacio en blanco------ </FONT>* Si selecciona DESHABILITAR quedara inacticva esta Cuenta Contrato</td>
  </tr>
</table>
<div id='resultado'>

</div>

</div>



    <script>
$('#mes').typeahead([
{
name: 'mes',
local: [ "Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune" ]
}
]);

    </script>



<?php echo form_close() ?>



