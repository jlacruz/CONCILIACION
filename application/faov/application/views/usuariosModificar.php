<?php echo form_open('usuarios/editar');
$variablesSesion=$this->session->userdata('usuario');

//estas variables vienen del controlador
$id_dependencia=$resultados2[0][0];
$id_organismo=$resultados2[0][2];
$id_rol=$resultados[0][13];
?>

<script type="text/javascript">
$(document).ready(function() 
{
		//Validar Campo de Cédula Númerico
		$('#cedula').numeric();
		//Validar Campo de Teléfono 1 Númerico
		$('#telefono_oficina').numeric();
		//Validar Campo de Teléfono 2 Númerico
		$('#telefono_movil').numeric();
		
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
		//Si no son administrador General Seleccionar el organismo y Dependencia automáticamente 
		<?php
			if($variablesSesion['rol']!=7)
			{

				if($variablesSesion['rol']==4)
				{
		?>
					$(document).on("change",'#roles', function()
					{
						$('#departamento').val('');
						if($('#roles').val()!=5 && $('#roles').val()!=6)
							{
								$("#div_direcciones").show();
								$("#div_direcciones").load("<?php echo base_url().'index.php/direcciones/comboDirecciones?id_dependencia=' ?>"+$("#dependencia").val());
							}
							else
							{
								$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='; ?>"+$('#roles').val()+"<?php echo '&id_dependencia=' ?>"+$("#dependencia").val());
								$("#div_direcciones").hide();
								$("#direcion").val('');
								$("#direccion").prop('disabled',true);
							}
					});
				
				<?php
					}
					else
					{
				?>
						$(document).on("change",'#roles', function()
						{
							$('#departamento').val('');				
						});
				
				<?php
					}
					
					//Si es Coordinador de Línea incluimos asignado a
					if($variablesSesion['rol']==2)
					{
				?>
						//incluir asignado a automáticamente
						$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='; ?>"+$('#roles').val()+"<?php echo '&id_departamento=' ?>"+$("#departamento").val()+"<?php echo '&id_direccion=' ?>"+$("#direccion").val());
						$("#div_asignado").empty();

				<?php
					}
					//Si es Director de Línea incluimos el combo del departamento
					else if($variablesSesion['rol']==3)
					{
				?>
						$("#div_departamentos").load("<?php echo base_url().'index.php/departamentos/comboDepartamentos?&id_direccion='.$id_direccion.'&id_departamento='.$id_departamento ?>");
						
						$(document).on("change",'#departamento', function()
						{

							$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='; ?>"+$('#roles').val()+"<?php echo '&id_direccion=' ?>"+$("#direccion").val()+"<?php echo '&id_departamento=' ?>"+$("#departamento").val());

						});
											
				<?php
					}
					
					//Si es Director General incluimos el combo de las Direcciones
					else if($variablesSesion['rol']==4)
					{
				?>
				
						if($('#roles').val()!=5 && $('#roles').val()!=6)
						{
							$("#div_direcciones").load("<?php echo base_url().'index.php/direcciones/comboDirecciones?id_dependencia=' ?>"+$("#dependencia").val()+"<?php echo '&id_direccion='.$id_direccion ?>");
						}
						else
						{
							$("#div_direcciones").hide();
							$("#direcion").val('');
							$("#direccion").prop('disabled',true);	
							
						}
						
						$(document).on("change",'#direccion', function()
						{
							
							$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='; ?>"+$('#roles').val()+"<?php echo '&id_direccion=' ?>"+$("#direccion").val()+"<?php echo '&id_dependencia=' ?>"+$("#dependencia").val());

						});
						
				<?php		
					}

			}
			else
			{
		?>		
	//Activar combo organismo
	$(document).on("change",'#roles', function()
	{
		$('#organismo').val('');
		
		if($("#roles").val()!="")
		$("#organismo").prop("disabled", false);
		else
		$("#organismo").prop("disabled", true);
		
		$("#div_dependencias").empty();
		$("#div_direcciones").empty();
		$("#div_departamentos").empty();
		
			//Si es Director General Activamos los campos del nombramiento(Gaceta, Resolución)
		if($(this).val()==4)
		{
			$("#fila_gaceta").show();
			$("#fila_resolucion").show();
			$("#gaceta").prop("disabled", false);
			$("#resolucion").prop("disabled", false);
		}
		else
		{
			//alert($(this).val());
			$("#fila_gaceta").hide();
			$("#fila_resolucion").hide();
			$("#gaceta").prop("disabled", "disabled");
			$("#resolucion").prop("disabled", "disabled");
		}
		
	});	
		
	//Combos Organismo y Dependencia
	$("#div_organismos").load("<?php echo base_url().'index.php/organismos/comboOrganismos?id_organismo='.$id_organismo; ?>");
	$("#div_dependencias").load("<?php echo base_url().'index.php/dependencias/comboDependencias?id_dependencia='.$id_dependencia.'&id_organismo='.$id_organismo ?>");
	
	//Si es Director General o Administrador no posee Dirección de Línea
	if($('#roles').val()!=4 && $('#roles').val()!=7 && $('#roles').val()!=5 && $('#roles').val()!=6)
	{
		$("#div_direcciones").load("<?php echo base_url().'index.php/direcciones/comboDirecciones?id_dependencia='.$id_dependencia.'&id_direccion='.$id_direccion ?>");
	
	}
	//Si es Analista o Coordinador posee Departamento
	if($('#roles').val()<3)
	{
		$("#div_departamentos").load("<?php echo base_url().'index.php/departamentos/comboDepartamentos?id_departamento='.$id_departamento.'&id_direccion='.$id_direccion ?>");
	}

	
	$(document).on("change",'#organismo', function()
	{
		$("#div_dependencias").load("<?php echo base_url().'index.php/dependencias/comboDependencias?id_organismo=' ?>"+$("#organismo").val());
		$("#div_direcciones").empty();
		$("#div_departamentos").empty();
	});
	
	
	//Incluir Direcciones
	$(document).on("change",'#dependencia', function()
	{
			if($('#roles').val()<4 || $('#roles').val()==8)
					{
						$("#div_direcciones").load("<?php echo base_url().'index.php/direcciones/comboDirecciones?id_dependencia=' ?>"+$("#dependencia").val());
					}
					else if($('#roles').val()==4)
					{
						$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='; ?>"+$('#roles').val()+"<?php echo '&id_dependencia=' ?>"+$("#dependencia").val());	
					}
			//limpiar el div asignado
			$("#div_asignado").empty();
	});
	
	
	//Incluir Departamentos
	$(document).on("change",'#direccion', function()
	{
			//limpiar el div asignado
			$("#div_asignado").empty();
			
			//si es Analista o Coordinador posee Departamento
			if($('#roles').val()==1 || $('#roles').val()==2 )
			{
				$("#div_departamentos").load("<?php echo base_url().'index.php/departamentos/comboDepartamentos?id_direccion=' ?>"+$("#direccion").val());
			}
			//Si es Director de Línea solo posee dirección a la cual pertenece, le asignamos el Director General de la dependencia
			if($('#roles').val()==3 || $('#roles').val()==8)
			{
				$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='; ?>"+$('#roles').val()+"<?php echo '&id_dependencia=' ?>"+$("#dependencia").val()+"<?php echo '&id_direccion=' ?>"+$("#direccion").val());
			}
	});
	
	
	//Incluir Combo asignado a Coordinador o Director:
	$(document).on("change",'#departamento', function()
	{
		$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='; ?>"+$('#roles').val()+"<?php echo '&id_departamento=' ?>"+$("#departamento").val()+"<?php echo '&id_direccion=' ?>"+$("#direccion").val());
		$("#div_asignado").empty();
	});
	
	
	//the min chars for username  
		var min_chars = 6;  
  
		//result texts  
		var characters_error = '<span style="color:red">El usuario debe contener al menos 6 caracteres</span>';   
		var checking_html = 'Validando...'; 
	
<?php
	}
	?>

	if($('#roles').val()==1 || $('#roles').val()==2)
		{
			$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='.$id_rol.'&id_departamento='.$id_departamento.'&id_direccion='.$id_direccion.'&id_asignado_a='.$id_asignado_a.'&editar=1' ?>");
		}
		else if($('#roles').val()==3)
		{
			$("#div_asignado").load("<?php echo base_url().'index.php/usuarios/comboUsuariosAsignar?id_rol='; ?>"+$('#roles').val()+"<?php echo '&id_dependencia='.$id_dependencia.'&id_asignado_a='.$id_asignado_a.'&editar=1'?>");
		}
		
		
	//Mostrar Campo Razón por la cual se desactivó el usuario
	<?php
		if($resultados[0][12]=="false")
		{
	?>
		$("#razon_desactivado").prop("disabled", false);	
		$("#div_razon_desactivado").show();
		$("#div_razon_desactivado").html('<br /><strong>Usuario desactivado por la siguiente razón:</strong><br />'+$("#div_razon_desactivado").html());
		$("#razon_desactivado").val('<?php echo $resultados[0][20] ?>');
	<?php	
		}
	?>
		
	//Mostrar Gaceta y Resolución si es Director General
	<?php
		if($resultados[0][13]==4)
		{
	?>
			$("#fila_gaceta").show();
			$("#fila_resolucion").show();
			$("#gaceta").prop("disabled", false);
			$("#resolucion").prop("disabled", false);
			$("#gaceta").val('<?php echo $gaceta ?>');
			$("#resolucion").val('<?php echo $resolucion ?>');
	<?php	
		}
	?>

	//Checkear Cédula
	$(document).on("keyup",'#cedula', function()
	{
		check_cedula();  
	});		
	
	//Checkear usuario  
	function check_availability()
	{  
			//get the username  
			var nombreUsuario = $('#usuario').val();  
	  
			//use ajax to run the check  
			$.post("<?php echo base_url().'index.php/usuarios/validarDisponibilidad' ?>", { nombreUsuario: nombreUsuario },  
				function(result)
				{  
					//if the result is 1  
					if(result == 1)
					{  
						//Mostrar el usuario está Disponible
						$('#username_availability_result').html('<span style="color:green">El nombre de usuario:' + '<strong>'+ nombreUsuario + '</strong> está disponible</span>');  						$('#disponible').val('1');
					}
					else
					{  
						//show that the username is NOT available  
						$('#username_availability_result').html('<span style="color:red">El nombre de usuario:' + '<strong>'+ nombreUsuario + '</strong> no está disponible</span>');  						$('#disponible').val('');
					}  
			});  
		} 
	
	//Checkear Email 1 
	$(document).on("keyup",'#correo', function()
	{
			if($('#correo').val().indexOf('@')!=-1 && $('#correo').val().indexOf('.')!=-1)
			check_availability_email1();  
	});
	
	//Checkear Email 2 
	$(document).on("keyup",'#correo2', function()
	{
			if($('#correo2').val().indexOf('@')!=-1 && $('#correo2').val().indexOf('.')!=-1)
			check_availability_email2();  
	});	
	//Mostrar campo si el usuario se va a desactivar
	$(document).on("change",'#estatus', function()
	{
		//alert($('#estatus').val());
		if($('#estatus').val()==="FALSE")
		{
			$("#razon_desactivado").prop("disabled", false);	
			$("#div_razon_desactivado").show();
		}
		else
		{
			$("#razon_desactivado").val('');
			$("#razon_desactivado").prop("disabled", true);	
			$("#div_razon_desactivado").hide();
		}
	});
	
	//Validar Disponibilidad del Usuario
	$(document).on("keyup",'#usuario', function()
	{
			//run the character number check  
		if($('#usuario').val().length < min_chars)
		{  
			//if it's bellow the minimum show characters_error text '  
			$('#username_availability_result').html(characters_error);  
		}
		else
		{  
			//else show the cheking_text and run the function to check  
			$('#username_availability_result').html(checking_html);  
			check_availability();  
		}  
	}); 
	
	//function to check email availability  
	function check_availability_email1()
	{  
			//get the username  
			//var campo = 'correo'; 
			var correo = $('#correo').val();  
	
			//use ajax to run the check  
			$.post("<?php echo base_url().'index.php/usuarios/validarDisponibilidadCorreo' ?>", { correo: correo},  
				function(result)
				{  
					//if the result is 1  
					if(result == 1)
					{  
						//Mostrar el usuario está Disponible
						$('#email_availability_result1').html('<span style="color:green">El Correo:' + '<strong>'+ correo + '</strong> está disponible</span>');  						$('#disponible').val('1');
					}
					else
					{  
						//show that the username is NOT available  
						$('#email_availability_result1').html('<span style="color:red">El Correo:' + '<strong>'+ correo + '</strong> no está disponible</span>');  								$('#email_disponible').val('');
					}  
			});  
	  
		}  
		
		//function to check email availability  
	function check_availability_email2()
	{  
			//get the username  
			//var campo = 'correo2'; 
			var correo = $('#correo2').val();  
	
			//use ajax to run the check  
			$.post("<?php echo base_url().'index.php/usuarios/validarDisponibilidadCorreo' ?>", { correo: correo}, 
				function(result)
				{  
					//if the result is 1  
					if(result == 1)
					{  
						//Mostrar el usuario está Disponible
						$('#email_availability_result2').html('<span style="color:green">El Correo:' + '<strong>'+ correo + '</strong> está disponible</span>');  						$('#email_disponible2').val('1');
					}
					else
					{  
						//show that the username is NOT available  
						$('#email_availability_result2').html('<span style="color:red">El Correo:' + '<strong>'+ correo + '</strong> no está disponible</span>');  						$('#email_disponible2').val('');
					}  
			});  
	  
		}

	//function to check Cédula 
	function check_cedula()
	{  
			//get the username  
			//var campo = 'correo2'; 
			var cedula = $('#cedula').val();  
	
			//use ajax to run the check  
			$.post("<?php echo base_url().'index.php/usuarios/validarCedula' ?>", { cedula: cedula}, 
				function(result)
				{  
					//if the result is 1  
					if(result == 1)
					{  
						//Mostrar el usuario está Disponible
						$('#cedula_availability_result').html('<span style="color:green">La Cédula:' + '<strong>'+ cedula + '</strong> está disponible</span>');  						$('#cedula_disponible').val('1');
					}
					else
					{  
						//show that the username is NOT available  
						$('#cedula_availability_result').html('<span style="color:red">La Cédula:' + '<strong>'+ cedula + '</strong> no está disponible</span>');  						$('#cedula_disponible').val('');
					}  
			});  
	  
		}		
		
		//Colocar el Mayúscula el texto de los campos
		$(document).on("keyup",'#primer_nombre,#segundo_nombre,#primer_apellido,#segundo_apellido,#usuario', function()
		{
			$(this).val($(this).val().toUpperCase());
			
		});
		
		//Validar Campos (Solo Texto)
		$('#primer_nombre,#segundo_nombre,#primer_apellido,#segundo_apellido,#usuario').filter_input({regex:'[A-Z a-z ñ á é í ó ú Ñ Á É Í Ó Ú]'}); 
		  
});


