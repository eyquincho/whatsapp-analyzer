<?php
//Creado por Quincho, así que a saber...
//13.03.2016
session_start();
ob_start();
include("php/conDB.php");
conexionDB();
header('Content-Type: text/html; charset=UTF-8'); 

$id_resumen=$_GET['id'];
$tabla = "wga_con_".$_GET['id'];
$query_tabla= "SELECT `id` FROM ".$tabla;
$query_rows = mysqli_query($_SESSION['con'], $query_tabla);
$mensajes_totales = mysqli_num_rows($query_rows);
$sql_pass = "SELECT `pass`, `txt_name` FROM `wga_pass` WHERE `id_resume` ='".$_GET['id']."'";
$cons_pass = mysqli_query($_SESSION['con'],$sql_pass);
while($row_pass = mysqli_fetch_array($cons_pass)){
$pass_actual = $row_pass[0];
$name_res = $row_pass[1];
}
function cons_fecha() {
	$query_fm= "SELECT `con_fecha`, `con_autor` FROM `wga_con_".$_GET['id']."` LIMIT 1";
	$result_fm= mysqli_query ($_SESSION['con'],$query_fm);
	while($row = mysqli_fetch_array($result_fm)){
		echo "<p><bold>". $row[1]. "</bold></p>";
		echo "<p>". $row[0]. "</p>";
	}
}

//EXTRAER DATOS PARA EL GRÁFICO DE MENSAJES POR HORA
function menshora () {
$query_mh= "SELECT `con_hora` , COUNT(`con_hora`)
					FROM `wga_con_".$_GET['id']."`
					GROUP BY `con_hora`
					ORDER BY `con_hora`
					ASC LIMIT 24";
$result_mh= mysqli_query ($_SESSION['con'],$query_mh);
while($row = mysqli_fetch_array($result_mh)){
	echo "[" . $row[0] . "," . $row[1] . "],";
}
}
//FIN GRÁFICO MENSAJES POR HORA

function topusers () {
$query_topusers= "SELECT `con_autor` , COUNT(`con_autor`)
					FROM `wga_con_".$_GET['id']."`
					GROUP BY `con_autor`
					ORDER BY COUNT(`con_autor`)
					DESC LIMIT 5";
$result_topusers= mysqli_query ($_SESSION['con'],$query_topusers);

while($row = mysqli_fetch_array($result_topusers)){
echo "<p><bold>" . $row[1] . "</bold> | " . $row[0] . "</p>";
}
}

?>

