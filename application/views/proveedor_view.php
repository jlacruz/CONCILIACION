<?php
//print_r($lista_estados);
//print_r($lista_servicio);
//print_r($lista_ciudad);
$datestring = " %Y-%m-%d";
$attributes = array('class' => '', 'id' => '');

echo form_open('proveedorcontroler/insertar_proveedor', $attributes)
?>
<?php
// $id_servicio = array(
//     'name' => 'id_servicio',
//     'id' => 'id_servicio',
//     'maxlength' => '10',
//     'size' => '10',
//     'type' => 'int',
//     'placeholder' => 'select',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//    // 'value' => $v_id_servicio,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );

// $rif = array(
//     'name' => 'rif',
//     'id' => 'rif',
//     'maxlength' => '14',
//     'size' => '14',
//     'type' => 'text',
//     'placeholder' => 'J-G 000000000',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'required pattern'=>'[-J,-G]{1}[0-9]{9}',
//     'title'=>'J-G 000000000 (Sin Guiones)',
//     'class' => 'form-control',
//    // 'value' => $v_rif,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );
// $estado = array(
//     'name' => 'estado',
//     'id' => 'estado',
//     'maxlength' => '50',
//     'size' => '10',
//     'type' => 'text',
//     'placeholder' => 'Estado',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//    // 'value' => $v_estado,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );
// $ciudad = array(
//     'name' => 'ciudad',
//     'id' => 'ciudad',
//     'maxlength' => '50',
//     'size' => '10',
//     'type' => 'text',
//     'placeholder' => 'Ciudad',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//    // 'value' => $v_ciudad,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );
// $direccion = array(
//     'name' => 'direccion',
//     'id' => 'direccion',
//     'maxlength' => '100',
//     'size' => '20',
//     'type' => 'text',
//     'placeholder' => 'Direcci&oacute;n',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//    // 'value' => $v_direccion,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );
// $persona_contacto = array(
//     'name' => 'persona_contacto ',
//     'id' => 'persona_contacto ',
//     'maxlength' => '50',
//     'size' => '18',
//     'type' => 'text',
//     'placeholder' => 'Persona de Contacto ',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//     'required pattern'=>'[A-Z\s]{3,25}',
//    // 'value' => $v_persona_contacto,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );

// $telefono = array(
//     'name' => 'telefono',
//     'id' => 'telefono',
//     'maxlength' => '50',
//     'size' => '14',
//     'type' => 'text',
//     'placeholder' => 'Telefono ',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//     'required pattern'=>'[0-9]{10,12}',
//     'title'=>'Numero Telefonico sin caracteres especiales',
//    // 'value' => $v_telefono,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );
// $telefono2 = array(
//     'name' => 'telefono2',
//     'id' => 'telefono',
//     'maxlength' => '50',
//     'size' => '14',
//     'type' => 'text',
//     'placeholder' => 'Telefono ',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//     'required pattern'=>'[0-9]{10,12}',
//     'title'=>'Numero Telefonico sin caracteres especiales',
//    // 'value' => $v_telefono,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );
// $correo = array(
//     'name' => 'correo',
//     'id' => 'correo',
//     'maxlength' => '100',
//     'size' => '20',
//     'type' => 'email',
//     'placeholder' => 'Correo@gmail.com',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//     //'value' => $v_correo,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );

// $fecha = array(
//     'name' => 'fecha',
//     'id' => 'fecha',
//     'maxlength' => '50',
//     'size' => '18',
//     'type' => 'date',
//     'placeholder' => '...select....',
//     'required' => 'required',
//     'autocomplete' => 'off',
//     'class' => 'form-control',
//     //'value' => $v_fecha,
//     'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
// );
?>


