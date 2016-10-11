
<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('consulusercontroler/buscarDatos', $attributes)
?>
<?php
$cedula = array(
    'name' => 'cedula',
    'id' => 'cedula',
    'maxlength' => '50',
    'size' => '10',
    'type' => 'number',
    'placeholder' => 'Cedula',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'required pattern'=>'[0-9]{2}',
    //'value' => $v_cedula,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()' 
);
?>

<div id="body">
	
	<div class="table-responsive">
  <table class="table table-hover">
        <tr>
          <td height="54" colspan="5" ><h2 align="center"><font color="#365D91">Gestionar Usuario</font></h2></td>
        </tr>
        <tr>
            <td height="27" colspan="5">&nbsp;</td>
        </tr>
        <tr>
          <td width="16%" height="63" bordercolor="#EBECEC" > <div align="right">Cedula: </div></td>
          <td width="22%" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($cedula) ?></div></td>
         
          
        </tr>
        
        <tr>
          <td height="87" colspan="5" bordercolor="#EBECEC"  ><div align="center">

                    <table>
                        <tr>
                            <td colspan="2" align="center"> 
                            <?php $atributosSubmit = array('class' => 'btn btn-primary');
                            echo form_submit($atributosSubmit,'Gestionar')?>	    
                            </td>
                        </tr>
                    </table>
    </table>
    <div id='resultado'>
       
    </div>
</div></div></div></div</div></div>



<?php echo form_close() ?>


