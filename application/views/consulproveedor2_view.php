
<?php
//print_r($nombre_estado);
//print_r($lista_proveedores);
//print_r($data);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('consulproveedorcontroler/actualizar_proveedor', $attributes)
?>
<?php

$rif = array(
    'name' => 'rif',
    'id' => 'rif',
    'maxlength' => '14',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'J-G 000000000',
    'required' => 'required',
    'autocomplete' => 'off',
    'required pattern'=>'[-J,-G]{1}[0-9]{9}',
    'title'=>'J-G 000000000 (Sin Guiones)',
    'class' => 'form-control',
   // 'value' => $v_rif,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$direccion = array(
    'name' => 'direccion',
    'id' => 'direccion',
    'maxlength' => '100',
    'size' => '128',
    'type' => 'text',
    'placeholder' => 'Direcci&oacute;n',
    'required' => 'required',
    //'readonly'=>'readonly',
    //'value' => $v_direccion,
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$persona_contacto = array(
    'name' => 'persona_contacto',
    'id' => 'persona_contacto',
    'maxlength' => '50',
    'size' => '23',
    'type' => 'text',
    'required' => 'required',
    'placeholder' => 'Persona Contacto',
    //'readonly'=>'readonly',
    'class' => 'form-control',
    //'value' => $v_persona_contacto,
    'required pattern'=>'[A-Z\s]{3,25}',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$telefono = array(
    'name' => 'telefono',
    'id' => 'telefono',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'integer',
    'required' => 'required',
    'placeholder' => 'Tel&eacute;fono',
    //'readonly'=>'readonly',
    'class' => 'form-control',
    'required pattern'=>'[0-9]{10,12}',
    'title'=>'Numero Telef&oacute;nico sin caracteres especiales',
    //'value' => $v_telefono,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$telefono2 = array(
    'name' => 'telefono2',
    'id' => 'telefono2',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'integer',
    'required' => 'required',
    'placeholder' => 'Tel&eacute;fono',
    //'readonly'=>'readonly',
    'class' => 'form-control',
    'required pattern'=>'[0-9]{10,12}',
    'title'=>'Numero Telef&oacute;nico sin caracteres especiales',
    //'value' => $v_telefono,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$correo = array(
    'name' => 'correo',
    'id' => 'correo',
    'maxlength' => '50',
    'size' => '35',
    'type' => 'text',
    'required' => 'required',
    'placeholder' => 'Correo',
    //'readonly'=>'readonly',
    'class' => 'form-control',
    //'value' => $v_correo,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$cod_proveedor = array(
    'name' => 'cod_proveedor',
    'id' => 'cod_proveedor',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'int',
    'placeholder' => 'Cod. Proveedor',
    'required' => 'required',
    'readonly'=>'readonly',
    'class' => 'form-control',
    //'value' => $v_cod_proveedor,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$descripcion = array(/* servicio */
    'name' => 'descripcion',
    'id' => 'descripcion',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'int',
    'placeholder' => 'Servicio',
    'required' => 'required',
    'readonly'=>'readonly',
    'class' => 'form-control',
    //'value' => $v_descripcion,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$estado = array(
    'name' => 'estado',
    'id' => 'estado',
    'maxlength' => '50',
    'size' => '23',
    'type' => 'hiden',
    'required' => 'required',
    'placeholder' => 'Estado',
    'readonly'=>'readonly',
    //'value' => $v_estado,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$ciudad= array(
    'name' => 'ciudad',
    'id' => 'ciudad',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'int',
    'required' => 'required',
    'placeholder' => 'Ciudad',
    'class' => 'form-control',
    'readonly'=>'readonly',
    //'value' => $v_ciudad,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$proveedores= array(
    'name' => 'proveedores',
    'id' => 'proveedores',
    'required' => 'required',
     'type' => 'hidden',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
 
);
?>


<div id="body">
	
	<div class="table-responsive">
  <table class="table">
  <tr>
    <td height="54" colspan="6" bgcolor="#EBECEC"><h2 align="center">Acualizaci&oacute;n de Datos de Proveedores</h2></td>
  </tr>
  <tr>
    <td height="27" colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td width="17%" height="41" bordercolor="#EBECEC" ><div align="right">Proveedor: </div></td>
    <td width="18%" bordercolor="#EBECEC"  ><select name="proveedores" id="proveedores" class="form-control">
            <option value="">...SELECCIONE ...</option>';
      <?php
      
            foreach ($lista_proveedores as $i => $proveedores) {
             
                echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
            }
            ?>
    </select></td>
    <td width="14%" bordercolor="#EBECEC" ><div align="right">Cod. Proveedor: </div></td>
    <td width="20%" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($cod_proveedor)?></div></td>
    <td width="11%" bordercolor="#EBECEC" ><div align="right">Cuenta Contrato:</div></td>
    <td width="26%" bordercolor="#EBECEC" ><div id="cuenta_contrato" name="cuenta_contrato[]"></div></td>
  </tr>
  <tr>
    <td height="39" bordercolor="#EBECEC"><div align="right">Rif:</div></td>
    <td bordercolor="#EBECEC"><div align="left"><?php echo form_input($rif) ?></div></td>
    <td bordercolor="#EBECEC"><div align="right">Servicio:</div></td>
    <td bordercolor="#EBECEC"><div align="left"><?php echo form_input($descripcion) ?></div></td>
    <td bordercolor="#EBECEC"><div align="right">Correo:</div></td>
    <td bordercolor="#EBECEC"><div align="left"><?php echo form_input($correo) ?></div></td>
  </tr>
  <tr>
    <td height="32" bordercolor="#EBECEC" ><div align="right">Persona Contacto:</div></td>
    <td bordercolor="#EBECEC"  ><div align="left" ><?php echo form_input($persona_contacto) ?></div></td>
    <td bordercolor="#EBECEC" ><div align="right">Tel&eacute;fono:</div></td>
    <td bordercolor="#EBECEC" ><div align="left"><?php echo form_input($telefono) ?></div></td>
    <td bordercolor="#EBECEC" ><div align="right">Tel&eacute;fono:</div></td>
    <td bordercolor="#EBECEC" ><div align="left"><?php echo form_input($telefono2) ?></div></td>
    <td bordercolor="#EBECEC" >&nbsp;</td>
    <td bordercolor="#EBECEC" >&nbsp;</td>
  </tr>
  <tr>
    <td width="17%" height="32" bordercolor="#EBECEC" ><div align="right">Direcci&oacute;n:</div></td>
    <td colspan="5" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($direccion) ?></div></td>
  </tr>
 <!-- <tr>
    <td height="32" bordercolor="#EBECEC" ><div align="right">Estado:</div></td>
    <td height="32" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($estado) ?></div></td>
    <td height="32" bordercolor="#EBECEC" ><div align="right">Ciudad:</div></td>
    <td height="32" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($ciudad) ?></div></td>
    <td bordercolor="#EBECEC" >&nbsp;</td>
    <td bordercolor="#EBECEC" ></td>
  </tr>-->
  <tr>
    <td height="59" colspan="6" bordercolor="#EBECEC" ><div align="center">
           
        </div>
        </br>
        <button type="submit" class="btn btn-primary" align="center">Actualizar</button>
        <a href="<?php echo base_url() ?>index.php/consulproveedorcontroler/consulta"><button type="button" class="btn btn-primary" align="center">Regresar</button></a></td> 
        
  </tr>
  
</table>
    
  
</div>    
    
</div>

<script>
    $(document).on("change", '#proveedores', function ()
    {
        //alert("<?php echo base_url() . 'index.php/consulproveedorcontroler/consultar_cuenta_contrato?id_proveedor='; ?>"+$(this).val());

        $("#cuenta_contrato").load("<?php echo base_url() . 'index.php/consulproveedorcontroler/consultar_cuenta_contrato?id_proveedor='; ?>" + $(this).val());
        
        $.ajax({
        url:"<?php echo base_url() . 'index.php/consulproveedorcontroler/consultar_datosproveedor'; ?>", 
        data: {id_proveedor: $(this).val()},
        dataType: 'html',
        type: 'post',
        success: function(salida) {
                   // alert(salida); 
                    var datos=salida.split("~");
                    //alert(datos[0]);

                     $("#cod_proveedor").val(datos[0]);
                     $("#descripcion").val(datos[1]);
                     $("#rif").val(datos[2]);
                     $("#direccion").val(datos[3]);
                     $("#persona_contacto").val(datos[4]);
                     $("#telefono").val(datos[5]);
                     $("#correo").val(datos[6]);
                     $("#estado").val(datos[7]);
                     $("#ciudad").val(datos[8]);
                     $("#telefono2").val(datos[9]);
                 }
        });
        
        $.ajax({
        url:"<?php echo base_url() . 'index.php/consulproveedorcontroler/consultar_nomnbre_estado'; ?>", 
        data: {id_estado: $(this).val()},
        dataType: 'html',
        type: 'post',
        success: function(salida2) {
                    //alert(salida2); 
                    //var datos=salida.split("~");
                    //alert(datos[0]);

                   $("#estado").val(datos[0]);
                     
                 }
        });
        
    });
     
    
    
</script>

     
<?php echo form_close() ?>