<div id="body">
	
	<div class="table-responsive">
 <table width="562" class="table">
        <tr>
            <td colspan="6" bgcolor="#EBECEC"><h2 align="center">Registrar  Proveedores  </h2></td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td width="21%" height="39" ><div align="right">Nombre de la Empresa: </div></td>
            <td width="19%" ><div align="left"><div id='resultado'> <input type="text" class="form-control" id="nom_empresa" name="nom_empresa" placeholder="Nombre de la Empresa"
            maxlength = "50" size="18" required pattern="[a-zA-Z0-9\s\.]{3,25}" required="required" onkeyup="javascript:this.value=this.value.toUpperCase()"></div></div></td>
            <td width="8%" ><div align="right">Rif:</div></td>
            <td width="20%" ><div align="left"><input type="text" class="form-control" id="rif" name="rif" placeholder="J-G 000000000" required="required"
            maxlength = "14" size="14" title="J-G 000000000 (Sin Guiones)" required pattern="[-J,-G]{1}[0-9]{9}" onkeyup="javascript:this.value=this.value.toUpperCase()"></div></td>
            <td width="9%" ><div align="right">Direcci&oacute;n: </div></td>
            <td width="23%" ><div align="left"><input type="text" class="form-control" required="required" id="direccion" name="direccion" placeholder="Direcci&oacute;n"
            maxlength = "100" size="20" onkeyup="javascript:this.value=this.value.toUpperCase()"></div></td>
        </tr>
    

        <tr>
            <td height="39"><div align="right">Estado:</div></td>
            <td>
                <div align="left">
                    <select name="estados" id="estados" required class="form-control"><option value="">seleccione...</option>
                        <?php
                        
                        foreach ($lista_estados as $i => $estados) {
                            echo '<option value="' . $estados[1] . '">' . $estados[0] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </td>
            <td><div align="right">Ciudad: </div></td>
            <td><div id="ciudad"></div></td>

            <td><div align="right">Correo:</div></td>
            <td><div align="left"><input type="email" class="form-control" id="correo" name="correo" placeholder="Correo@gmail.com"
            maxlength = "100" size="20" required onkeyup="javascript:this.value=this.value.toUpperCase()"></div></td>
        </tr>

        <tr>
            <td height="40" ><div align="right">Persona Contacto:</div></td>
            <td ><div align="left"><input type="text" class="form-control" id="persona_contacto_" name="persona_contacto_" placeholder="Persona de Contacto"
            maxlength = "50" size="18" required pattern="[A-Z\s]{3,25}" onkeyup="javascript:this.value=this.value.toUpperCase()"></div></td>




            <td ><div align="right">Tel&eacute;fono:</div></td>
            <td ><div align="left"><input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono"
            maxlength = "50" size="14" required pattern="[0-9]{10,12}" title="Numero Telefonico sin caracteres especiales" onkeyup="javascript:this.value=this.value.toUpperCase()"></div></td>





            <td ><div align="right">Tel&eacute;fono:</div></td>
            <td ><div align="left"><input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="Telefono"
            maxlength = "50" size="14" required pattern="[0-9]{10,12}" title="Numero Telefonico sin caracteres especiales" onkeyup="javascript:this.value=this.value.toUpperCase()"> </div></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td height="39"><div align="right">Servicio:</div></td>
            <td>

                <div align="left">
                    <select name="id_servicio" class="form-control" required><option value="">seleccione...</option>
<?php

foreach ($lista_servicio as $i => $servicio) {
	
    echo '<option value="' . $servicio[1] . '">' . $servicio[0] . '</option>';
}
?>
                    </select>
                </div></td>
            <td><div align="right">Fecha:</div></td>
            <td><div align="left"> <input type="fecha" name="fecha" class ="form-control" readonly="readonly" value=" <?php echo mdate($datestring) ?>" /> </div></td>
        </tr>
        <tr>
            <td height="24" >&nbsp;</td>
            <td colspan="5" >&nbsp;</td>
        </tr>  
        <tr>
            <td height="55" colspan="6" align="center" > 
                <div align="center">
<button type="button" class="btn btn-primary" id="myBtn">Registrar</button> 
                </div></td>
        </tr>
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
          <p>Esta seguro que desea registrar un nuevo Proveedor?</p>
        </div>
        <div class="modal-footer">
            <?php
$atributosSubmit = array('class' => 'btn btn-primary');
echo form_submit($atributosSubmit, 'Registrar')
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
//============================================================================================================================================    
//================================= script para clonar campos ================================================================================
//============================================================================================================================================ 
    $(document).ready(function () {
        //ACA le asigno el evento click a cada boton de la clase bt_plus y llamo a la funcion addField
        $(".bt_plus").each(function (el) {
            $(this).bind("click", addField);
        });
    });


    function addField() {
// ID del elemento div quitandole la palabra "div_" de delante. Pasi asi poder aumentar el número. Esta parte no es necesaria pero yo la utilizaba ya que cada campo de mi formulario tenia un autosuggest , así que dejo como seria por si a alguien le hace falta.

        var clickID = parseInt($(this).parent('div').attr('id').replace('div_', ''));

// Genero el nuevo numero id
        var newID = (clickID + 1);

// Creo un clon del elemento div que contiene los campos de texto
        $newClone = $('#div_' + clickID).clone(true);

//Le asigno el nuevo numero id
        $newClone.attr("id", 'div_' + newID);

//Asigno nuevo id al primer campo input dentro del div y le borro cualquier valor que tenga asi no copia lo ultimo que hayas escrito.(igual que antes no es necesario tener un id)
        $newClone.children("input").eq(0).attr("id", 'cuenta_contrato' + newID).val('');

        $newClone.children("input").eq(1).attr("id", newID)

//Inserto el div clonado y modificado despues del div original
        $newClone.insertAfter($('#div_' + clickID));
        //alert(clickID);
//Cambio el signo "+" por el signo "-" y le quito el evento addfield
        $("#" + clickID).val('-').unbind("click", addField);

//Ahora le asigno el evento delRow para que borre la fial en caso de hacer click
        $("#" + clickID).bind("click", delRow);

    }


    function delRow() {
// Funcion que destruye el elemento actual una vez echo el click
        $(this).parent('div').remove();



    }

</script>


<script>
//============================================================================================================================================    
//================================= script para obtener la Ciudad ============================================================================
//============================================================================================================================================     
    $(document).on("change", '#estados', function ()
    {
        //alert("<?php echo base_url() . 'index.php/proveedorcontroler/obtenerCiudad?id_estado='; ?>"+$(this).val());

        $("#ciudad").load("<?php echo base_url() . 'index.php/proveedorcontroler/obtenerCiudad?id_estado='; ?>" + $(this).val());
    });



</script>


<script>
    $(document).on("blur", '#nom_empresa', function ()
    {
		var campo=$(this);
		//console.log($(this).pattern);
        $.ajax({
             url: "<?php echo base_url() . 'index.php/proveedorcontroler/consultar_proveedor'; ?>",
            data: { nom_empresa: $(this).val()},
            dataType: 'html',
            type: 'post',
            success: function (salida) {
                //alert(salida); 
                //var datos = salida.split("~");
                //alert(datos[0]);
				if(salida==1)
				{
					alert("Este Proveedor ya se Encuentra Registrado....!");
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


