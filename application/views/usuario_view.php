<?php
//print_r($lista_estados);
//print_r($lista_servicio);
//print_r($lista_rol);
$datestring = " %Y-%m-%d";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('usuariocontroler/registrar_usuario', $attributes)
?>
<?php
/*$cedula = array(
    'name' => 'cedula',
    'id' => 'cedula',
    'maxlength' => '12',
    'size' => '22',
    'type' => 'text',
    'placeholder' => 'Cedula',
    'required' => 'required',
    'autocomplete' => 'off',
    'required pattern'=>'[0-9]{7,10}',
    'title'=>'Campo Numerico',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);*/
$p_nombre = array(
    'name' => 'p_nombre',
    'id' => 'p_nombre',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Primer Nombre',
    'required' => 'required',
    'autocomplete' => 'off',
    'required pattern'=>'[a-zA-Z]{3,25}',
    'title'=>'Campo de Texto',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$s_nombre = array(
    'name' => 's_nombre',
    'id' => 's_nombre',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Segundo Nombre',
    'autocomplete' => 'off',
    'class' => 'form-control',
    //'required pattern'=>'[a-zA-Z]{3,25}',
    'title'=>'Campo de Texto',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$p_apellido = array(
    'name' => 'p_apellido',
    'id' => 'p_apellido',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Primer Apellido',
    'required' => 'required',
    'autocomplete' => 'off',
    'required pattern'=>'[a-zA-Z]{3,25}',
    'title'=>'Campo de Texto',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$s_apellido = array(
    'name' => 's_apellido',
    'id' => 's_apellido',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Segundo Apellido',
    'autocomplete' => 'off',
    //'required pattern'=>'[a-zA-Z]{3,25}',
    'title'=>'Campo de Texto',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$telefono_local = array(
    'name' => 'telefono_local',
    'id' => 'telefono_local',
    'maxlength' => '15',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Telefono Local',
    'required' => 'required',
    'autocomplete' => 'off',
    'required pattern'=>'[0-9]{10,12}',
    'title'=>'Numero Telefonico sin caracteres especiales',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$telefono_celular = array(
    'name' => 'telefono_celular',
    'id' => 'telefono_celular',
    'maxlength' => '15',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Telefono Celular',
    'required' => 'required',
    'autocomplete' => 'off',
    'required pattern'=>'[0-9]{10,12}',
    'title'=>'Numero Telefonico sin caracteres especiales',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$correo = array(
    'name' => 'correo',
    'id' => 'correo',
    'maxlength' => '40',
    'size' => '18',
    'type' => 'email',
    'placeholder' => 'Correo@mijp.gob.ve',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$correo2 = array(
    'name' => 'correo2',
    'id' => 'correo2',
    'maxlength' => '40',
    'size' => '18',
    'type' => 'email',
    'placeholder' => 'Correo@gmail.com',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$fecha_registro = array(
    'name' => 'fecha_registro',
    'id' => 'fecha_registro',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'date',
    'placeholder' => 'fecha_registro',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$usuario = array(
    'name' => 'usuario',
    'id' => 'usuario',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'password',
    'placeholder' => 'Usuario',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$clave = array(
    'name' => 'clave',
    'id' => 'clave',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'password',
    'placeholder' => 'Clave',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off'
);
$rol = array(
    'name' => 'rol',
    'id' => 'rol',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'int',
    'placeholder' => 'Rol',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$titulo = array(
    'name' => 'titulo',
    'id' => 'titulo',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'int',
    'placeholder' => 'titulo',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$id_usuario = array(
    'name' => 'id_usuario',
    'id' => 'id_usuario',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'int',
    'placeholder' => 'titulo',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$id_rol = array(
    'name' => 'id_rol',
    'id' => 'id_rol',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'int',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
?>
<div id="body">

    <div class="table-responsive">
        <table class="table">
            <tr>
                <td colspan="6" bgcolor="#EBECEC"><h2 align="center">Registrar Nuevo Usuario </h2></td>
            </tr>
            <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
                <td width="16%" height="39" ><div align="right" data-toggle="tooltip" title="Ingrese su Nro de C&eacute;dula">C&eacute;dula: </div></td>
                <td width="19%" ><div align="left" ><div id=resultado'><input   type='text'  name='cedula' id='cedula'  placeholder='Cedula'  required pattern='[0-9]{7,10}'  maxlength='12' size='22' autocomplete='off'
                class='form-control' title= 'Registre su Nro de Cedula'></td></div></div></td>
                <td width="15%" ><div align="right" data-toggle="tooltip" title="Ingrese su Primer Nombre">Primer Nombre :</div></td>
                <td width="17%" ><div align="left"><?php echo form_input($p_nombre) ?></div></td>
                <td width="14%" ><div align="right" data-toggle="tooltip" title="Ingrese su Segundo Nombre (Opcional)">Segundo Nombre : </div></td>
                <td width="19%"><div align="left"><?php echo form_input($s_nombre) ?></div></td>
            </tr>
            <tr>
                <td height="39"><div align="right" data-toggle="tooltip" title="Ingrese su Primer Apellido">Primer Apellido :</div></td>
                <td><div align="left"><?php echo form_input($p_apellido) ?></div></td>
                <td><div align="right" data-toggle="tooltip" title="Ingrese su Segundo Apellido (Opcional)">Segundo Apellido : </div></td>
                <td><div align="left"><?php echo form_input($s_apellido) ?></div></td>

                <td><div align="right" data-toggle="tooltip" title="Ingrese Nro telef&oacute;nico de su oficina">Telf. Oficina :</div></td>
                <td><div align="left"><?php echo form_input($telefono_local) ?></div></td>
            </tr>
            <tr>
                <td height="40"><div align="right" data-toggle="tooltip" title="Ingrese Nro telef&oacute;nico Personal">Telf. Celular :</div></td>
                <td ><div align="left"><?php echo form_input($telefono_celular) ?></div></td>
                <td ><div align="right" data-toggle="tooltip" title="Ingrese Direcci&oacute;n de Correo Institucional">Correo:</div></td>
                <td ><div align="left"><?php echo form_input($correo) ?></div></td>
                <td ><div align="right" data-toggle="tooltip" title="Ingrese Direcci&oacute;n de Correo Alternativa (Opcional)">Correo:</div></td>
                <td ><div align="left"><?php echo form_input($correo2) ?></div></td>
            </tr>
            <tr>
                <td><div align="right">Fecha del Registro :</div></td>
                <td ><div align="left">
                        <input type="text" name=" fecha" id= " fecha" size="18" readonly="readonly" class="form-control" value=" <?php echo mdate($datestring) ?>" />
                    </div></td>
                <td height="34"><div align="right" data-toggle="tooltip" title="Nombre de Usuario con el que Ingresar&aacute; al Sistema">Usuario:</div></td>
                <td><div align="left"><?php echo form_input($usuario) ?></div></td>
                <td><div align="right" data-toggle="tooltip" title="Clave de Acceso con la que Ingresar&aacute; al Sistema">Clave:</div></td>
                <td><div align="left"><?php echo form_input($clave) ?></div></td>
            </tr>
            <tr>
                <td ><div align="right" data-toggle="tooltip" title="Tipo de Usuario que otorga privilegios seg&uacute;n el que seleccione" >Rol :</div></td>
                <td>

                    <div align="left">
                        <select name="rol" class="form-control" required="required"><option value="">Selecione</option>';
<?php
foreach ($lista_rol as $i => $rol) {
    
    echo '<option value="' . $rol[0] . '">' . $rol[1] . '</option>';
}
?>
                        </select>
                    </div></td>
                <td height="39"><div align="right"data-toggle="tooltip" title="Grado de Instruccci&oacute;n del Usuario">Prefijo del Nombre:</div></td>
                <td ><div align="left" ><select name="titulo" class="form-control" required="required"> 
                             <option value="">Seleccione</option>
                            <option value="1">ING.</option>
                            <option value="2">LCDO.</option>
                            <option value="3">TEC.</option>
                            <option value="4">BR.</option>

                        </select></div></td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
            </tr>
            <tr>
                <td height="24" >&nbsp;</td>
                <td colspan="5" >&nbsp;</td>
            </tr>  
            <tr>
                <td height="55" colspan="6" align="center" > 
                    <div align="center">
<?php
$atributosSubmit = array('class' => 'btn btn-primary');
echo form_submit($atributosSubmit, 'Registrar')
?>	    
                    </div></td>
            </tr>
        </table>
    </div>
</div>

<?php echo form_close() ?>


<!-- Script para informacion sobre las etiqutas de los campos (tooltip)-->
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>


<script>
    $(document).on("blur", '#cedula', function ()
    {
		var campo=$(this);
		//console.log($(this).pattern);
        $.ajax({
             url: "<?php echo base_url() . 'index.php/usuariocontroler/consultar_usuario'; ?>",
            data: {cedula: $('#cedula').val()},
            dataType: 'html',
            type: 'post',
            success: function (salida) {
                //alert(salida); 
                //var datos = salida.split("~");
                //alert(datos[0]);
				if(salida==1)
				{
					alert("Ya existe un usuario Registrado con esta Cedula.....!");
					//console.log(campo.val());
					//alert(campo.val());
					campo.val('');
					return false
				}
                $("#resultado").html(salida);
           
        }
        });



    });

</script>