</script>
<?php
//print_r($resultados2);
$activado="";
$desactivado="";
$comboEstatus='<select autocomplete="off" name="estatus" id="estatus">';

if($resultados[0][12]=="true")
{
	$activado='selected="selected"';	
}
else
{
	$desactivado='selected="selected"';	
}
$comboEstatus.='<option '.$activado.' value="TRUE">Activado</option>';
$comboEstatus.='<option '.$desactivado.' value="FALSE">Desactivado</option>';

$comboEstatus.='</select>';
?>
<div style="width:38%;margin:0 auto">
    <div style="margin-top:50px">
        <a style="display:block" href="listar">
            <img src='<?php echo base_url() .APPPATH?>/imagenes/volver.png' alt='Regresar' title='Regresar'/>Regresar
        </a>
    </div>
	<table class="tablaCasosUsos">
    	<tr>
        	<th colspan="2">
            	Modificar Usuarios
            </th>
        </tr>
        <tr>
        	<td>
            	Perfil:
            </td>
            <td>
            	<?php echo $comboRoles; ?>
            </td>
        </tr>
         <tr>
            <td>
            	Organismo:
            </td>
        	<td>
            	<div id="div_organismos">
                	<?php echo $comboOrganismos; ?>
                </div>
            </td>
        </tr>
        <tr>
        	 <td>
             	Dependencia:
             </td>
        	 <td>
            	<div id="div_dependencias">
                	<?php echo $comboDependencias; ?>
                </div>
            </td>
        </tr>
        <tr>
        	<td>
            	Dirección:
            </td>
        	<td>
            	<div id="div_direcciones">
                	<?php echo $comboDirecciones; ?>
                </div>
            </td>
        </tr>
        <tr>
        	<td>
            	Departamento:
            </td>
        	<td>
            	<div id="div_departamentos">
                	<?php echo $comboDepartamentos; ?>
                </div>
            </td>
        </tr>
        <tr>
        	<td>
            	Asignado a:
            </td>
            <td>
                <div id="div_asignado">
                </div>
            </td>
        </tr>
        <tr>
        	<td>
            	Cédula
            </td>
        	<td colspan="2">        
            	<?php echo form_input(array('name' => 'cedula','maxlength' => '8' ,'id' => 'cedula','value'=>$resultados[0][0])) ?>
                <div id='cedula_availability_result'></div>
                <div id="div_cedula_disponible" style="display:none"><input required name="cedula_disponible" id="cedula_disponible" type="text" value='1' autocomplete="off" />
                </div>
                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $resultados[0][17] ?>">
            </td>
        </tr>
        <tr>
        	<td>
            	Usuario:
            </td>
           	<td>
            	<?php echo form_input(array('name' => 'usuario', 'id' => 'usuario', 'size' => '20','maxlength' => '12','placeholder' => 'Usuario','required' => 'required','value'=>$resultados[0][10],'autocomplete'=>'off')) ?>
                <div id='username_availability_result'></div>
                <div id="usuario_disponible" style="display:none"><input required name="disponible" id="disponible" type="text" value='1' autocomplete="off" /></div>  
            </td>
        </tr>
        <tr>
        	<td>
            	Contraseña:
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
            	Título:
            </td>
        	<td>
        		<?php echo $comboTitulos; ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Primer Nombre:
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'primer_nombre', 'id' => 'primer_nombre', 'size' => '20','placeholder' => 'Primer Nombre','required' => 'required','value'=>$resultados[0][1])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Segundo Nombre:
            </td>
            <td>
            	<?php echo form_input(array('name' => 'segundo_nombre', 'id' => 'segundo_nombre', 'size' => '20','placeholder' => 'Segundo Nombre','value'=>$resultados[0][2])) ?>
            </td>
        </tr>   
        <tr>
        	<td>
            	Primer Apellido:
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'primer_apellido', 'id' => 'primer_apellido', 'size' => '20','placeholder' => 'Primer Apellido','required' => 'required','value'=>$resultados[0][3])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Segundo Apellido:
            </td>
            <td>
            	<?php echo form_input(array('name' => 'segundo_apellido', 'id' => 'segundo_apellido', 'size' => '20','placeholder' => 'Segundo Apellido','value'=>$resultados[0][4])) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Teléfono:
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'telefono_oficina','maxlength' => '11', 'id' => 'telefono_oficina', 'size' => '20','placeholder' => 'Teléfono Oficina','required' => 'required','value'=>$resultados[0][5],'maxlength' => '11')) ?>
            </td>
         </tr>
         <tr>
         	<td>
				Teléfono (Opcional):
            </td>
            <td>
            	<?php echo form_input(array('name' => 'telefono_movil','maxlength' => '11', 'id' => 'telefono_movil', 'size' => '20','placeholder' => 'Teléfono Opcional','value'=>$resultados[0][6],'maxlength' => '11')) ?>
            </td>
        </tr>
        <tr>
        	<td>
            	Correo Electrónico:
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'correo', 'id' => 'correo','maxlength' => '30', 'size' => '40','placeholder' => 'Correo','type' => 'email','required' => 'required','value'=>$resultados[0][7],'autocomplete' => 'off')) ?>
                <div id='email_availability_result1'></div>
                <div id="email_disponible1" style="display:none"><input required name="email_disponible1" id="email_disponible1" type="text" value='1' autocomplete="off"  /></div> 
                
            </td>
         </tr>
         <tr>
         	<td>
            	Correo Electrónico (Opcional):
         	</td>
            <td>
            	<?php echo form_input(array('name' => 'correo2', 'id' => 'correo2', 'size' => '40','placeholder' => 'Correo 2','type' => 'select','value'=>$resultados[0][8],'autocomplete' => 'off')) ?>
                <div id='email_availability_result2'></div>
                <div id="email_disponible2" style="display:none"><input name="email_disponible2" id="email_disponible2" type="text" value='1' autocomplete="off"  /></div> 
            </td>
        </tr>
        <tr>
         	<td>
            	Estatus:
            </td>
            <td>
            	<?php echo $comboEstatus; ?>
                <div style="float:right;text-align:left;display:none" id="div_razon_desactivado">
                	<textarea required='required' disabled id="razon_desactivado" name="razon_desactivado" placeholder="¿Por que desactiva el usuario?"></textarea>
                </div>
            </td>
        </tr>
        
        <tr id="fila_gaceta" style="display:none">
            <td>
                Gaceta:
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'gaceta', 'id' => 'gaceta', 'size' => '60','placeholder' => 'Gaceta','type' => 'select','required' => 'required','autocomplete' => 'off','disabled' => 'disabled')) ?>
            </td>
        </tr>
        <tr id="fila_resolucion" style="display:none">
        	<td>
            	Resolución:
            </td>
        	<td>
            	<?php echo form_input(array('name' => 'resolucion', 'id' => 'resolucion', 'size' => '60','placeholder' => 'Resolución','type' => 'select','required' => 'required','autocomplete' => 'off','disabled' => 'disabled')) ?>
            </td>
        </tr>
    </table>
	<?php
		$this->load->view('operaciones_opciones');	
 	?>
   	<div style="margin:0 auto;text-align:center"><?php echo form_submit('modificar', 'Modificar') ?></div>

<?php echo form_close();?>
</div>
