<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>WGA</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/principal.css" rel="stylesheet">
		<script>
			function mostrar(target) {
				document.getElementById(target).style.display = 'block';
			}
		</script>
	</head>
	<body>
<div class="container-full">

      <div class="row">
       
        <div class="col-lg-12 text-center v-center">
          
          <h1><img src="assets/img/logo30.png" alt=""> Whatsapp Group Analytics</h1>
          <p class="lead">Estadísticas básicas de tus grupos de Whatsapp</p>
          
          <br><br><br>
          
          <form enctype="multipart/form-data" id="envio-archivo" name="envio-archivo" class="col-lg-12" action="php/process.php" method="post">
			<h2>1º Selecciona tu archivo de conversación de Whatsapp</h2>
			    <div class="input-group input-wga">
					<input type="file" accept=".txt" id="archivo" name="archivo" required>
					<p class="help-block" class="col-lg-4" onclick="mostrar('exp_file')">¿Qué es esto?▼</p>
					<p class="help-block" class="col-lg-4" id="exp_file" style="display:none">
					Desde cualquier grupo de Whatsapp puedes desplegar el menú de opciones y dándole a <i>Más > Enviar chat por correo</i> 
					envías a tu propio correo todo el historial de chat en un archivo .txt. Ese es el archivo que debes seleccionar aqui.
					</p>
				</div>
			<h2>2º Contraseña</h2>
				<div class="input-group input-wga">
				  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
				  <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" aria-describedby="basic-addon1" required>
				</div>
				<p class="help-block" class="col-lg-4" onclick="mostrar('exp_pass')">¿Para qué sirve?▼</p>
					<p class="help-block" class="col-lg-4" id="exp_pass" style="display:none">
					Ponerle una contraseña al análisis te permite borrarlo después. Simplemente debes insertar esta contraseña en el análisis, y se borrará, sin quedar rastro en el servidor.
					</p>
			<h2>3º Términos y condiciones</h2>
            <div class="checkbox input-group input-wga">
			  <label>
				<input type="checkbox" id="tos" name="tos" value="" onclick="mostrar('enviar')" required>
				He leído y acepto los Términos y Condiciones
			  </label><br>
			  <p class="help-block" class="col-lg-4" onclick="mostrar('exp_terms')">Términos y condiciones▼</p>
				<p class="help-block" class="col-lg-4" id="exp_terms" style="display:none">
					1. No almacenamos material con copyright en nuestros servidores<br>
					2. El contenido de las conversaciones es responsabilidad única del usuario<br>
					3. No vendemos datos a terceros<br>
					4. En caso de olvido de contraseña o similar, el usuario puede ponerse en contacto mediante correo electrónico con <strong>joaquin(at)muruais.com</strong> para solucionar o borrar cualquier dato
				</p>
			</div>
			<h2>4º Enviar</h2>
			<div id="enviar" style="display:none">
				<button type="submit" class="btn btn-default" onclick="mostrar('carga')">Enviar</button>
			</div>
			<div id="carga" style="display:none"><i class="fa fa-spinner fa-pulse"></i> Procesando (Esto podría tardar un par de minutos...)</div>
          </form>
        </div>
        
      </div> <!-- /row -->
  
  	<br><br><br><br><br>

</div> <!-- /container full -->

<div class="container">
	<div class="row">
        <div class="col-lg-12">
        <br><br>
          <p class="pull-right"><a href="http://www.muruais.com">Quincho</a></p>
        <br><br>
        </div>
    </div>
</div>


	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>
