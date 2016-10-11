<?php
$datestring = " %Y-%m-%d";
$attributes = array('class' => '', 'id' => '', 'method' => 'GET');

echo form_open('consulta_factura_controler2/buscarDatos', $attributes)
?>
<?php
$id_proveedor = array(
    'name' => 'id_proveedor',
    'id' => 'id_proveedor',
    'maxlength' => '4',
    'size' => '5',
    'type' => 'integer',
    'placeholder' => 'Periodo',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$periodo = array(
    'name' => 'periodo',
    'id' => 'periodo',
    'maxlength' => '4',
    'size' => '5',
    'type' => 'integer',
    'placeholder' => 'Periodo',
    'required' => 'required',
    'class' => 'form-control',
    'required pattern' => '[0-9]{4}',   
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$f_numero = array(
    'name' => 'f_numero',
    'id' => 'f_numero',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'Nro Factura.',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

?>
<div id="body">
    <div class="table-responsive">



        <table width="387" class="table">
            <tr>
                <td height="54" colspan="7" bgcolor="#EBECEC"><h2 align="center">Consultar Factura</h2></td>
            </tr>
            <tr>
                <td height="27" colspan="7">&nbsp;</td>
            </tr>
            <tr>
                <td width="71" height="63" bordercolor="#EBECEC" > <div align="right">Proveedor: </div></td>
                <td width="80" bordercolor="#EBECEC" ><select name="proveedores" id="proveedores" class="form-control" required="required">
                        <option value="0">...SELECCIONE ...</option>';
                        <?php
                        foreach ($lista_proveedores as $i => $proveedores) {
                            echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
                        }
                        ?>
                    </select></td>
                <td width="55" bordercolor="#EBECEC" ><div align="right">Periodo: </div></td>
                <td width="5" bordercolor="#EBECEC" ><div align="left" ><?php echo form_input($periodo) ?></div></td>

                <td width="53" bordercolor="#EBECEC" ><div align="right">Nro. Factura: </div></td>
                <td width="60" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($f_numero) ?></div></td>
            </tr>


            <td height="87" colspan="7" bordercolor="#EBECEC"  ><div align="center">

                    <table>
                        <tr>
                            <td colspan="2" align="center"> 
                            <?php $atributosSubmit = array('class' => 'btn btn-primary');
                            echo form_submit($atributosSubmit,'Consultar')?>	    
                            </td>
                        </tr>
                    </table>
              </table>




    </div>
</div>
<?php echo form_close() ?>



