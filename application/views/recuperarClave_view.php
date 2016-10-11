



<?php
	//$this->session->sess_destroy();
	//print_r($this->session->userdata('usuario'));
?><head>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<style type="text/css">
body,td,th {
	color: #0B0B0B;
}
body {
	background-image: url();
}
</style>
<body bgcolor="#D6D6D6" text="#D6D6D6">

<form action='login' name="inicioSesion" id="inicioSesion" method="post" >
	<table class="table center-table table-nonfluid">
  
    
    
    
    	<tr>
                	<th>
            	<h2 class"form-signin" align="center">Recuperar Clave</h2>
            </th>
        </tr>
        <tr>

        <td>
            <div class="input-group">
<span class="input-group-addon glyphicon glyphicon-user"></span>
  <?php echo form_input(array('name' => 'correo', 'id' => 'correo', 'size' => '20', 'placeholder' => 'Correo', 'class' => 'form-control','onkeyup' => 'javascript:this.value=this.value.toUpperCase()'  )) ?>                                        
</div>
     
</td>
         <tr>
                     <td>
                     <div class="input-group">
                     <span class="input-group-addon glyphicon glyphicon-lock"></span>
				<?php echo form_input(array('name' => 'cedula', 'id' => 'cedula', 'size' => '20', 'placeholder' => 'Cedula', 'type' => 'password', 'class' => 'form-control','onkeyup' => 'javascript:this.value=this.value.toUpperCase()')) ?>
                </div>
            </td>
            
        </tr>
        <tr>
        </tr>

    <tr>
    	<td>
        	<!--<div class="g-recaptcha" data-sitekey="6LfiQQwTAAAAACk_-aeDEegt8twMBrKWFOrCymHU"></div>-->
   
    	</td>
   </tr>

         <tr>
                     <td>
                    <!-- <a href="<?php echo base_url()?>index.php/principal/registro"><button type="button" class="btn btn-success">Registrar</button></a>-->
                     
                     
            	<?php echo form_submit(array('name' => 'enviar', 'id' => 'enviar','class' => 'btn btn-primary','value' => 'Entrar')) ?>
               


            </td>
            
      </tr>
  

        <tr>
            <td style="text-align:center">
           		<!--<a href="recuperar_Clave">Recuperar su clave</a>-->
            </td>
        </tr>
    </table>
    
    </html>
    
