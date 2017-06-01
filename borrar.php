<?php
	session_start();
	ob_start();
	include("php/conDB.php");
	conexionDB();
	if (isset($_GET['id'])) {
		//borrar tabla con id $_POST['id']
		//borrar registro en la tabla con id_resumen $_POST['id']
		//mostrar alerta de "Resumen borrado correctamente"
		//redirigir a la página principal
		$sql_borrar= "DROP TABLE wga_con_".$_GET['id'];
		$bye = mysqli_query($_SESSION['con'],$sql_borrar);
		echo "<script>
				alert('Se ha borrado correctamente');
				window.location.href='index.php';
				</script>";
	}else {
		echo "<script>
				alert('Algo ha salido mal.');
				window.location.href='index.php';
				</script>";
	}
?>