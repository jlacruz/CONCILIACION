<?php
//print_r($lista_estados);
//print_r($lista_servicio);
//print_r($lista_ciudad);
$datestring = " %Y-%m-%d";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('consulusercontroler/actualizar_usuario', $attributes)
?>
<?php
$cedula = array(
    'name' => 'cedula',
    'id' => 'cedula',
    'maxlength' => '50',
    'size' => '22',
    'type' => 'number',
    'placeholder' => 'Cedula',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_cedula,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$p_nombre = array(
    'name' => 'p_nombre',
    'id' => 'p_nombre',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Primer Nombre',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_p_nombre,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$s_nombre = array(
    'name' => 's_nombre',
    'id' => 's_nombre',
    'maxlength' => '12',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Segundo Nombre',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_s_nombre,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$p_apellido = array(
    'name' => 'p_apellido',
    'id' => 'p_apellido',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Primer Apellido',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_p_apellido,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$s_apellido = array(
    'name' => 's_apellido',
    'id' => 's_apellido',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Segundo Apellido',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_s_apellido,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$telefono_local = array(
    'name' => 'telefono_local',
    'id' => 'telefono_local',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'number',
    'placeholder' => 'Telefono Local',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_telefono_local,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$telefono_celular = array(
    'name' => 'telefono_celular',
    'id' => 'telefono_celular',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'number',
    'placeholder' => 'Telefono Celular',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_telefono_celular,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$correo = array(
    'name' => 'correo',
    'id' => 'correo',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'email',
    'placeholder' => 'Correo@mijp.gob.ve',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_correo,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$correo2 = array(
    'name' => 'correo2',
    'id' => 'correo2',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'email',
    'placeholder' => 'Correo@gmail.com',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'readonly' => 'readonly',
    'value' => $v_correo2,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$fecha_registro = array(
    'name' => 'fecha_registro',
    'id' => 'fecha_registro',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'date',
    'placeholder' => 'fecha_registro',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'value' => $v_fecha_registro,
    'readonly' => 'readonly',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$usuario = array(
    'name' => 'usuario',
    'id' => 'usuario',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Usuario',
    'required' => 'required',
    'class' => 'form-control',
    'value' => $v_usuario,
    'autocomplete' => 'off'
);

$rol = array(
    'name' => 'rol',
    'id' => 'rol',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'int',
    'placeholder' => 'Rol',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off',
    'value' => $v_rol,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$id_usuario = array(
    'name' => 'id_usuario',
    'id' => 'id_usuario',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'hidden',
    'required' => 'required',
    'class' => 'form-control',
    'value' => $v_id_usuario,
    'autocomplete' => 'off',
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

$clave = array(
    'name' => 'clave',
    'id' => 'clave',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'password',
    'placeholder' => 'Registre Nueva Clave',
    //'value' => $v_clave,
    //'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off'
);
?>

<div id="body">
    <div class="table-responsive">
        <table class="table">
            <tr>
               <td height="45" colspan="6" bgcolor="#EBECEC"><div align="center"><h2>Actualizar Usuario</h2></div></td>
            </tr>
            <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td width="16%" height="39" ><div align="right">Cedula: </div></td>
                <td width="19%" ><div align="left" ><?php echo $v_cedula ?></div></td>
                <td width="15%" ><div align="right">Primer Nombre :</div></td>
                <td width="17%" ><div align="left"><?php echo $v_p_nombre ?></div></td>
                <td width="14%" ><div align="right">Segundo Nombre : </div></td>
                <td width="19%"><div align="left"><?php echo $v_s_nombre ?></div></td>
            </tr>
            <tr>
                <td height="39"><div align="right">Primer Apellido :</div></td>
                <td><div align="left"><?php echo $v_p_apellido ?></div></td>
                <td><div align="right">Segundo Apellido : </div></td>
                <td><div align="left"><?php echo $v_s_apellido ?></div></td>

                <td><div align="right">Telf. Local :</div></td>
                <td><div align="left"><?php echo $v_telefono_local ?></div></td>
            </tr>
            <tr>
                <td height="39"><div align="right">Telf. Celular:</div></td>
                <td><div align="left"><?php echo $v_telefono_celular ?></div></td>
                <td><div align="right">Correo: </div></td>
                <td><div align="left"><?php echo $v_correo ?></div></td>

                <td><div align="right">Correo (opcional) :</div></td>
                <td><div align="left"><?php echo $v_correo2 ?></div></td>
            </tr>
            <tr>
                <td height="39"><div align="right">Usuario:</div></td>
                <td><div align="left"><?php echo form_input($usuario) ?><?php echo form_input($id_usuario) ?></div></td>
                <td height="39"><div align="right">Fecha del Registro:</div></td>
                <td><div align="left"><?php echo $v_fecha_registro ?></div></td>
                <td><div align="right">Seleccione Nuevo Rol :</div></td>
                <td><div align="left" >
                        <select name="rol" class="form-control" required="required"> 
                            <option value="">Seleccione el Rol</option>
                            <option value="1">Administrador general</option>
                            <option value="2">Analista </option>
                        </select></div></td>
            </tr>

            <tr>
                <td colspan="3" ><div class="radio" align="center">
                <label>
                    <input class='estatus' type="radio" name="estatus" id="estatus_1" value="TRUE" checked>
                    Habilitar Usuario
                </label>
                    </div></td>
                    
                <td colspan="3" ><div class="radio" align="center">
                        <label>
                            <input class='estatus' type="radio" name="estatus" id="estatus_2" value="FALSE" >
                            <FONT COLOR="red">Deshabilitar Usuario</FONT>
                        </label>
                    </div></td>
            </tr>  
            <tr>
                <td height="55" colspan="6" align="center" > 
                    <div align="center">
<?php
$atributosSubmit = array('class' => 'btn btn-primary');
echo form_submit($atributosSubmit, 'Actualizar')
?>	
                </td>
            </tr>
        </table>
</div>
<script>
    $(document).on("click", '#actualizar', function ()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/consulusercontroler/actualizar_usuarios'; ?>",
            data: {id_usuario: $('#id_usuario').val(), usuario: $('#usuario').val(), id_rol: $('#id_rol').val(), estatus: $('input[name=estatus]:checked').val(), clave: $('#clave').val()},
            dataType: 'html',
            type: 'post',
            success: function (salida) {
                alert(salida);
                var datos = salida.split("~");
                alert(datos[0]);

                $("#resultado").html(salida);


            }
        });



    });

</script>

<?php echo form_close() ?>




