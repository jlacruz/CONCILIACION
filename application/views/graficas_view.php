
<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('graficacontroler/consulta_grafica', $attributes)
?>
<?php

$periodo = array(
    'name' => 'periodo',
    'id' => 'periodo',
    'maxlength' => '4',
    'size' => '5',
    'type' => 'number',
    'placeholder' => 'Periodo',
    'required' => 'required',
    'class' => 'form-control',
    'required pattern' => '[0-9]{4}',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);
?>


<div id="body">
	
	<div class="table-responsive">
  <table class="table">
    <tr>
        <td height="54" colspan="5" bgcolor="#EBECEC"><h2 align="center">Graficas de Estado de Cuenta</h2></td>
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
       <!--<td width="22%" bordercolor="#EBECEC" ><div align="right">Periodo: </div></td>
       <td width="26%" bordercolor="#EBECEC" ><div align="left" ><?php echo form_input($periodo) ?></div></td>-->
    </tr>

    <tr>
        <td height="87" colspan="5" bordercolor="#EBECEC"  ><div align="center">

                <table>
                    <tr>
                        <td height="55" colspan="6" align="center" bgcolor="#fff"><div align="right">
                                <p>&nbsp;</p>
                                <p>
                                    <?php $atributosSubmit = array('class' => 'btn btn-primary');
		 				echo form_submit($atributosSubmit,'Graficar')?>
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
            url: "<?php echo base_url() . 'index.php/graficacontroler/consulta_grafica'; ?>",
            data: {id_proveedor: $('#proveedores').val(), periodo: $('#periodo').val()},
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


