<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');

//La Primera vez que entramos al caso de uso
	if(($desde=="" || isset($desdeEditar)) && !(isset($palabraClave)))
	{
	
?>
<script>
	$(document).ready(function() 
			{
				
				$("#buscar_usuarios").keyup(function()
				{
					//alert("prueba");
					//$("#div_dependencia").load("<?php echo base_url().'index.php/organismos/listar?palabra=' ?>"+$("#buscar_dependencia").val());
					
					$('#div_usuarios').html('<div><img src="<?php echo base_url() .APPPATH?>/imagenes/ajax-loader.gif"/></div>');
                                            var por_pagina = $(this).attr('id');
						   //alert(a_href);
						   $.ajax({
							 type: "GET",
							 url: '?palabra='+$("#buscar_usuarios").val(),
							 success: function(html){
					 $("#div_usuarios").html(html);
							  }
						   });               
				 });
					//alert( "Handler for .change() called." );
			});
</script>
<table class="tabla_campo_busqueda">
    <tr>
        <th colspan="5">
            <input autocomplete="off" size="50" placeholder="Buscar Usuarios..." type="text" maxlength="50" name="buscar_usuarios" id="buscar_usuarios" />
        </th>
        <td>
        </td>
    </tr>
</table>
<?php
	}
?>
<div id='div_usuarios' style="margin:0 auto;text-align:center">

 <script>
		$(document).ready(function() 
		{
			$("div#pagination a").click(function() 
			{
				var por_pagina = $(this).attr('id');
	
				$('#div_usuarios').html('<div><img src="<?php echo base_url() .APPPATH?>/imagenes/ajax-loader.gif"/></div>');
				
					   //alert(a_href);
					   $.ajax({
						 type: "GET",
						<?php
						 if(isset($palabraClave) && $palabraClave!="")
						 {
						 ?>
						 	url: 'listar/'+por_pagina+'?palabra=<?php echo $palabraClave;?>',
						<?php
						 }
						else
					   	{
						  ?>
							 url: 'listar/'+por_pagina,
						<?php
						}
						?>
						 success: function(html){
				 $("#div_usuarios").html(html);
						  }
					   });               
					 });            
			   //return false;
			 //};  
		});
	</script>
<?php

	if($resultados[0][0]!="")
	{
		$contenido="";
		foreach($resultados as $resultado) 
			{ 
				if($resultado[12]=="true")
				{
					$estatus="Activo";	
				}
				else
				{
					$estatus="Desactivado";	
				}
				$contenido.="<tr><td>".$resultado[0]."</td>
						  <td>".$resultado[1]."</td>
						  <td>".$resultado[3]."</td>
						  <td>".date("d-m-Y",strtotime($resultado[9]))."</td>
						  <td>".$estatus."</td>					  
						  <td><a href='".base_url()."index.php/usuarios/editar?vars=".base64_encode ("id_usuario=".$resultado[17])."'><img style='cursor:pointer' src='".base_url() .APPPATH."/imagenes/editar_usuario.png' alt='Editar' title='Editar'/></a></td>
					 </tr>";
			}
	}
	else
	{
		$contenido='<tr>
					<td colspan="6">No se consiguieron registros</td>
				</tr>';
	}
     ?>
    
    <table class="tabla_lista">
        <thead>
            <tr>
                <th colspan="6">
                    Lista de Usuarios
                </th>
            </tr>
            <tr>
                <th>
                    Cédula
                </th>
                <th>
                    Primer Nombre
                </th>
                <th>
                    Primer Apellido
                </th>
                <!--<th>
                    Telefóno Móvil
                </th>
                <th>
                    Correo Personal
                </th>-->
                 <th>
                    Fecha de Registro                              
                </th>
                 <th>
                    Estatus
                </th>
                <th>
                    Editar
                </th>
                <!--<th>
                    Usuario
                </th>
                <th>
                    Clave
                </th>
               
                <th>
                    Rol
                </th>
                 <th>
                    Cargo
                </th>-->
            </tr>
        </thead>
        <?php
			echo $contenido;
		?>
      <tbody>
    </table>
	<div id="pagination"><?=$this->pagination->create_links(); ?></div>
</div>
		
	
