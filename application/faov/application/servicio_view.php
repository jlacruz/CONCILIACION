<?php
//print_r($lista_estados);
//print_r($lista_servicio);
//print_r($lista_ciudad);
$datestring = " %Y-%m-%d";
$anio = date("Y");
$attributes = array('class' => '', 'id' => '');

echo form_open('serviciocontroler/registrar_servicio', $attributes)
?>

<div id="body">
	
	<div class="table-responsive">
  <table class="table">
    <tr>
       <td colspan="6" bgcolor="#EBECEC"><h2 align="center">Registrar Servicio</h2></td>
        </tr>
        <tr>
            <td width="195"><div align="right"></div></td>
            <td width="189"><div align="left"></div></td>
        </tr>
        <tr>
          <td height="49" ><div align="right" bgcolor="#EBECEC">
              <div align="right">Nombre del Servicio: </div>
          </div></td>
            <td colspan="2" >
              
              <div align="left">
                <input type="text" name="descripcion" size="20"   required="required" class="form-control" placeholder="Nombre del Servicio" rule='blank', onkeyup = "this.value=this.value.toUpperCase()" required pattern="[A-Z]{3,18}">
                
            </div></td>
        </tr>


        <tr>
            <td height="45" colspan="3" ><div align="center">
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
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Confirmar...</h2>
        </div>
        <div class="modal-body">
          <p>Esta seguro que desea registrar un nuevo Servicio?</p>
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
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal("toggle");
    });
});
</script>

</body>
</html>



<!--<script type="text/javascript">

function validatePass(campo)  {
    var RegExPattern = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/;
    var errorMessage = 'No debe contener Caracteres Especiales';
    
}

</script>-->


</body>
</html>  


<?php echo form_close() ?>

