<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<?php

if ($resultados[0][0] != "") {
    $contenido = "";
    foreach ($resultados as $resultado) {

        $contenido.="<tr>  
       
      <td>" . $resultado[1] . "</td>
      <td>" . $resultado[2] . "</td>
      <td>" . $resultado[4] . "</td>
      <td>" . $resultado[11] . "</td>
      <td>" . $resultado[10] . "</td>
      <td>" . $resultado[13] . "</td>
      <td><a href='" . base_url() . "index.php/consulusercontroler/MostrarDetalle?cedula="."&cedula=". $resultado[1]."'> 
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
    <strong>Usuario No Registrado!</strong>
    <a class="alert-link" href="usuario2">REGISTRAR NUEVO USUARIO</a>
     
    

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
                <td class="active" colspan="7" align="center"><h4><strong>Listado de Usuarios</strong></h4></td>
          
            </tr>
           
            <tr>
                <td class="active" align="center"><strong>Cedula</strong></td>
                <td class="active" align="center"><strong>Nombre</strong></td>
                <td class="active" align="center"><strong>Apellido</strong></td>
                <td class="active" align="center"><strong>Rol</strong></td>
                <td class="active" align="center"><strong>Usuario</strong></td>
                <td class="active" align="center"><strong>Estatus</strong></td>
                <td class="active" align="center"><strong>Detalle</strong></td> 
          
            </tr>

          
<?php
echo $contenido;
?>
        </table>
        <p align="center"><a href="<?php echo base_url() ?>index.php/consulusercontroler/usuario"><button type="button" class="btn btn-primary" align="center">Regresar</button></a></p>
        
        <div id="pagination"><?= $this->pagination->create_links(); ?></div>
    </div> </div> </div> </div>


