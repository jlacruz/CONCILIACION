
<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('consulordencontroler/buscarDatos', $attributes)
?>
<?php
$periodo = array(
    'name' => 'periodo',
    'id' => 'periodo',
    'maxlength' => '4',
    'size' => '5',
    'type' => 'numeric',
    'placeholder' => 'Periodo',
    'required' => 'required',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

$o_numero = array(
    'name' => 'o_numero',
    'id' => 'o_numero',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'Nro Orden.',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
?>


<div id="body">
	
	<div class="table-responsive">
  <table class="table">
    <tr>
        <td height="54" colspan="5" bgcolor="#EBECEC"><h2 align="center">Consultar Orden</h2></td>
    </tr>
    <tr>
        <td height="27" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td width="16%" height="63" bordercolor="#EBECEC" > <div align="right">Proveedor: </div></td>
        <td width="36%" bordercolor="#EBECEC"  >
            <select name="proveedores" id="proveedores" class="form-control" required="required">
                 <option value="">...SELECCIONE ...</option>';
                <?php
                foreach ($lista_proveedores as $i => $proveedores) {
                    echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
                }
                ?>
            </select></div></td>
        <td width="22%" bordercolor="#EBECEC" ><div align="right">Nro. Orden: </div></td>
        <td width="26%" bordercolor="#EBECEC" ><div align="left" ><?php echo form_input($o_numero) ?></div></td>

    </tr>

    <tr>
        <td height="87" colspan="5" bordercolor="#EBECEC"  ><div align="center">

                <table>
                    <tr>
                        <td height="55" colspan="6" align="center" bgcolor="#fff"><div align="right">
                                <p>&nbsp;</p>
                                <p>
                                    <?php $atributosSubmit = array('class' => 'btn btn-primary');
		 				echo form_submit($atributosSubmit,'Buscar')?>
                                </p>
                                <p></p>
                            </div></td>
                    </tr>
                </table>
</table>
    <div id='resultado'>

    </div>
</div>
            </div>


<script>
    //$(document).on("click", '#buscar', function ()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/consulordencontroler/consulta_orden'; ?>",
            data: {id_proveedor: $('#proveedores').val(), o_numero: $('#o_numero').val()},
            dataType: 'html',
            type: 'GET',
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


