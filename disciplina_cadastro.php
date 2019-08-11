<!DOCTYPE html>
<?php
	include 'conf.php';
	include 'funcoes.php';
	include 'valida_secao.php';
	include 'disciplinas_pdo.php';

	if (isset($_POST['acao'])) $acao = $_POST['acao'];
	else if (isset($_GET['acao'])) $acao = $_GET['acao'];
	else $acao = '';
?>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>Cadastro de disciplina</title>

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.png" />

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- CSS -->
		<link href="assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>

		
	</head>

	<body>
		<?php printHeader(); /*include 'funcoes.php'; lá em cima*/ ?>

		<main>
			<div class="container">
				<form action="disciplinas_pdo.php" method="post">
					<div class="input-field col s12">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome"?>
					</div>

					<div class="input-field col s12">
						<?php gerarSelect($tb_series, 'Serie_Codigo_Serie', 0, 'Codigo_Serie', 'Descricao'); //funcoes.php ?> 
					</div>

					<div class="input-field col s12">
						<button type="submit" name="acao" id="acao" value="cadastrar" class="btn waves-effect waves-light">Cadastrar</button>
					</div>
				</form>
			</div>
		</main>

		<footer>
		</footer>
	</body>

	<!--  Scripts-->
	<script src="assets/js/jquery-2.1.1.min.js"></script>
	<script src="assets/js/materialize.min.js"></script>
	<script src="assets/js/init.js"></script>

</html>