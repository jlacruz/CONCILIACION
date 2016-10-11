<?php
//print_r($lista_estados);
//print_r($lista_servicio);
//print_r($lista_ciudad);
$datestring = " %Y-%m-%d";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('cuentacontratocontroler/insertar_cuentacontrato', $attributes)
?>
<?php
$nom_empresa = array(
    'name' => 'nom_empresa',
    'id' => 'nom_empresa',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'text',
    'placeholder' => 'Nombre de la Empresa',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$cuenta_contrato = array(
    'name' => 'cuenta_contrato ',
    'id' => 'cuenta_contrato ',
    'maxlength' => '50',
    'size' => '30',
    'type' => 'text',
    'placeholder' => 'Cuenta Contrato',
    'required' => 'required',
    'autocomplete' => 'off',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
$fecha = array(
    'name' => 'fecha ',
    'id' => 'fecha ',
    'maxlength' => '50',
    'size' => '12',
    'type' => 'int',
    'placeholder' => '...select....',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
?>
<div id="body">

    <div class="table-responsive">
        <table class="table">
            <tr>
                <td colspan="6" bgcolor="#EBECEC"><h2 align="center">Registrar Cuenta Contrato </h2></td>
            </tr>
            <tr>
                <td width="171">&nbsp;</td>
                <td width="251">&nbsp;</td>
            </tr>
            <tr>
                <td height="30" ><div align="right" bgcolor="#EBECEC">Nombre de la Empresa: </div></td>
                <td><select name="proveedores" id="proveedores" required class="form-control" required><option value="">Seleccione... </option>
                        <?php
                        foreach ($lista_proveedores as $i => $proveedores) {
                            echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
                        }
                        ?>
                    </select></td>
                <td width="98" ><div align="right" bgcolor="#EBECEC">Fecha:</div></td>
                <td width="221" ><div align="left" bgcolor="#EBECEC">
                        <?php echo mdate($datestring) ?>
                    </div></td>
            </tr>
            <tr>
                <td width="171" height="98" bgcolor="#FFFFFF"><div align="right" bgcolor="#FFFFFF">
                        <div align="right">Cuenta Contrato : </div>
                    </div></td>
                <td width="251" bgcolor="#FFFFFF"><div id="cuenta_contrato"  > </div>  
                    <div id="div_1" align="left">
						   <input  type="text"  name="cuenta_contrato[]" class="cuenta_contrato" id="cuenta_contrato" style="width:170px;" placeholder="Cuenta Contrato" required pattern="[0-9]{1,18}" 
						   class="form-control"  title= "Sin caracteres especiales (-)"/>
						   <span style="float:left;padding: 8px 0px 8px 8px;"></span>
					 
                       <input class="bt_plus" id="1" type="button" value="+" /><div class="error_form"></div> 
                       <div id='resultado' style=''>
					   </div>
                    </div>
                    
                </td>
                <td bgcolor="#FFFFFF"><div align="right" >Per&iacute;odo:</div></td>
                <td width="221" ><div align="left" >
                        <?php echo mdate($anio) ?>
                    </div></td>
            </tr>


            <tr>
                <td height="45" colspan="4" ><div align="center">
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

                <!--============================ Modal content =======================================-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Confirmar...</h2>
                    </div>
                    <div class="modal-body">
                        <p>Esta seguro que desea registrar una nueva Cuenta Contrato?</p>
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
            $(document).ready(function () {
                $("#myBtn").click(function () {
                    $("#myModal").modal("toggle");
                });
            });
        </script>

    </body>
</html>
<!--====================================================================================================================================================================================================================-->
<!--=================================================================================== Script para clonar Campos =======================================================================================================-->
<!--====================================================================================================================================================================================================================-->
<script>
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

<!--====================================================================================================================================================================================================================-->
<!--============================================================================= Funcion para obtener la Ciudad =======================================================================================================-->
<!--====================================================================================================================================================================================================================-->
<script>
   
            $(document).on("change", '#estados', function ()
    {
        //alert($(this).val());

        $("#div_ciudad").load("<?php echo base_url() . 'index.php/proveedorcontroler/obtenerCiudad?id_rol='; ?>" + $('#estados').val());

    });
</script>


<!--====================================================================================================================================================================================================================-->
<!--========================================================================== Funcion para Obtener Cuenta-Contrato ====================================================================================================-->
<!--====================================================================================================================================================================================================================-->
<script>
   
    $(document).on("blur", '.cuenta_contrato', function ()
    {
		var campo=$(this);
		if($("#proveedores").val()!="")
		{
			$.ajax({
            url: "<?php echo base_url() . 'index.php/cuentacontratocontroler/consultar_cuentacontrato'; ?>",
            data: {id_proveedor: $('#proveedores').val(), cuenta_contrato: $(this).val()},
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
                //$("#resultado").html(salida);
                }
            });

		}
		else
		{
			campo.val('');
			return false;
		}
           
        
       


    });

</script>

<?php echo form_close() ?>
