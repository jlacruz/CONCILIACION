<script>
        $(document).ready(function()
        {
                $("div#pagination a").click(function()
                {
                        //alert($(this).attr('id'));
                        var por_pagina = $(this).attr('id');
                        
                        $('#table-responsive').html('<div><img src="<?php echo base_url() .APPPATH?>/imagenes/ajax-loader.gif"/></div>');
                        
                                   //alert(a_href);
                                   $.ajax({
                                         type: "GET",

                                    url: 'buscarDatosproveedor/'+por_pagina,
                                        
                                         success: function(html){
                                          $("#table-responsive").html(html);//es la pantalla donde cargara todoo, como el template
                                          }
                                   });              
                                 });            
                   //return false;
                 //};  
        });
</script>


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
      <td>" . $resultado[3] . "</td>
      <td>" . $resultado[4] . "</td>
      <td>" . $resultado[5] . "</td>
     
       	    
</tr>";
    }
} else {
    $contenido = '
					
</div>

<div class="alert alert-danger">
<strong>No se Encontraron datos para esta busquedad!</strong>
<a class="alert-link" href="#">Volver a consultar.</a>

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
                        //url: 'buscarDatos/' + por_pagina + '?unidad=' + encodeURIComponent('<?php echo $unidad; ?>'),
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
                <td class="active" colspan="6" align="center"><h3><strong>Proveedores</strong></h3></td>
            </tr>
            <tr>
                
                <td class="active" align="center"><strong>Nombre de la Empresa</strong></td>
                <td class="active" align="center"><strong>C&oacute;digo</strong></td>
                <td class="active" align="center"><strong>Servicio</strong></td>
                <td class="active" align="center"><strong>Persona Contacto</strong></td>
                <td class="active" align="center"><strong>Tel&eacute;fono</strong></td>
                <td class="active" align="center"><strong>Tel&eacute;fono</strong></td>
                
               
            <?php
            echo $contenido;
            ?>
                 </table>
 <p align="center"><a href="<?php echo base_url() ?>index.php/consulproveedorcontroler/consulta" ><button type="button" class="btn btn-primary" align="center">Regresar</button></a></p>               
        </table>
        <div id="pagination"><?= $this->pagination->create_links(); ?></div>
    </div>
</div></div></div></div></div></div></div></div></div>



<!--<script>
        $(document).ready(function()
        {
                $("div#pagination a").click(function()
                {
                        //alert($(this).attr('id'));
                        var por_pagina = $(this).attr('id');
                        
                        $('#table-responsive').html('<div><img src="<?php echo base_url() .APPPATH?>/imagenes/ajax-loader.gif"/></div>');
                        
                                   //alert(a_href);
                                   $.aja{
                                         type: "GET",

                                    url: 'listarJubilados/'+por_pagina+'?idEstado='+encodeURIComponent('<?php echo $idestado;?>')+'&idMunicipio='+encodeURIComponent('<?php echo $idmunicipio;?>')+'&nombEstado='+encodeURIComponent('<?php echo $estado;?>')+'&desMunicipio='+encodeURIComponent('<?php echo $municipio;?>'),
                                        
                                         success: function(html){
                                          $("#container").html(html);//es la pantalla donde cargara todoo, como el template
                                          }
                                   });              
                                 });            
                   //return false;
                 //};  
        });
</script> -->
