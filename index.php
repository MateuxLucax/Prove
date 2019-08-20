<!DOCTYPE html>
<?php
	require_once "autoload.php";

	include 'valida_secao.php';
	include 'funcoes.php';
	include 'disciplinas_pdo.php';

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
				echo "<p class='center-align'>Bem vindo, <b>".$_SESSION['nome']."</b>.<br>Matrícula: <b>".$_SESSION['matricula']."</b>.<br>	Você é <b>".$_SESSION['tipo']."</b>.</p>";
			?>

			<?php if($_SESSION['tipo'] == 'aluno') { ?>
				


			<?php } ?>		

			<?php if($_SESSION['tipo'] == 'professor' || $_SESSION['tipo'] == 'aluno') {
				
				$disciplinas = selectDisciplinas($_SESSION['matricula'], $_SESSION['tipo']);
				//var_dump($disciplinas);
				$contador=count($disciplinas);
					

				if($_SESSION['tipo'] == 'professor') {?>
					<div class="row">

						<div class="card-panel teal col s12 m4 center-align">
							<a class="white-text" href="serie_cadastro.php">
								<p class="hide-on-small-only"><i class="material-icons white-text small">add</i></p>
								<h5 class="truncate"><i class="hide-on-med-and-up material-icons white-text left">add</i>Adicionar série</h5>
							</a>
						</div>

						<div class="card-panel teal col s12 m4 center-align">
							<a class="white-text" href="disciplina_cadastro.php">
								<p class="hide-on-small-only"><i class="material-icons white-text small">add</i></p>
								<h5 class="truncate"><i class="hide-on-med-and-up material-icons white-text left">add</i>Adicionar disciplina</h5>
							</a>
						</div>

						<div class="card-panel teal col s12 m4 center-align">
							<a class="white-text" href="avaliacao_cadastro.php">
								<p class="hide-on-small-only"><i class="material-icons white-text small">add</i></p>
								<h5 class="truncate"><i class="hide-on-med-and-up material-icons white-text left">add</i>Adicionar avaliação</h5>
							</a>
						</div>

					</div>
				<?php } ?>

			
					<?php
						echo "<div class='row flex-wrap'>";
						if (isset($disciplinas) && $contador > 0) {
							for ($i=0; $i < $contador ; $i++) {
								$cod = $disciplinas[$i][0];
								$nome = $disciplinas[$i][1];
								$serie = $disciplinas[$i][2];
								echo "<div class='card-panel col s12 m4 center-align'>";
									echo "<a class='teal-text' href='disciplina.php?codigo=".$cod."'>";
										echo "<p><i class='material-icons large'>web</i></p>";
										echo "<h5 class='truncate'><small>".$serie." - </small>".$nome."</h5>";
									echo "</a>";
								echo "</div>";
							}
						}
						echo "</div>";
					?>
				


			<?php } ?>


		</div>
	</main>

	<footer class="page-footer">
		<?php printFooter(); ?>
	</footer>

	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="assets/js/materialize.min.js"></script>
	<script src="assets/js/init.js"></script>

	<?php
		function selectDisciplinas($matricula,$tipo) {
			$pdo = Conexao::getInstance();

			try {
				if($tipo == 'aluno') {
					$sql = 'select D.Codigo_Disciplina, D.Nome, S.Descricao FROM '.$GLOBALS['tb_alunos'].' A, '.$GLOBALS['tb_disciplinas'].' D, '.$GLOBALS['tb_disc_alun'].' AD, Serie S
					WHERE AD.Alunos_Matricula = A.Matricula
					AND AD.Disciplina_Codigo_Disciplina = D.Codigo_Disciplina
					AND A.Matricula = \''.$matricula.'\' 
					AND S.Codigo_Serie = D.Serie_Codigo_Serie ORDER BY S.Codigo_Serie';
				} else {
					$sql = 'select D.Codigo_Disciplina, D.Nome, S.Descricao FROM '.$GLOBALS['tb_professores'].' P, '.$GLOBALS['tb_disciplinas'].' D, '.$GLOBALS['tb_disc_prof'].' PD, Serie S
					WHERE PD.Professores_Matricula = P.Matricula
					AND PD.Disciplina_Codigo_Disciplina = D.Codigo_Disciplina
					AND P.Matricula = \''.$matricula.'\' 
					AND S.Codigo_Serie = D.Serie_Codigo_Serie ORDER BY S.Codigo_Serie';
				}

				//var_dump($sql); echo "<br>";
		
				$consulta = $pdo->query($sql);
		
				$registros = array();
		
				for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
					$registros[$i] = array();
					array_push($registros[$i], $linha['Codigo_Disciplina']);
					array_push($registros[$i], $linha['Nome']);
					array_push($registros[$i], $linha['Descricao']);
				}
		
				return $registros;
			} catch (PDOException $e) {
				echo "Erro: ".$e->getMessage();
			}
		}
	?>

	</body>

</html>
