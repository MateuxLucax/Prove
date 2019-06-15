<!DOCTYPE html>

<?php
include "conf/conf.inc.php";
include "valida.php";
$title = "Página inicial";
?>

<html>
	<head>
		<title><?php echo $title; ?></title>
		<meta charset="utf-8">
	</head>

	<body>
		<a href="acaoLogin.php?acao=logoff">Sair</a>
		<br><br>
		<?php

		echo "Bem vindo ".$_SESSION['nome'].
			 "<br>
			  user: ".$_SESSION['usuario'];
		?>

	</body>
</html>