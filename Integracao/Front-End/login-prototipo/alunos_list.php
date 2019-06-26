<!DOCTYPE html>
<?php
	include 'alunos_pdo.php';
?>
<html>
<head>
	<title>Listagem de alunos</title>
	<meta charset="utf-8">

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
	<?php
		printSelectPDOAsTable(selectPDO());
	?>
</body>
</html>