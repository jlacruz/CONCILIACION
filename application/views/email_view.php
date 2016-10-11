<?php
//print_r($listar_nom_analista);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$variablesSesion=$this->session->userdata('usuario');
$rol=$variablesSesion['rol'];
$attributes = array('class' => '', 'id' => '');

echo form_open('emailcontroler/insertar_solicitud', $attributes)
?>
<?php
$nom_analista = array(
    'name' => 'nom_analista',
    'id' => 'nom_analista',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'nom_analista',
    'required' => 'required',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$nombre = array(
    'name' => 'nombre',
    'id' => 'nombre',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'nombre',
    'required' => 'required',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$correo = array(
    'name' => 'motivo',
    'id' => 'motivo',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$apellido = array(
    'name' => 'apellido ',
    'id' => 'apellido ',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'apellido ',
    'required' => 'required',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$tipo_documento = array(
    'name' => 'tipo_documento',
    'id' => 'tipo_documento',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'tipo_documento',
    'required' => 'required',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$fecha = array(
    'name' => 'fecha',
    'id' => 'fecha',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'date',
    'placeholder' => 'Cuenta Contrato',
    'required' => 'required',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$motivo = array(
    'name' => 'motivo',
    'id' => 'motivo',
    'maxlength' => '250',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'Motivo de la solicitud de modificacion de datos.',
    'required' => 'required',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
?>


<div id="body">
	
	<div class="table-responsive">
  <table class="table">
        <tr>
            <td height="77" colspan="4" bgcolor="#EBECEC"><h2 align="center">Solicitud de Modificaci&oacute;n </h2></td>
        </tr>

        <tr>
            <td width="177" height="72" align="center"><div align="right">Nombre del Analista: </div></td>
            <td width="196" bordercolor="#EBECEC"  ><div align="left">
                     <?php echo $variablesSesion['nombre']." ".$variablesSesion['p_apellido'] ?>
                    
               </div></td>
               
        </tr>
        
        <tr>
            <td height="41" ><div align="right">Tipo de Documento: </div></td>
            <td width="196" ><div align="center">
                    <select id="tipo_documento" name="tipo_documento"  class="form-control"required="required">
                        <option value="">...SELECCIONE ...</option>';
                        <option value='1'>Factura</option>
                        <option value='2'>Orden de Pago</option>
                    </select>
                </div></td>
            <td width="145" ><div align="center"></div></td>
        </tr>
        <tr>
            <td height="46"><div align="right">Fecha:</div></td>
            <td colspan="3"><div align="left" >

                    <div align="left">
                        <?php echo mdate($datestring) ?>
                    </div>
                </div></td>
        </tr>
        <tr>
            <td height="27" colspan="4" ><div align="center">Motivo: (Describa brevemente los motivos de la solicitud de modificacion de datos)</div></td>
        </tr>
        <tr align="left">
            <td height="58" colspan="4" align="left"><textarea name="motivo" cols="85"  <?php echo form_input($motivo) ?></textarea></td> 
            
        </tr>
        <tr>
            <td colspan="4" > <p align="center">
                    <?php
                    
		    $atributosSubmit = array('class' => 'btn btn-primary');
                    echo form_submit($atributosSubmit,'Enviar')?>
                      
                    
                </p></td>
        </tr>
    </table>


</div>
</div>


<?php echo form_close() ?>
