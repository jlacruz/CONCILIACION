<?php echo form_open('usuarios/modificarMiUsuario') ?>

<script type="text/javascript">
$(document).ready(function() 
{
	$('#cambiarClave').click(function() 
	{
		//alert($('#clave').prop('disabled'));
		if($('#clave').prop('disabled')==true)
		{
			$('#clave').prop('disabled', false);
			$('#cambiarClave').text('No modificar');
		}
		else
		{
			$('#clave').prop('disabled', true);
			$('#cambiarClave').text('Modificar');
			$('#clave').val('');
		}
	});
	
	//Colocar el Mayúscula el texto de los campos
	$(document).on("keyup",'#primer_nombre,#segundo_nombre,#primer_apellido,#segundo_apellido', function()
	{
		$(this).val($(this).val().toUpperCase());
		
	});
	
	//Validar Campos (Solo Texto)
	$('#primer_nombre,#segundo_nombre,#primer_apellido,#segundo_apellido').filter_input({regex:'[A-Z a-z ñ á é í ó ú Ñ Á É Í Ó Ú]'}); 
});
</script>
<?php
//print_r($resultados);
/*$activado="";
$desactivado="";
$comboEstatus='<select name="estatus">';

if($resultados[0][12]=="true")
{
	$activado='selected="selected"';	
}
else
{
	$desativado='selected="selected"';	
}
$comboEstatus.='<option '.$activado.' value="TRUE">Activado</option>';
$comboEstatus.='<option '.$desactivado.' value="FALSE">Desativado</option>';

$comboEstatus.='</select>';*/
?>
	<table class="tablaCasosUsos">
    	<tr>
        	<th colspan="2">
            	Modificar mi Usuario
            </th>
        </tr>
        <tr>
        	<td>
            	Cédula
            </td>
        	<td colspan="2">        
            	<?php echo form_input(array('name' => 'cedula', 'id' => 'cedula','readonly' => 'readonly','value'=>$resultados[0][0])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Contraseña
            </td>
            <td>
            	<?php echo form_input(array('name' => 'clave_anterior', 'id' => 'clave_anterior','type' => 'hidden','value'=>$resultados[0][11])) ?>
            	<?php echo form_input(array('name' => 'clave', 'id' => 'clave', 'size' => '20','placeholder' => 'Contraseña','disabled'=>'disabled')) ?>
                <!--<input type="text" name="clave" id="clave" size="20" placeholder="Contraseña" disabled="disabled">-->
                <a id="cambiarClave" name="cambiarClave" href="#">Modificar</a>
            </td>
        </tr>
         <tr>
        	<td>
            	Título
            </td>
        	<td>
            	<?php echo $comboTitulos; ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Primer Nombre
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'primer_nombre', 'id' => 'primer_nombre', 'size' => '20','placeholder' => 'Primer Nombre','required' => 'required','value'=>$resultados[0][1])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Segundo Nombre
            </td>
            <td>
            	<?php echo form_input(array('name' => 'segundo_nombre', 'id' => 'segundo_nombre', 'size' => '20','placeholder' => 'Segundo Nombre','value'=>$resultados[0][2])) ?>
            </td>
        </tr>   
        <tr>
        	<td>
            	Primer Apellido
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'primer_apellido', 'id' => 'primer_apellido', 'size' => '20','placeholder' => 'Primer Apellido','required' => 'required','value'=>$resultados[0][3])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Segundo Apellido
            </td>
            <td>
            	<?php echo form_input(array('name' => 'segundo_apellido', 'id' => 'segundo_apellido', 'size' => '20','placeholder' => 'Segundo Apellido','value'=>$resultados[0][4])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Teléfono de Oficina
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'telefono_oficina', 'id' => 'telefono_oficina', 'size' => '20','placeholder' => 'Teléfono Oficina','required' => 'required','value'=>$resultados[0][5])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Teléfono Móvil
            </td>
            <td>
            	<?php echo form_input(array('name' => 'telefono_movil', 'id' => 'telefono_movil', 'size' => '20','placeholder' => 'Teléfono Móvil','value'=>$resultados[0][6])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Correo
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'correo', 'id' => 'correo', 'size' => '40','placeholder' => 'Correo','type' => 'email','required' => 'required','value'=>$resultados[0][7])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Otro Correo
            </td>
            <td>
            	<?php echo form_input(array('name' => 'correo2', 'id' => 'correo2', 'size' => '40','placeholder' => 'Correo 2','type' => 'select','value'=>$resultados[0][8])) ?>
            </td>
        </tr>
        <tr>
        	<td colspan="2" style="text-align:center">
            	<?php echo form_submit('modificar', 'Modificar') ?>
            </td>
        </tr>
    </table>
	<?php
		//$this->load->view('operaciones_opciones');	
 	?>
   

<?php echo form_close();?>