<!DOCTYPE html>
<?php
	date_default_timezone_get('America/Sao_Paulo');
?>
<html>
<head>
	<title>Cadastro de Avaliações</title>
	<meta charset="utf-8">

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
	<div class="container">
		<form action="avaliacao_pdo.php" method="post">
			<div class="input-field col s12">	
				<label for="Tema">Tema</label>	
				<input type="text" name="Tema" id="Tema">
			</div>
			<button type="submit" name="acao" class="btn black white-text waves-effect waves-light" value="cadastrar">Cadastrar</button>
		</form>
	</div>
</body>
</html>