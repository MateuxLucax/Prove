<!DOCTYPE html>
<?php
	include 'conf.php';
	include 'funcoes.php';
	include 'valida_secao_professor.php'; //Deve ser incluído em todas as páginas restritas para usuários do tipo Professor (E não é necessário incluir valida_secao.php também: valida_secao_professor.php já inclui valida_secao.php)
?>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>Cadastro de série</title>

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.png" />

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- CSS -->
		<link href="assets/css/materialize.css" type="text/css" rel="stylesheet">
	</head>

	<body>
		<?php printHeader(); /*include 'funcoes.php'; lá em cima*/ ?>

		<main>
			<div class="container">
				<form action="series_pdo.php" method="post">
					<div class="input-field col s12">
						<input id="nome" name="nome" type="text" class="validate">
						<label for="nome" class="active">Nome</label>
					</div>
					<div class="input-field col s12">
						<button type="submit" name="acao" id="acao" value="cadastrar" class="btn waves-effect waves-light">Cadastrar</button>
					</div>
				</form>
			</div>
		</main>

		<footer>
		</footer>

		<!--  Scripts-->
		<script src="assets/js/jquery-2.1.1.min.js"></script>
		<script src="assets/js/materialize.min.js"></script>
		<script src="assets/js/init.js"></script>

	</body>
</html>