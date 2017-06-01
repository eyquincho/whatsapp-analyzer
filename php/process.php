<?php
//Creado por Quincho, así que a saber...
//13.03.2016
session_start();
ob_start();
include("conDB.php");
conexionDB();
header('Content-Type: text/html; charset=UTF-8');
	

function rand_string( $length ) {
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
return substr(str_shuffle($chars),0,$length);
}
function clean($string) {
	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
$cod_tabla = rand_string(10);
$nombre_archivo = $_FILES['archivo']['name'];

$reg_pass= "INSERT INTO wga_pass (pass, id_resume, txt_name, creacion) VALUES ('".md5($_POST['pass'])."', '".$cod_tabla."', '".$nombre_archivo."' , NOW())";
	if (mysqli_query($_SESSION['con'], $reg_pass)or die(mysqli_error($_SESSION['con']))) {
					echo "<div class=\"alert alert-success\" role=\"alert\"> </div>";
				}else {
					echo "<div class=\"alert alert-warning\" role=\"alert\"> </div>";
				}
 //CREAR TABLA
	$sql = "CREATE TABLE `wga_con_".$cod_tabla."` (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	con_fecha VARCHAR(30) NOT NULL,
	con_dia INT(2) NOT NULL,
	con_mes INT(2) NOT NULL,
	con_ano INT(4) NOT NULL,
	con_hora INT(2) NOT NULL,
	con_autor VARCHAR(50),
	con_mensaje VARCHAR(200)
	)";

	if (mysqli_query($_SESSION['con'], $sql)) {
		echo " ";
	} else {
		echo "Error creating table: " . mysqli_error($_SESSION['con']);
	}
 
 // FIN CREAR TABLA

 $fp = fopen($_FILES['archivo']['tmp_name'], 'r');
    function getStringBetween($line,$from,$to)
		{
			$sub = substr($line, strpos($line,$from)+strlen($from),strlen($line));
			return substr($sub,0,strpos($sub,$to));
		}
	function getStringToEnd($line,$from)
		{
			return substr($line, strpos($line,$from)+strlen($from),strlen($line));
		}
	while ( ($line = fgets($fp)) !== false) {
		//Compruebo que la linea empiece por fecha, sino la ignoro
		$first2 = substr("$line", 0, 2);
		$autor = getStringBetween($line,"- ",":");
		if (is_numeric($first2)&& $autor!="") {
		//Extraigo datos de la linea
		$fecha = substr("$line", 0, strpos($line,","));
		$dia = substr("$line", 0, 2);
		$mes = substr("$line", 3, 2);
		$ano = substr("$line", 6, 4);
		$hora = getStringBetween($line,", ",":");
		//$hora = preg_replace('/[^A-Za-z0-9\-]/', '', $hora);
		$mensaje = mysqli_real_escape_string ($_SESSION['con'], getStringToEnd($line,": "));
		$reg = "INSERT INTO wga_con_".$cod_tabla." (con_fecha, con_dia, con_mes, con_ano, con_hora, con_autor, con_mensaje) VALUES ('$fecha', '$dia', '$mes', '$ano', '$hora','$autor','$mensaje')";
		if(mysqli_query($_SESSION['con'], $reg)or die(mysqli_error($_SESSION['con']))) {
						echo "<div class=\"alert alert-success\" role=\"alert\"> </div>";
					}else {
						echo "<div class=\"alert alert-warning\" role=\"alert\"> </div>";
					}
//		echo 'Fecha ' .$fecha;
//		echo 'Dia ' .$dia;
//		echo 'Mes ' .$mes;
//		echo 'Año ' .$ano;
//		echo ' Hora ' .$hora;
//		echo ' Autor ' .$autor;
//		echo ' Mensaje ' .$mensaje;
		
		}
		else {
			}
		echo '<br>';
	};
echo "<meta http-equiv=\"refresh\" content=\"0;URL=../resumen.php?id=".$cod_tabla."\">";
fclose($fp);
 

?>