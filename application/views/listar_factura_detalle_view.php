<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<?php
if ($resultados[0][0] != "") {
    $contenido = "";
    foreach ($resultados as $resultado) {

        $contenido.="<tr>  
       
      <td>" . $resultado[2] . "</td>
      <td>" . $resultado[4] . "</td>
      <td>" . $resultado[5] . "</td>
      <td>" . $resultado[7] . "</td>
      <td>" . $resultado[8] . "</td>
      <td>" . $resultado[13] . "</td>
      <td><a href='" . base_url() . "index.php/consulta_factura_controler/MostrarDetalle?proveedores=". $proveedores ."&periodo=". $resultado[9] ."&f_numero=". $resultado[4] ."'> 
      <button type='button' class='btn btn-default'>
      <span class='glyphicon glyphicon-search'></span>
      </button></a>
              </td>				  
</tr>";
    }
} else {
    $contenido = '
					
    </div>

    <div class="alert alert-danger">
    <strong>No se Encontraron datos para esta busquedad!</strong>
    <a class="alert-link" href="gestion_factura">Volver a consultar</a>

    </div>';
}
?>


<div id="body">
    <div id='table-responsive' class="table-responsive">
        <script>
            $(document).ready(function ()
            {
                $("div#pagination a").click(function ()
                {
                    var por_pagina = $(this).attr('id');

                    $('#table-responsive').html('<div><img src="<?php echo base_url() . APPPATH ?>/imagenes/ajax-loader.gif"/></div>');

                    //alert(a_href);
                    $.ajax({
                        type: "GET",
                         url: 'buscarDatos/' + por_pagina + '?proveedores=' + encodeURIComponent('<?php echo $proveedores; ?>') + '&periodo=' + encodeURIComponent('<?php echo $periodo; ?>') + '&f_numero=' + encodeURIComponent('<?php echo $f_numero; ?>'),

                        success: function (html) {
                            $("#table-responsive").html(html);
                        }
                    });
                });
                //return false;
                //};  
            });
        </script>
        <table class="table table-hover">
            <tr>
                <td class="active" colspan="7" align="center"><h4>Listado de Facturas: 
                <?php if ($resultados[0][0] == ""){
					echo "El Proveedor NO posee facturas para este Per&iacute;odo";
					}else{
						echo  $resultado[0];
						}	
					
					  ?></h4></td>
            </tr>
            <tr>
                <td class="active" colspan="7" align="center"><h4>Per&iacute;odo: 
                <?php if ($resultados[0][0] == ""){
					echo "Sin Facturar";
					}else{
						echo  $resultado[9];
						}	
					
					  ?></h4></td>
            </tr>
            <tr>
                <td class="active" align="center"><strong>Cuenta Contrato</strong></td>
                <td class="active" align="center"><strong>Nro de Factura</strong></td>
                <td class="active" align="center"><strong>Monto</strong></td>
                <td class="active" align="center"><strong>Fecha de Carga</strong></td>
                <td class="active" align="center"><strong>Fecha de Factura</strong></td>
                <td class="active" align="center"><strong>Mes</strong></td>
                <td class="active" align="center"><strong>Detalle</strong></td> 
          
            </tr>

          
<?php
echo $contenido;
?>
        </table>
        <p align="center"><a href="<?php echo base_url() ?>index.php/consulta_factura_controler/gestion_factura" ><button type="button" class="btn btn-primary" align="center">Regresar</button></a></p>
        
        <div id="pagination"><?= $this->pagination->create_links(); ?></div>
    </div> </div> </div> </div>


