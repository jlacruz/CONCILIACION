<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<?php

if ($resultados[0][0] != "") {
    $contenido = "";
      foreach ($resultados as $resultado) {

        $contenido.="<tr>  
       
      <td>" . $resultado[0] . "</td>
      <td>" . $resultado[1] . "</td>
      <td>" . $resultado[2] . "</td>
      				  
</tr>";
    }
} else {
    $contenido = '
					
    </div>

    <div class="alert alert-danger">
    <strong>No se encontraron Datos para esta Busqueda</strong>
    <a class="alert-link" href="cunsultar_sol">Buscar</a>
     
    

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
                         url: 'buscarDatos/' + por_pagina + '?cedula=' + encodeURIComponent('<?php echo $cedula; ?>'),

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
                <td class="active" colspan="3" align="center"><h4><strong>Listado de Solicitudes </strong></h4></td>
          
            </tr>
           
            <tr>
                <td class="active" align="center"><strong>Nombre del Analista</strong></td>
                <td class="active" align="center"><strong>Fecha de la Solicitud</strong></td>
                <td class="active" align="center"><strong>Motivo</strong></td>
                 
          
            </tr>

          
<?php
echo $contenido;
?>
        </table>
        <p align="center"><a href="<?php echo base_url() ?>index.php/emailcontroler/cunsultar_sol"><button type="button" class="btn btn-primary" align="center">Regresar</button></a></p>
        
        <div id="pagination"><?= $this->pagination->create_links(); ?></div>
    </div> </div> </div> </div>


