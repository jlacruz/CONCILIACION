
<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('ordenpagocontroler/insertar_orden', $attributes)
?>
<?php
$numero_documento = array(
    'name' => 'numero_documento',
    'id' => 'numero_documento',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'int',
    'placeholder' => 'Nro del Documento',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

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

$cod_proveedor = array(
    'name' => 'cod_proveedor',
    'id' => 'cod_proveedor',
    'maxlength' => '50',
    'size' => '10',
    'type' => 'int',
    'placeholder' => 'C&oacute;d. Proveedor',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$descripcion = array(/* servicio */
    'name' => 'descripcion',
    'id' => 'descripcion',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'text',
    'placeholder' => 'servicio',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$observacion = array(
    'name' => 'observacion ',
    'id' => 'observacion ',
    'maxlength' => '300',
    'size' => '89',
    'type' => 'text',
    'placeholder' => 'Indique sus observaciones',
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
$o_monto = array(
    'name' => 'o_monto',
    'id' => 'o_monto',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'number',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
/* combo año */
/* for ($anio = (date("Y")); 2011 <= $anio; $anio--) {
  echo "<option value=&#39;" . $anio . "&#39;>" . $anio . "</option>";
  } */
?>

    
<div id="body">
	
	<div class="table-responsive">
  <table class="table">
        <tr>
            <td height="54" colspan="6" bgcolor="#EBECEC"><h2 align="center">Gestionar Orden de Pago</h2></td>
        </tr>
        <tr>
            <td height="27" colspan="6">&nbsp;</td>
        </tr>
        <tr>
          <td width="14%" height="41" bordercolor="#EBECEC" > <div align="right">Proveedor: </div></td>
            <td width="23%" bordercolor="#EBECEC" ><select name="proveedores" id="proveedores" class="form-control" required="required">
                     <option value="0">...SELECCIONE ...</option>';
                    <?php
                    foreach ($lista_proveedores as $i => $proveedores) {
                        echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
                    }
                    ?>
          </select></div></td>
          <td width="12%" bordercolor="#EBECEC" ><div align="right">C&oacute;d. Proveedor: </div></td>
            <td width="12%" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($cod_proveedor) ?></div></td>
            <td width="11%" bordercolor="#EBECEC" ><div align="right">Servicio:</div></td>
            <td width="28%" bordercolor="#EBECEC"  ><div align="left" ><?php echo form_input($descripcion) ?></div></td>
        </tr>
        <tr>
            <td height="39" bordercolor="#EBECEC"><div align="right">Fecha de carga:</div></td>
            <td bordercolor="#EBECEC"><div align="left">
                    <?php echo mdate($datestring) ?>
                </div></td>
            <td bordercolor="#EBECEC">&nbsp;</td>
            <td bordercolor="#EBECEC">&nbsp;</td>
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
                        <h3 >Registrar Orden de Pago <input type="button"  class="a" id="agregar" value="+" /></h3>

                </div></td>
        </tr>
        </tr>
        <tr>
            <td height="71" bordercolor="#EBECEC" ><div align="right">Per&iacute;odo:</div></td>
            <td width="25" bordercolor="#EBECEC" ><input  id="periodo" name="periodo[]" type="text" size="4" required="required" maxlength="4"  required pattern="[0-9]{4}"/></td>
            <td width="180" height="71" bordercolor="#EBECEC" ><div align="right"><h6>N. Orden:</h6></div></td>
             <td width="61" bordercolor="#EBECEC"  ><div id='resultado'><input  id="o_numero" name="o_numero[]" type="text" size="7" maxlength="10"  required="required" onkeyup ="javascript:this.value=this.value.toUpperCase()" required pattern="[a-zA-Z0-9]{3,18}" title='Campo Alfanumerico (Sin Guiones)'></td>
            </div>
            <td width="78" bordercolor="#EBECEC" ><div align="right"><h6>Monto: </h6></div></td>
            <td width="86" bordercolor="#EBECEC" ><input  id="o_monto" name="o_monto[]" type="text" size="10" required="required" maxlength="15" placeholder = "Ej: 0.00" required pattern="[0-9]{2,18}.[0-9]{2}"  title='Expresar los montos con punto y dos cifras Decimales (Ej:1.00)' /></div></td>
            <td width="300" bordercolor="#EBECEC" ><div align="right"><h6>Fec. Orden:</h6> </div></td>

            <td width="138" bordercolor="#EBECEC"><select id="anio" name="anio[]"  required><option value=''>A&ntilde;o</option>
                    <?php
                    for ($anio = (date("Y")); 2010 <= $anio; $anio--) {
                        echo "<option value='$anio'>" . $anio . "</option>";
                    }
                    ?>
                </select></td>
            <td width="180" bordercolor="#EBECEC" ><select id="mes" name="mes[]"  required>
                    <option value=''>Mes</option>
                    <option value='01'>Ene</option>
                    <option value='02'>Feb</option>
                    <option value='03'>Mar</option>
                    <option value='04'>Abr</option>
                    <option value='05'>May</option>
                    <option value='06'>Jun</option>
                    <option value='07'>Jul</option>
                    <option value='08'>Ago</option>
                    <option value='09'>Sept</option>
                    <option value='10'>Oct</option>
                    <option value='11'>Nov</option>
                    <option value='12'>Dic</option>
                </select></td>
            <td width="100" bordercolor="#EBECEC" ><select id="dia" name="dia[]"  required>
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
            <td width="75" bordercolor="#EBECEC" ><div align="right"><h6>Observaci&oacute;n:</h6> </div></td>
            <td width="120" bordercolor="#EBECEC" ><input  id="observacion" name="observacion[]" type="text" required="required" size="18"  maxlength="60"/></td>
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
          <p>Esta seguro que desa registrar la(s) Orden(es) de Pago?</p>
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
$(function() {
$( "#tabs" ).tabs();
});
$(function(){
// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
$("#agregar").on('click', function(){
 $("#tabla tbody tr:eq()").clone().find("input:text").val("").end().append('<td class="eliminar"><input class="a" type="button" value="-"/></td>').appendTo("#tabla");
});
// Evento que selecciona la fila y la elimina
$(document).on("click",".eliminar",function(){
var parent = $(this).parent();
$(parent).remove();
});
});
</script>

<script>
    $(document).on("change", '#proveedores', function ()
    {
        //alert("<?php echo base_url() . 'index.php/ordenpagocontroler/consultar_cuenta_contrato?id_proveedor='; ?>"+$(this).val());

        $("#cuenta_contrato").load("<?php echo base_url() . 'index.php/ordenpagocontroler/consultar_cuenta_contrato?id_proveedor='; ?>" + $(this).val());
        
        $.ajax({
        url:"<?php echo base_url() . 'index.php/ordenpagocontroler/consultar_datos_proveedor'; ?>", 
        data: {id_proveedor: $(this).val()},
        dataType: 'html',
        type: 'post',
        success: function(salida) {
                    //alert(salida); 
                    var datos=salida.split("~");
                    //alert(datos[0]);

                     $("#cod_proveedor").val(datos[0]);
                     $("#descripcion").val(datos[1]);
                 }
        });
        
 
        
    });
     
    
    
</script>

<script>
    $(document).on("blur", '#o_numero', function ()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/ordenpagocontroler/consultar_orden'; ?>",
            data: {id_proveedor: $('#proveedores').val(), o_numero: $('#o_numero').val()},
            dataType: 'html',
            type: 'post',
            success: function (salida) {
                //alert(salida); 
                //var datos = salida.split("~");
                //alert(datos[0]);

                $("#resultado").html(salida);
           
        }
        });



    });

</script>



<?php echo form_close() ?>
