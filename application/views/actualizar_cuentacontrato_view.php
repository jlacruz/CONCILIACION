<?php
//print_r($lista_estados);
//print_r($lista_servicio);
//print_r($variablesSesion);
$datestring = " %Y-%m-%d";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('cuentacontratocontroler/buscar_cuentacontrato2', $attributes)
?>
<?php
$nom_empresa = array(
    'name' => 'nom_empresa',
    'id' => 'nom_empresa',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Nombre de la Empresa',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$cuenta_contrato = array(
    'name' => 'cuenta_contrato ',
    'id' => 'cuenta_contrato ',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'text',
    'placeholder' => 'Cuenta Contrato',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$fecha = array(
    'name' => 'fecha ',
    'id' => 'fecha ',
    'maxlength' => '50',
    'size' => '12',
    'type' => 'int',
    'placeholder' => '...select....',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
?>
<div id="body">

    <div class="table-responsive">
        <table class="table">
            <tr>
                <td colspan="6" bgcolor="#EBECEC"><h2 align="center">Actualizar Cuenta Contrato </h2></td>
            </tr>
            <tr>
                <td width="171">&nbsp;</td>
                <td width="251">&nbsp;</td>
            </tr>
            <tr>
                <td height="30" ><div align="right" bgcolor="#EBECEC">Nombre de la Empresa: </div></td>
                <td width="28%" bordercolor="#EBECEC"  ><select name="proveedores" id="proveedores" class="form-control" required="required">
                    <option value="">...Seleccione ...</option>';
                    <?php
                    foreach ($lista_proveedores as $i => $proveedores) {
                        echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
                    }
                    ?>
                </select></div></td>
                
                <td width="251" bgcolor="#FFFFFF"><div id="cuenta_contrato"  > </div>  
                    <div id="div_1" align="left">
                        <input  type="text"  name="cuenta_contrato" class="form-control"id="cuenta_contrato" style="width:170px;" placeholder="Cuenta Contrato" required="required"  /> 
                       
                    </div></td>
            </tr>
            <tr>
                
            </tr>


            <tr>
               <tr>
                            <td colspan="3" align="center"> 
                            <?php $atributosSubmit = array('class' => 'btn btn-primary');
                            echo form_submit($atributosSubmit,'Consultar')?>	    
                            </td>
            </tr>
        </table>

    </div>
</div>




<?php echo form_close() ?>
