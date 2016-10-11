
<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');
$variablesSesion=$this->session->userdata('usuario');
//print_r($variablesSesion);


echo form_open('facturacontroler/insertar_factura', $attributes)
?>
<?php

$fecha_carga = array(
    'name' => 'fecha_carga',
    'id' => 'fecha_carga',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'date',
    'readonly' => 'readonly',
    'placeholder' => 'fecha_carga',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$cuenta_contrato = array(
    'name' => 'cuenta_contrato',
    'id' => 'cuenta_contrato',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'Cuenta Contrato',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$id_usuario = array(
    'name' => 'id_usuario',
    'id' => 'id_usuario',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'hidden',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$fecha_documento = array(
    'name' => 'fecha_documento',
    'id' => 'fecha_documento',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'fecha documento',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
/*
$f_numero = array(
    'name' => 'f_numero',
    'id' => 'f_numero',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'required' => 'required',
    'onblur'=>'validatePass(this)',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

*/
$cod_proveedor = array(
    'name' => 'cod_proveedor',
    'id' => 'cod_proveedor',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'int',
    'placeholder' => 'Cod. Proveedor',
    'required' => 'required',
    'class' => 'form-control',
     'readonly' => 'readonly',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$descripcion = array(/* servicio */
    'name' => 'descripcion',
    'id' => 'descripcion',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'int',
    'placeholder' => 'servicio',
    'required' => 'required',
    'class' => 'form-control',
     'readonly' => 'readonly',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$nombre = array(
    'name' => 'nombrer',
    'id' => 'nombre',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'int',
    'placeholder' => 'select',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$observacion = array(
    'name' => 'observacion ',
    'id' => 'observacion ',
    'maxlength' => '300',
    'class' => 'form-control',
    'size' => '109',
    'type' => 'text',
    'placeholder' => 'Indique sus observaciones',
    //'required' => 'required',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$mes = array(
    'name' => 'mes ',
    'id' => 'mes ',
    'maxlength' => '300',
    'class' => 'form-control',
    'size' => '109',
    'type' => 'text',
    'placeholder' => 'Indique sus observaciones',
    'required' => 'required',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
/* for ($anio = (date("Y")); 2011 <= $anio; $anio--) {
  echo "<option value=&#39;" . $anio . "&#39;>" . $anio . "</option>"; */
?>


<div id="body">
	
	<div class="table-responsive">
  <table class="table">
        <tr>
            <td height="54" colspan="6" bgcolor="#EBECEC"><h2 align="center">Gestionar Factura</h2></td> <input type="hidden" name="estado" value=" <?php echo $variablesSesion['id_usuario'] ?>" />
        </tr>
        <tr>
            <td height="27" colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td width="14%" height="41" bordercolor="#EBECEC" > <div align="right">Proveedor: </div></td>
            <td width="28%" bordercolor="#EBECEC"  ><select name="proveedores" id="proveedores" class="form-control" required="required">
                    <option value="">...Seleccione ...</option>';
                    <?php
                    foreach ($lista_proveedores as $i => $proveedores) {
                        echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
                    }
                    ?>
                </select></div></td>
            <td width="20%" bordercolor="#EBECEC" ><div align="right">C&oacute;d. Proveedor: </div></td>
            <td width="22%" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($cod_proveedor) ?></div></td>
            <td width="14%" bordercolor="#EBECEC" ><div align="right">Cuenta Contrato:</div></td>
            <td width="14%" bordercolor="#EBECEC" ><div id="cuenta_contrato" name="cuenta_contrato[]" required ></div></td>    
        </tr>
        <tr>
            <td height="39" bordercolor="#EBECEC"><div align="right">Fecha de carga:</div></td>
            <td bordercolor="#EBECEC"><div align="left">
                    <?php echo mdate($datestring) ?>
                </div></td>
            <td bordercolor="#EBECEC"><div align="right">Servicio:</div></td>
            <td bordercolor="#EBECEC"><div align="left"><?php echo form_input($descripcion) ?></div></td>
            <td bordercolor="#EBECEC">&nbsp;</td>
            <td bordercolor="#EBECEC">&nbsp;</td>
        </tr>
        <tr>
            <td height="40" colspan="6" bordercolor="#EBECEC" ><div align="center">

                    <!--==============================================================================  -->		    
                    <!--============================Div que se clona =================================  -->  
                    <!--==============================================================================  -->
                    <div id="body">
	
	<div class="table-responsive">
  <table class="table" id='tabla'> 
                        <h3>Registrar Factura <input type="button"  class="a" id="agregar" value="+" /></h3>

                </div></td>
        </tr>
        </tr>
        <tr>
            <td height="10" bordercolor="#EBECEC" ><div align="right"><h6>Per&iacute;odo:</h6></div></td>
            <td width="25" bordercolor="#EBECEC" ><input  id="periodo" name="periodo[]" type="number" min="2000" max="2050" size="4" required="required" maxlength="4"  required pattern="[0-9]{4}"/></td>
            
            <td height="50" bordercolor="#EBECEC" ><div align="right"><h6>Mes:</h6></div></td>
            <td width="247" bordercolor="#EBECEC" ><select id="mes1" name="mes1[]"  required>
                   <option value=''>Mes</option>
                    <option value='1'>Ene</option>
                    <option value='2'>Feb</option>
                    <option value='3'>Mar</option>
                    <option value='4'>Abr</option>
                    <option value='5'>May</option>
                    <option value='6'>Jun</option>
                    <option value='7'>Jul</option>
                    <option value='8'>Ago</option>
                    <option value='9'>Sep</option>
                    <option value='10'>Oct</option>
                    <option value='11'>Nov</option>
                    <option value='12'>Dic</option>
                </select></td>
            <td width="180" height="71" bordercolor="#EBECEC" ><div align="right"><h6>N.Fac.</h6></div></td>
            <td width="61" bordercolor="#EBECEC"  ><div id='resultado'><input   id="f_numero" name="f_numero[]" type="text"  value="" size="6" required="required" maxlength="12" required pattern="[a-zA-Z0-9]{3,18}" 
            title='Campo Alfanumerico (Sin Guiones)'></td></div>
            <td width="60" bordercolor="#EBECEC" ><div align="right"><h6>Monto</h6> </div></td>
            <td width="86" bordercolor="#EBECEC" ><input  id="f_monto" name="f_monto[]" type="text" onkeyup="format(this)" onchange="format(this)" value="" size="10" maxlength="15" required="required" placeholder = "Ej: 0.00" required pattern="[0-9]{2,18}[.]{1}[0-9]{2}"  title='Expresar los montos con punto y dos cifras Decimales (Ej:1.00)'/></div></td>
            <td width="270" bordercolor="#EBECEC" ><div align="right"><h6>Fec.Fac.</h6></div></td>      

            <td width="280" bordercolor="#EBECEC" ><select id="anio" name="anio[]"  required><option value=''>A&ntilde;o</option>
                    <?php
                    for ($anio = (date("Y")); 2010 <= $anio; $anio--) {
                        echo "<option value='$anio'>" . $anio . "</option>";
                    }
                    ?>
                </select></td>
            <td width="280" bordercolor="#EBECEC" ><select id="mes" name="mes[]"  required>
                   
                    <option value=''>Mes</option>
                    <option value='01'>Ene</option>
                    <option value='02'>Feb</option>
                    <option value='03'>Mar</option>
                    <option value='04'>Abr</option>
                    <option value='05'>May</option>
                    <option value='06'>Jun</option>
                    <option value='07'>Jul</option>
                    <option value='08'>Ago</option>
                    <option value='09'>Sep</option>
                    <option value='10'>Oct</option>
                    <option value='11'>Nov</option>
                    <option value='12'>Dic</option>
                </select></td>
            <td width="210" bordercolor="#EBECEC" ><select id="dia" name="dia[]"  required>
                    
                    <option value=''>Dia</option>
                    <option value='01'>01</option>
                    <option value='02'>02</option>
                    <option value='03'>03</option>
                    <option value='04'>04</option>
                    <option value='05'>05</option>
                    <option value='06'>06</option>
                    <option value='07'>07</option>
                    <option value='08'>08</option>
                    <option value='09'>09</option>
                    <option value='10'>10</option>
                    <option value='11'>11</option>
                    <option value='12'>12</option>
                    <option value='13'>13</option>
                    <option value='14'>14</option>
                    <option value='15'>15</option>
                    <option value='16'>16</option>
                    <option value='17'>17</option>
                    <option value='18'>18</option>
                    <option value='19'>19</option>
                    <option value='20'>20</option>
                    <option value='21'>21</option>
                    <option value='22'>22</option>
                    <option value='23'>23</option>
                    <option value='24'>24</option>
                    <option value='25'>25</option>
                    <option value='26'>26</option>
                    <option value='27'>27</option>
                    <option value='28'>28</option>
                    <option value='29'>29</option>
                    <option value='30'>30</option>
                    <option value='31'>31</option>
                </select></td>
            <td width="85" bordercolor="#EBECEC" ><div align="right"><h6>Observaci&oacute;n:</h6> </div></td>
            <td width="144" bordercolor="#EBECEC" ><input  id="observacion" name="observacion[]" type="text" value="" size="12"  maxlength="60" required /></td>
        </tr>
        <table>
            <table>
                <tr>
                    <td height="55" colspan="6" align="center" bgcolor="#fff"><div align="right">
                            <p>&nbsp;</p>
                            <p>
                                <button type="button" class="btn btn-primary" id="myBtn">Gestionar</button>
                            </p>
                            <p></p>
                        </div></td>
                </tr>
            </table>
        </table>


</div>
</div>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">  
</head>
<body>
 
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Confirmar...</h2>
        </div>
        <div class="modal-body">
          <p>Esta seguro que desea registrar la(s) Factura(s)?</p>
        </div>
        <div class="modal-footer">
            <?php
$atributosSubmit = array('class' => 'btn btn-primary');
echo form_submit($atributosSubmit, 'Gestionar')
?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
      
    </div>
  </div>

<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal("toggle");
    });
});
</script>

</body>
</html>

<script>
    $(function () {
        $("#tabs").tabs();
    });
    $(function () {
// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
        $("#agregar").on('click', function () {
            $("#tabla tbody tr:eq()").clone().find("input:text").val("").end().append('<td class="eliminar"><input class="a" type="button" value="-"/></td>').appendTo("#tabla");
           
        });
        
// Evento que selecciona la fila y la elimina
        $(document).on("click", ".eliminar", function () {
            var parent = $(this).parent();
            $(parent).remove();
        });
    });

 function delRow() {
// Funcion que destruye el elemento actual una vez echo el click
        $(this).parent('div').remove();

 }
</script>


<script>
    $(document).on("change", '#proveedores', function ()
    {
        

        $("#cuenta_contrato").load("<?php echo base_url() . 'index.php/facturacontroler/consultar_cuenta_contrato?id_proveedor='; ?>" + $(this).val());
        

        $.ajax({
            url: "<?php echo base_url() . 'index.php/facturacontroler/consultar_datos_proveedor'; ?>",
            data: {id_proveedor: $(this).val()},
            dataType: 'html',
            type: 'post',
            success: function (salida) {
                //alert(salida); 
                var datos = salida.split("~");
                //alert(datos[0]);

                $("#cod_proveedor").val(datos[0]);
                $("#descripcion").val(datos[1]);

            }
        });
    });

</script>





<script>
    $(document).on("blur", '#f_numero', function ()
    {
		var campo=$(this);
		//console.log($(this).pattern);
        $.ajax({
             url: "<?php echo base_url() . 'index.php/facturacontroler/consultar_factura'; ?>",
            data: {id_proveedor: $('#proveedores').val(), f_numero: $(this).val()},
            dataType: 'html',
            type: 'post',
            success: function (salida) {
                //alert(salida); 
                //var datos = salida.split("~");
                //alert(datos[0]);
				if(salida==1)
				{
					alert("La Factura ya existe.....!");
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









<?php echo form_close() ?>