<!doctype html>
<html><head>
    <meta charset="utf-8">
    <title>Análisis de "<?php echo $name_res; ?>"</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Estadísticas sencillas de tus grupos de Whatsapp.">
    <meta name="author" content="Boa Xente">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/font-style.css" rel="stylesheet">
    <link href="assets/css/flexslider.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
      }
	  #share-buttons img {
		width: 35px;
		padding: 5px;
		border: 0;
		box-shadow: 0;
		display: inline;
		}
    </style>

  	<!-- Google Fonts call. Font Used Open Sans & Raleway -->
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
  	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });
    
});

 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });  
});
</script>
<!-- SCRIPT CHART GOOGLE -->
    <script type="text/javascript">
    
	google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Mensajes');

      data.addRows([<?php menshora(); ?>
      ]);

      var options = {
        hAxis: {
          title: 'Hora',
          titleTextStyle: {	color: '#FFFFFF'},
          gridlines: {color: '#4f4f4f', count:4},
          textStyle: {color:'#FFFFFF'}
            },
        vAxis: {
          title: 'Mensajes',
          titleTextStyle: {	color: '#FFFFFF'},
          gridlines: {color: '#4f4f4f', count:4},
          textStyle: {color:'#FFFFFF'}
            },
        backgroundColor: '#4f4f4f',
        legend: 'none'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
	
    </script>


    
  </head>
  <body>
  <?php include_once("../analyticstracking.php") ?>
  	<!-- NAVIGATION MENU -->

    <div class="navbar-nav navbar-inverse navbar-fixed-top">
        <div class="container">
			<div class="navbar-header">
			  <a class="navbar-brand" href="index.php"><img src="assets/img/logo30.png" alt=""> Whatsapp Group Analyzer</a>
			  
			</div>
			<h2 style="color:#3399FF;">Análisis de "<?php echo $name_res; ?>"</h2>
        </div>
    </div>

    <div class="container">

	  <!-- FIRST ROW OF BLOCKS -->     
      <div class="row">

      <!-- USER PROFILE BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<!-- LOCAL TIME BLOCK -->
      		<div class="half-unit">
	      		<dtitle>Mensajes totales</dtitle>
	      		<hr>
					<div class="cont">
					<p><bold><?php echo $mensajes_totales; ?></bold></p>
					</div>
			</div>

      <!-- SERVER UPTIME -->
			<div class="half-unit">
	      		<dtitle>Primer mensaje</dtitle>
	      		<hr>
	      		<div class="cont">
					<?php cons_fecha(); ?>
				</div>
			</div>
        </div>

      <!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
	      		<dtitle>Top Usuarios</dtitle>
	      		<hr>
	      		<div class="cont topusers">
					<?php topusers(); ?>
				</div>

			</div>
        </div>

      <!-- DONUT CHART BLOCK -->
        <div class="col-sm-6 col-lg-6">
      		<div class="dash-unit">
		  		<dtitle>Mensajes por hora del día</dtitle>
		  		<hr>
	        	<div id="chart_div"></div>
			</div>
        </div>
        
      </div><!-- /row -->

	  
      
	  <!-- SECOND ROW OF BLOCKS -->     
      <div class="row">
       
	  <!-- GRAPH CHART - lineandbars.js file -->     
        <div class="col-sm-9 col-lg-9">
      		<div class="dash-unit">
      		<dtitle>Acerca de</dtitle>
      		<hr>
			   <p><bold>A grosso modo...</bold></p>
			   Esta aplicación se creó con el único fin de ver de forma fácil y ordenada las estadísticas de un grupo de Whatsapp. Todos los datos almacenados en el servidor se borran completamente al introducir la contraseña. Los datos almacenados son meramente estadísticos.
			<!-- I got these buttons from simplesharebuttons.com -->
					<div id="share-buttons">

						<!-- Email -->
						<a href="mailto:?Subject=Análisis de <?php echo $name_res; ?>&amp;Body=Por%20si%20te%20interesa%20 http://quepereza.es<?php echo $_SERVER['PHP_SELF']."?id=". $_GET['id']; ?>">
							<i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
						</a>
					 
						<!-- Facebook -->
						<a href="http://www.facebook.com/sharer.php?u=http://quepereza.es<?php echo $_SERVER['PHP_SELF']."?id=". $_GET['id']; ?>" target="_blank">
							<i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
						</a>
						
						<!-- Google+ -->
						<a href="https://plus.google.com/share?url=http://quepereza.es<?php echo $_SERVER['PHP_SELF']."?id=". $_GET['id']; ?>" target="_blank">
							<i class="fa fa-google-plus-square fa-2x" aria-hidden="true"></i>
						</a>
					  
						<!-- Twitter -->
						<a href="https://twitter.com/share?url=http://quepereza.es<?php echo $_SERVER['PHP_SELF']."?id=". $_GET['id']; ?>&amp;text=Analisis%20de%20'<?php echo $name_res; ?>'%20&amp;hashtags=quepereza" target="_blank">
							<i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i>
						</a>
						
						<!-- Whatsapp -->
						<a href="whatsapp://send?text=http://quepereza.es<?php echo $_SERVER['PHP_SELF']."?id=". $_GET['id']; ?>&amp;text=Analisis%20de%20'<?php echo $name_res; ?>'" data-action=”share/whatsapp/share” >
							<i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i>
						</a>
					</div>

			</div>
        </div>

	  <!-- LAST MONTH REVENUE -->     
        
        
	  <!-- 30 DAYS STATS - CAROUSEL FLEXSLIDER -->     
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
				<dtitle>Eliminar este análisis</dtitle>
	      		<hr>
	      		Al crear este análisis y aceptar los Términos y Condiciones, se te pidió una contraseña, insértala en el campo siguiente para eliminar todos los datos relativos a este análisis. Nada se guardará en nuestro servidor.
				
				<form enctype="multipart/form-data" id="envio-archivo" name="envio-archivo" class="col-lg-12" action="<?php echo $_SERVER['PHP_SELF']."?id=". $_GET['id']; ?>" method="post">
					<div class="input-group input-wga">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
						  <input type="password" class="form-control" id="pass_ins" name="pass_ins" placeholder="Contraseña" aria-describedby="basic-addon1" required>
					</div>
					<div id="enviar">
						<button type="submit" class="btn btn-default">Enviar</button>
					</div>
				</form>
				
				
<?php
if (isset($_POST['pass_ins'])){
?>	
			<script type="text/javascript">    
				$(window).load(function(){
					$('#modal_borrar').modal('show');
				});
			</script>
	<div class="modal fade" id="modal_borrar" tabindex="-1" role="dialog" aria-labelledby="ModalBorrar" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="titulo-modal">Eliminar análisis </h4>
				</div>
				<div class="modal-body" style="color:black">
					<?php
						if ($pass_actual == md5($_POST['pass_ins'])){
							echo 'La contraseña es correcta, pulsa en eliminar para borrar el resumen. Todos los datos desaparecerán del servidor y volverás a la página principal.
							</div>
							<div class="modal-footer">
								<a href="borrar.php?id='. $_GET['id'].'" class="btn btn-danger" name="DENboton" type="submit" value="Eliminar" id="DELboton">Eliminar</a>
								<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
							</div>';
						}
						else{
							echo 'La contraseña introducida no es correcta.
							</div>
							<div class="modal-footer">
								<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
							</div>
							';
						} ?>
			</div>
		</div>
	</div>
				
	<?php }else{} ?>				
				
				
				
            </div>
		</div>
      </div><!-- /row -->
     
	  <!-- FOURTH ROW OF BLOCKS -->     
	
      
	</div> <!-- /container -->
	<div id="footerwrap">
      	<footer class="clearfix"></footer>
      	<div class="container">
      		<div class="row">
      			<div class="col-sm-12 col-lg-12">
      			<p><a href="http://twitter.com/eyquincho" target="_blank">Quincho</a></p>
      			</div>

      		</div><!-- /row -->
      	</div><!-- /container -->		
	</div><!-- /footerwrap -->


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/lineandbars.js"></script>
	<script type="text/javascript" src="assets/js/dash-charts.js"></script>
	<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
	<script src="assets/js/jquery.flexslider.js" type="text/javascript"></script>
</body></html>