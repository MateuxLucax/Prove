<!DOCTYPE html>
<?php
	date_default_timezone_get('America/Sao_Paulo');
?>
<html>
<head>
	<title>Cadastro de professores</title>
	<meta charset="utf-8">

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
	<div class="container">
		<form action="professores_pdo.php" method="post">
			<div class="input-field col s12">	
				<label for="matricula">Matrícula</label>
				<input type="text" name="matricula" id="matricula">
			</div>

			<div class="input-field col s12">
				<label for="senha">Senha</label>
				<input type="password" name="senha" id="senha">
			</div>

			<div class="input-field col s12">
				<label for="Nome">Nome</label>
				<input type="text" name="nome" id="nome">
			</div>

			<div class="input-field col s12">
				<label>Data de nascimento</label>
				<input type="date" name="data_nascimento">
			</div>

			<input type="hidden" name="ultimo_login" id="ultimo_login" value="<?php echo date('Y-m-d H:i:s'); ?>">

			<button type="submit" name="acao" class="btn black white-text waves-effect waves-light" value="cadastrar">Cadastrar</button>
		</form>
	</div>
</body>
</html>