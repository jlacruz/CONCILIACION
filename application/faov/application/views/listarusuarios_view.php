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
        <script>
$(document).ready(function() {
    $('#userForm')
        .formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'The full name is required'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'The full name can only consist of alphabetical characters'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        },
                        emailAddress: {
                            message: 'The email address is not valid'
                        }
                    }
                },
                website: {
                    validators: {
                        notEmpty: {
                            message: 'The website address is required'
                        },
                        uri: {
                            allowEmptyProtocol: true,
                            message: 'The website address is not valid'
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            // Save the form data via an Ajax request
            e.preventDefault();

            var $form = $(e.target),
                id    = $form.find('[name="id"]').val();

            // The url and method might be different in your application
            $.ajax({
                url: 'http://jsonplaceholder.typicode.com/users/' + id,
                method: 'PUT',
                data: $form.serialize()
            }).success(function(response) {
                // Get the cells
                var $button = $('button[data-id="' + response.id + '"]'),
                    $tr     = $button.closest('tr'),
                    $cells  = $tr.find('td');

                // Update the cell data
                $cells
                    .eq(1).html(response.name).end()
                    .eq(2).html(response.email).end()
                    .eq(3).html(response.website).end();

                // Hide the dialog
                $form.parents('.bootbox').modal('hide');

                // You can inform the user that the data is updated successfully
                // by highlighting the row or showing a message box
                bootbox.alert('The user profile is updated');
            });
        });

    $('.editButton').on('click', function() {
        // Get the record's ID via attribute
        var id = $(this).attr('data-id');

        $.ajax({
            url: 'http://jsonplaceholder.typicode.com/users/' + id,
            method: 'GET'
        }).success(function(response) {
            // Populate the form fields with the data returned from server
            $('#userForm')
                .find('[name="id"]').val(response.id).end()
                .find('[name="name"]').val(response.name).end()
                .find('[name="email"]').val(response.email).end()
                .find('[name="website"]').val(response.website).end();

            // Show the dialog
            bootbox
                .dialog({
                    title: 'Edit the user profile',
                    message: $('#userForm'),
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#userForm')
                        .show()                             // Show the login form
                        .formValidation('resetForm'); // Reset form
                })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the login form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#userForm').hide().appendTo('body');
                })
                .modal('show');
        });
    });
});
</script>
<script>

$('.selectpicker').selectpicker();
$('.selectpicker').selectpicker({
      style: 'btn-info',
      size: 4
  });
  
  
   $('.selectpicker').selectpicker({
      style: 'btn-info',
      size: 4
  });
  
  </script>


        
    </div>
    
    
    
</div></div></div></div></div></div></div></div></div>



