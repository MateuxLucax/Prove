<!DOCTYPE html>
<?php
	include 'valida_secao.php';
	include 'funcoes.php';

	selectDisciplinas($_SESSION['matricula']); // disciplinas do qual o usuário faz parte

?>
<html lang="pt-br">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Home - Prove</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/img/favicon.png" />

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- CSS -->
	<link href="assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>
	<?php printHeader(); ?>

	<main>
		<div class="container">
			<?php
				echo "Bem vindo ".$_SESSION['nome'].
				 "<br>
					matrícula: ".$_SESSION['matricula']."
					Você é ".$_SESSION['tipo'];
			?>

			<?php if($_SESSION['tipo'] == 'aluno') { ?>
				


			<?php } ?>		

			<?php if($_SESSION['tipo'] == 'professor') { ?>
				<div class="row">
					<a href="cadastro_disciplina.php"><div class="card-panel teal white-text col s-4"><h4>Criar Disciplina</h4></div></a>
				</div>
				<div class="row">
					<a href="cadastro_avaliacao.php"><div class="card-panel teal white-text col s-4"><h4>Criar Valiação</h4></div></a>
				</div>
				<div class="row">
					<a href="cadastro_serie.php"><div class="card-panel teal white-text col s-4"><h4>Criar Série</h4></div></a>
				</div>
				


			<?php } ?>


		</div>
	</main>

	<footer class="page-footer">
		<div class="footer-copyright">
			<div class="container">
				<span class="left" id="copyright-js"></span> &nbsp; <a target="_blank" href="https://github.com/MateuxLucax/Sicherheit">Prove</a>
				<span class="right"><a target="_blank" href="https://opensource.org/licenses/MIT">MIT License</a></span>
			</div>
		</div>
	</footer>

	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="assets/js/materialize.min.js"></script>
	<script src="assets/js/init.js"></script>

	<?php
		function selectDisciplinas($matricula) {

		}
	?>

	</body>

</html>
