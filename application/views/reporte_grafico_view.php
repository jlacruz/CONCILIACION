


<style type="text/css">
		a, a:link, a:visited {
			color: #444;
			text-decoration: none;
		}
		a:hover {
			color: #000;
		}
		.left {
			float: left;
		}
		#menu {
			width: 20%;
		}
		#g_render {
			width: 80%;
		}
		li {
			margin-bottom: 1em;
		}
	</style>
	
	<script type="text/javascript">
		google.load("jquery", "1.4.4");
	</script>
	<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>



<div id="body">
		<div id="g_render"  class="left">
		<?php if (isset($charts)) echo $charts; ?>
		
		
		<?php if (isset($json)): ?>
			<h3>Json string output: associative array with global options and 'local options' (for each graph)</h3>
			<pre><?php echo print_r($json); ?></pre>
		<?php endif; if (isset($array)): ?>
			<h3>Array output: associative array with global options and 'local options' (for each graph)</h3>
			<pre><?php echo print_r($array); ?></pre>
		<?php endif; ?>
		</br></br><font color="white">---------------------------------------------------------------------------------------------------------------------------------------------</font>
		<a href="<?php echo base_url() ?>index.php/graficacontroler/index" ><button type="button" class="btn btn-primary">Atras</button></a>&nbsp
	</div>
	

</div>



