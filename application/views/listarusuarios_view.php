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

                                    url: 'buscarDatos/'+por_pagina,
                                    
  /*url: 'listarJubilados/'+por_pagina+'?idEstado='+encodeURIComponent('<?php echo $idestado;?>')+'&idMunicipio='+encodeURIComponent('<?php echo $idmunicipio;?>')+'&nombEstado='+encodeURIComponent('<?php echo $estado;?>')+'&desMunicipio='+encodeURIComponent('<?php echo $municipio;?>'),*/                                  
                                    
                                    
                                        
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
      <td>" . $resultado[4] . "</td>
      <td>" . $resultado[5] . "</td>
      <td>" . $resultado[8] . "</td>
           
       	    
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
        <table class="table table-hover">
            <tr>
                <td class="active" colspan="6" align="center"><h3><strong>Usuarios del Sistema</strong></h3></td>
            </tr>
            <tr>
                <td class="active" align="center"><strong>C&eacute;dula</strong></td>
                <td class="active" align="center"><strong>Rol</strong></td>
                <td class="active" align="center"><strong>Nombre</strong></td>
                <td class="active" align="center"><strong>Apellido</strong></td>
                <td class="active" align="center"><strong>Usuario</strong></td>
                <td class="active" align="center"><strong>Estatus</strong></td> 
            </tr>
        

            <?php
            echo $contenido;
            ?>
        </table>
        <div id="pagination"><?= $this->pagination->create_links(); ?></div>
        <form id="userForm" method="post" class="form-horizontal" style="display: none;">
    <div class="form-group">
        <label class="col-xs-3 control-label">C&eacute;dula</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="id" disabled="disabled" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Rol</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="name" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Nombre</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="email" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Apellido</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="website" />
        </div>
    </div>
<div class="form-group">
        <label class="col-xs-3 control-label">Estatus</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="website" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-5 col-xs-offset-3">
            <button type="submit" class="btn btn-default">Guardar</button>
        </div>
    </div>
</form>
       



        
    </div>
    
    
    
</div></div></div></div></div></div></div></div></div>



