
<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('consulfacturacontroler/consultar_factura', $attributes)
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
$f_numero = array(
    'name' => 'f_numero',
    'id' => 'f_numero',
    'maxlength' => '50',
    'size' => '14',
    'type' => 'text',
    'placeholder' => 'Nro Factura.',
    'required' => 'required',
    'class' => 'form-control',
    'autocomplete' => 'off',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()'
);

?>

<div id="body">
	
	<div class="table-responsive">
 <table width="387" class="table">
        <tr>
          <td height="54" colspan="7" bgcolor="#EBECEC"><h2 align="center">Consultar Factura....</h2></td>
        </tr>
        <tr>
            <td height="27" colspan="7">&nbsp;</td>
        </tr>
        <tr>
          <td width="71" height="63" bordercolor="#EBECEC" > <div align="right">Proveedor: </div></td>
          <td width="80" bordercolor="#EBECEC" ><select name="proveedores" id="proveedores" class="form-control" equired="required">
                  <option value="">...SELECCIONE ...</option>';
            <?php
                    foreach ($lista_proveedores as $i => $proveedores) {
                        echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
                    }
                    ?>
          </select></td>
          <td width="55" bordercolor="#EBECEC" ><div align="right">Periodo: </div></td>
          <td width="5" bordercolor="#EBECEC" ><div align="left" ><?php echo form_input($periodo) ?></div></td>
          
          <td width="53" bordercolor="#EBECEC" ><div align="right">Nro. Factura: </div></td>
          <td width="60" bordercolor="#EBECEC" ><div align="left"><?php echo form_input($f_numero) ?></div></td>
        </tr>
        
       
          <td height="87" colspan="7" bordercolor="#EBECEC"  ><div align="center">

                    <table>
                        <tr>
                            <td height="55" colspan="6" align="center" bgcolor="#fff"><div align="right">
                                    <p>&nbsp;</p>
                                    <p>
                                        <?php
                                        $atributosSubmit = array('class' => 'btn btn-primary');
                                        ?>
                                        <input value='Buscar' class='btn btn-primary' type='button' name='buscar' id='buscar' />
                                    </p>
                                    <p></p>
                                </div></td>
                        </tr>
                    </table>
    </table>
    <div id='resultado'>
       
    </div>
</div>
</div></div></div>
<script>
    $(document).on("click", '#buscar', function ()
    {
         $.ajax({
            url: "<?php echo base_url() . 'index.php/consulfacturacontroler/consulta_facturas'; ?>",
            data: {id_proveedor: $('#proveedores').val(),periodo: $('#periodo').val(), f_numero: $('#f_numero').val()},
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
<script>
$(document).on("click", '#proveedores', function ()
    {
        //alert("<?php echo base_url() . 'index.php/consulfacturacontroler/consultar_cuenta_contrato?id_proveedor='; ?>"+$(this).val());

        $("#cuenta_contrato").load("<?php echo base_url() . 'index.php/consulfacturacontroler/consultar_cuenta_contrato?id_proveedor='; ?>" + $(this).val());

        
    });



</script>

<?php echo form_close() ?>
