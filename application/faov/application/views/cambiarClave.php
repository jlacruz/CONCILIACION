
<?php
	//Destruir Sesión
	$this->session->sess_destroy();
	//Imprimir seisión
	print_r($this->session->userdata('usuario'));
	//print_r($variablesSesion);
	//print_r($vars);
	if(isset($mensaje))
	{
		echo $mensaje;
	}
?>
<?php
$clave = array(
    'name' => 'clave',
    'id' => 'clave',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'password',
    'placeholder' => 'Confirmar Clave',
    'required' => 'required',
    'class' => 'form-control',
    'title' => 'ConfirmeClave con la que Accedera al Sistema',
    'onChange' => 'cambiar_clave()',
    'autocomplete' => 'off'
);


$confirmar_clave = array(
    'name' => 'confirmar_clave',
    'id' => 'confirmar_clave',
    'maxlength' => '20',
    'size' => '18',
    'type' => 'password',
    'placeholder' => 'Nueva Clave',
    'required' => 'required',
    'title' => 'ConfirmeClave con la que Accedera al Sistema',
    'title' => 'Clave con la que Accedera al Sistema',
    'class' => 'form-control',
    //'onClick' => 'return compara()',
    'autocomplete' => 'off'
);
   

?>


<?php echo form_open('principal/actualizarClave') ?>

	<table class="table center-table table-nonfluid">
    	
    	<tr>     
           <h3 class="form-signin-heading">Cambiar Clave</h3>  
        </tr>
       
        <tr>
        	<td><div align="center"><?php echo form_input($confirmar_clave) ?></div></td>
        </tr>
        
        <tr>
          <td><div align="center"><?php echo form_input($clave) ?></div></td>
        </tr>
        <tr>
        	<td>
            	<div align="center"><?php echo form_input(array('name' => 'id_usuario', 'id' => 'id_usuario','required' => 'required','type' => 'hidden','value' =>$id_usuario )) ?></div></td>
        </tr>
        <tr>
          <td><div align="center">
            <?php
		$atributosSubmit = array('class' => 'btn btn-primary');
		 echo form_submit($atributosSubmit,'Actualizar')?>
          </div></td>
        </tr>
        <tr>
            <td><div align="center"><a href="login">Regresar</a></div></td>
        </tr>
    </table>
<?php echo form_close();?>





<script>
    function cambiar_clave()
    {
        if ((document.getElementById('clave').value != document.getElementById('confirmar_clave').value))
        {
			
            alert("LAS CLAVES DEBEN SER IGUALES");
            document.getElementById('clave').value="";
			document.getElementById('confirmar_clave').value="";
            //document.getElementById('confirmar_clave').focus();
            
            return false;
        }
        else
        {           
            document.form_cambioClave.submit();
        }
    }
</script>


