<?php
	//Destruir Sesión
	$this->session->sess_destroy();
	//Imprimir seisión
	print_r($this->session->userdata('usuario'));
	//print_r($vars);
	if(isset($mensaje))
	{
		echo $mensaje;
	}
?>
<?php echo form_open('principal/consultarUsuarioCorreo') ?>

<table class="table center-table table-nonfluid">
    <tr>
        <th>
    <h2 class="form-signin-heading">Recuperar clave</h2>   </th>
</tr>
<tr>
    <td><div align="center"><?php echo form_input(array('name' => 'usuario', 'id' => 'usuario', 'size' => '20', 'placeholder' => 'Usuario', 'required' => 'required' ,'class' => 'form-control','onkeyup' => 'javascript:this.value=this.value.toUpperCase()')) ?></div></td>
</tr>
<tr>
    <td><div align="center"><?php echo form_input(array('name' => 'correo', 'id' => 'correo', 'size' => '20', 'placeholder' => 'Correo', 'type' => 'email', 'required' => 'required', 'class' => 'form-control' ,'onkeyup' => 'javascript:this.value=this.value.toUpperCase()')) ?></div></td>
</tr>
<tr>
    <td><div align="center">
            <?php
            $atributosSubmit = array('class' => 'btn btn-primary');
            echo form_submit($atributosSubmit, 'Enviar')
            ?>
        </div></td>
</tr>
<tr>
    <td style="text-align:center">
        <div align="center"><a href="login">Regresar</a><a href="recuperarClave"></a> </div></td>
</tr>
</table>
<?php echo form_close();?>