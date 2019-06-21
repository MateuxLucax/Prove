<!DOCTYPE html>
<?php
	include 'valida_secao.php';
?>
<html>
<head>
	<title>Login teste</title>
</head>
<body>
	<?php
		echo "Bem vindo ".$_SESSION['nome'].
			 "<br>
			  matrícula: ".$_SESSION['matricula'];

	?>
</body>
</html>