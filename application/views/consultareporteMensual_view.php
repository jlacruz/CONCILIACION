
<?php
//print_r($lista_proveedores);
$datestring = "%Y-%m-%d  ";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('reporteMensual/consulta_movimiento', $attributes)
?>

<?php
$nom_empresa = array(
    'name' => 'nom_empresa',
    'id' => 'nom_empresa',
    'maxlength' => '50',
    'size' => '18',
    'type' => 'text',
    'required' => 'required',
    'class' => 'form-control',
    'onkeyup' => 'javascript:this.value=this.value.toUpperCase()',
    'autocomplete' => 'off'
);

/* $periodo = array(
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
  ); */
?>

<div id="body">

<div class="table-responsive">
<table class="table">
    <tr>
        <td height="54" colspan="5" bgcolor="#EBECEC"><h2 align="center">Estado de Cuenta Mensual</h2></td>
    </tr>
    <tr>
        <td height="27" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td width="16%" height="63" bordercolor="#EBECEC" > <div align="right">Proveedor: </div></td>
        <td width="36%" bordercolor="#EBECEC" >
            <select name="proveedores" id="proveedores" class="form-control" required="required">
                <option value="0">...SELECCIONE ...</option>';
                <?php
                foreach ($lista_proveedores as $i => $proveedores) {
                    echo '<option value="' . $proveedores[1] . '">' . $proveedores[0] . '</option>';
                }
                ?>
            </select></div></td>
        <td width="22%" bordercolor="#EBECEC" ><div align="right">Per&iacute;odo: </div></td>
        <td width="26%" bordercolor="#EBECEC" ><div align="left" ><input type="number" name="periodo" min="2015" id="periodo" class="form-control" required="required"</div></td>

    </tr>
    <tr>
        <td width="16%" height="63" bordercolor="#EBECEC" > <div align="right">Desde: </div></td>
        <td width="36%" bordercolor="#EBECEC" >
            <select id="mes1" name="mes1[]"  class="form-control" required="required">
                <option value=''>Mes Inicial</option>
                <option value='1'>Enero</option>
                <option value='2'>Febrero</option>
                <option value='3'>Marzo</option>
                <option value='4'>Abril</option>
                <option value='5'>Mayo</option>
                <option value='6'>Junio</option>
                <option value='7'>Julio</option>
                <option value='8'>Agosto</option>
                <option value='9'>Septiembre</option>
                <option value='10'>Octubre</option>
                <option value='11'>Noviembre</option>
                <option value='12'>Diciembre</option>
            </select></div></td>
        <td width="16%" height="63" bordercolor="#EBECEC" > <div align="right">Hasta: </div></td>
        <td width="36%" bordercolor="#EBECEC" >
            <select id="mes2" name="mes2[]"  class="form-control" required="required">
                <option value=''>Mes Final</option>
                <option value='1'>Enero</option>
                <option value='2'>Febrero</option>
                <option value='3'>Marzo</option>
                <option value='4'>Abril</option>
                <option value='5'>Mayo</option>
                <option value='6'>Junio</option>
                <option value='7'>Julio</option>
                <option value='8'>Agosto</option>
                <option value='9'>Septiembre</option>
                <option value='10'>Octubre</option>
                <option value='11'>Noviembre</option>
                <option value='12'>Diciembre</option>
            </select></div></td>
    </tr>
    <tr>
        <td height="87" colspan="5" bordercolor="#EBECEC"  ><div align="center">

    <table>
    <tr>
    <td height="55" colspan="6" align="center" bgcolor="#fff"><div align="right">
            <p>&nbsp;</p>
            <p>

                <input value='Buscar' class='btn btn-primary' type='button' name='buscar' id='buscar' />
            </p>
            <p></p>
        </div></td>
    </tr>
    </table>
</table>

<div id='resultado'>

        </div>
    </div></div></div></div</div></div>

<script>
    /* ================================ FUNCION PARA BLOQUEAR ENTER ================================*/
    $('form').keypress(function (e)
    {
        if (e.which == 13)
            return false;
    });

</script>


<script>
    /* ======== EVENTO ON CLIC AJAX PARA BUSQUEDAS Y RESPUESTA EN LA MISMA PAGINA ===================*/
    $(document).on("click", '#buscar', function ()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/reporteMensual/consulta_movimiento'; ?>",
            data: {id_proveedor: $('#proveedores').val(), periodo: $('#periodo').val(), mes1: $('#mes1').val(), mes2: $('#mes2').val()},
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

