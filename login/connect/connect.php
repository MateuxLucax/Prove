<?php 
	include 'conf/conf.inc.php';

	$conexao = mysqli_connect($url, $usuario, $password, $dbname);

	if (mysqli_connect_error()) {
		echo mysql_connect_error();
	}
	
 ?>