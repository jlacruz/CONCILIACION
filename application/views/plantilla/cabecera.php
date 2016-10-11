<?php
	include("config.php");
	$controladorMetodo=$this->uri->segment(1)."/".$this->uri->segment(2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title><?php echo $texto_encabezado?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() .APPPATH ?>css/estilos.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() .APPPATH ?>css/botones.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() .APPPATH ?>css/menu.css" />
    
    <!--Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() .APPPATH ?>css/bootstrap-theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() .APPPATH ?>css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH ?>css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH ?>css/formValidation.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH ?>css/github.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . APPPATH ?>css/style.css" />
    
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Cardo:400,400italic,700">
    
   <!-- Fin Bootstrap CSS-->
    <script src="<?php echo base_url() . APPPATH ?>js/jquery-2.1.1.min.js"></script>
   <!--Bootstrap JS-->
    <script src="<?php echo base_url() . APPPATH ?>js/bootstrap.js"></script>
   <!--<script src="<?php echo base_url() . APPPATH ?>js/npm.js"></script>-->
   <!-- Fin Bootstrap JS-->
    
    <script src="<?php echo base_url() .APPPATH ?>/js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() .APPPATH ?>/js/herramientas.js"></script>
    <script src="<?php echo base_url() . APPPATH ?>js/highcharts.js"></script><!-- Libreria para las graficas -->
    <script src="<?php echo base_url() . APPPATH ?>js/exporting.js"></script><!-- Libreria para imprimir las graficas-->
    <script src="<?php echo base_url() .APPPATH ?>/js/jquery-2.1.1.min.js"></script>
    <script src="<?php echo base_url() .APPPATH ?>/js/jquery.sticky.js"></script>
    <script src="<?php echo base_url() .APPPATH ?>/js/jquery-ui.js"></script>
    <script src="<?php echo base_url() .APPPATH ?>/js/jquery.numeric.js"></script>
    <script src="<?php echo base_url() .APPPATH ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() . APPPATH ?>js/formValidation.min.js"></script>
    <script src="<?php echo base_url() . APPPATH ?>js/typehead.js"></script>
	
    
    
    
      
    
    <!--Menú de arriba-->
    <script> 
		$(document).ready(function()
		{
			$("#panel_control").sticky({topSpacing:0});

			$('label.tree-toggler').click(function () {
				$(this).parent().children('ul.tree').toggle(300);
				
			});
			$('label.tree-toggler').parent().children('ul.tree').toggle(300);
		});
	</script>

</head>
<body>
	<script type="text/javascript">
    $(document).ready(function() {
	
   /* $('.info').hide();
    $('.warning').hide();*/
    
    <?php if($this->session->flashdata('msg'))
    { 
    	
		if($this->session->flashdata('msg')==1)
		{
			?>
			$('.info').html('Guardado Correctamente').show();
			$(".info").fadeOut(8000); 
			<?php 
		}
		elseif($this->session->flashdata('msg')==2)
		{
			?>
			$('.warning').html('Error al guardar, Intente nuevamente').show();
			$(".warning").fadeOut(8000); 
			<?php
		}
		elseif($this->session->flashdata('msg')==3)
		{
			?>
			$('.info').html('Enviado Correctamente').show();
			$(".info").fadeOut(8000); 
			<?php 
		}
		else
		{
		?>
		$('.info').html('<?php echo $this->session->flashdata('msg')?>').show();
		$(".info").fadeOut(8000);
		<?php
		}
    }
    ?>
    
    });
    </script>

<?php
	$variablesSesion=$this->session->userdata('usuario');
	
?>
<?php
if($this->session->userdata('usuario'))
	{
?>
	<div id="panel_control" >
		<div style="float:left">
			<?php echo $variablesSesion['titulo']." ".$variablesSesion['nombre']." ".$variablesSesion['s_nombre']." ".$variablesSesion['p_apellido']." ".$variablesSesion['s_apellido'] ?>
        	- <?php echo $variablesSesion['descripcion_rol']; ?>
        </div>
        <div style="float:right;">			
<a href="<?php echo base_url()?>index.php/principal/logout"><button type="button" class="btn btn-danger">Cerrar Sesi&oacute;n <span class="glyphicon glyphicon-off"></span></button></a>
</div>&nbsp;&nbsp;

 <div style="float:right;">			
<a href="<?php echo base_url()?>index.php/bienvenida"><button type="button" class="btn btn-primary">Inicio <span class="glyphicon glyphicon-home"></span></button></a>
</div>
       
	</div>
   
<?php
		//$estilo="style='float:left;margin:20px 0 0 20px;min-height:1000px;height:100%;width:320px'";
	}
	elseif($controladorMetodo!="principal/login" && $controladorMetodo!="principal/recuperarClave" && $variablesSesion['cedula']=="")
	{
		redirect('principal/login', 'refresh');
	}
	
?> 
	<div id='encabezado'>
    	<?php echo '<img width="100%" src="' . base_url() . APPPATH . 'imagenes/sisconser 2.png">';?>
    </div>
    <br class="br">
    
<div id="container" >
    
	<div>
    	<!-- MENU-->
      <?php
      if($this->session->userdata('usuario'))
      {
	  	if($variablesSesion['rol']==1)
		{
      		require("menu.php");
		}
		if($variablesSesion['rol']==2)
		{
      		require("menu2.php");
		}
	}
	  ?>
    </div>
	<div class="info" style="display:none"></div>
	<div class="warning" style="display:none"></div>
