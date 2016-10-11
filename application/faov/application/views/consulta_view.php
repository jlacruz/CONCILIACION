
<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('consulta_controler/gestionar', $attributes)
?>
<?php
$mes = array(
    'name' => 'mes',
    'id' => 'mes',
    'maxlength' => '50',
    'size' => '10',
    'type' => 'number',
    'placeholder' => 'mes',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'required pattern'=>'[0-9]{2}',
    //'value' => $v_cedula,
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()' 
);
$anio = array(
    'name' => 'anio',
    'id' => 'anio',
    'maxlength' => '50',
    'size' => '10',
    'type' => 'number',
    'placeholder' => 'anio',
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
    <td colspan="4"><div align="center"><h3><font color="#365D91">Gestionar Consulta FAOV</font></h3></div></td>
  </tr>
  <tr>
    <td width="150"><div align="right">Mes:</div></td>
    <td width="201"><select name="mes" class="form-control" required="required"> 
                            <option value="">Seleccione un Mes</option>
                            <option value="1">ENERO</option>
                            <option value="2">FEBRERO</option>
                            <option value="3">MARZO</option>
                            <option value="4">ABRIL</option>
                            <option value="5">MAYO</option>
                            <option value="6">JUNIO</option>
                            <option value="7">JULIO</option>
                            <option value="8">AGOSTO</option>
                            <option value="9">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>

                        </select></td>
    <td width="73"><div align="right">A&ntilde;o:</div></td>
    <td width="166"><select id="anio" name="anio" class="form-control" required="required"><option value=''>Seleccione un A&ntilde;o</option>
                    <?php
                    for ($anio = (date("Y")); 2014 <= $anio; $anio--) {
                        echo "<option value='$anio'>" . $anio . "</option>";
                    }
                    ?>
                </select></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
   
  </tr>
  <tr>
    <td colspan="4"><?php $atributosSubmit = array('class' => 'btn btn-primary');
                            echo form_submit($atributosSubmit,'Gestionar')?></td>
   
  </tr>
</table>
 <div id='resultado'>
       
    </div></div></div></div></div></div>

<?php echo form_close() ?>


