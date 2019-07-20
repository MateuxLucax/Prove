<!DOCTYPE html>
<?php
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
						<a href="serie_cadastro.php"><div class="card-panel teal white-text col s-4"><h6>Criar Série</h4></div></a>
						<a href="disciplina_cadastro.php"><div class="card-panel teal white-text col s-4"><h6>Criar Disciplina</h4></div></a>
						<a href="avaliacao_cadastro.php"><div class="card-panel teal white-text col s-4"><h6>Criar Avaliação</h4></div></a>
					</div>
				<?php } ?>

				<ul class="collapsible">
					<?php
						if (isset($disciplinas) && $contador > 0) {
							for ($i=0; $i < $contador ; $i++) { ?> 
								<li>
	      					<div class="collapsible-header"><i class="material-icons">filter_drama</i> <?php echo $disciplinas[$i][1]; ?> </div>
	      					<div class="collapsible-body">
	      						<?php
	      							$avaliacoes = selectPDO_discaval($disciplinas[$i][0], 'disciplina');

	      							if(count($avaliacoes) > 7) $contador_aval = 7;
	      							else $contador_aval = count($avaliacoes);

	      							echo "<div class=\"collection\">";
	      								echo "<a class=\"collection-item\" href='disciplina.php?codigo=".$disciplinas[$i][0]."'>Ver disciplina</a>";
		      							for ($j=0; $j < $contador_aval; $j++) { ?>
		      								<a href='avaliacao.php?codigo=<?php echo $avaliacoes[$j][2]; ?>' class="collection-item">
		      									<?php echo $avaliacoes[$j][5].' — '.$avaliacoes[$j][3]; ?>
		      								</a>
		      							<?php }
		      						echo "</div>";
	      						?>

	      						<!--<php
	      							$avaliacoes = selectPDO_discaval($disciplinas[$i][0], 'disciplina');
     									for ($i=0; $i < 7; $i++) { ?>
    										
     									?php }
     								?>-->



	      					</div>
	    				</li>
					<?php } }
					?>
				</ul>
				


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
		function selectDisciplinas($matricula,$tipo) {
			$pdo = new PDO('mysql:host=localhost;dbname=prove_sistema_avaliacao',"root","");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try {
				if($tipo == 'aluno') {
					$sql = 'select D.Codigo_Disciplina, D.Nome FROM '.$GLOBALS['tb_alunos'].' A, '.$GLOBALS['tb_disciplinas'].' D, '.$GLOBALS['tb_disc_alun'].' AD
					WHERE AD.Alunos_Matricula = A.Matricula
					AND AD.Disciplina_Codigo_Disciplina = D.Codigo_Disciplina
					AND A.Matricula = \''.$matricula.'\' ';
				} else {
					$sql = 'select D.Codigo_Disciplina, D.Nome FROM '.$GLOBALS['tb_professores'].' P, '.$GLOBALS['tb_disciplinas'].' D, '.$GLOBALS['tb_disc_prof'].' PD
					WHERE PD.Professores_Matricula = P.Matricula
					AND PD.Disciplina_Codigo_Disciplina = D.Codigo_Disciplina
					AND P.Matricula = \''.$matricula.'\' ';
				}

				//var_dump($sql); echo "<br>";
		
				$consulta = $GLOBALS['pdo']->query($sql);
		
				$registros = array();
		
				for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
					$registros[$i] = array();
					array_push($registros[$i], $linha['Codigo_Disciplina']);
					array_push($registros[$i], $linha['Nome']);
				}
		
				return $registros;
			} catch (PDOException $e) {
				echo "Erro: ".$e->getMessage();
			}
		}
	?>

	</body>

</html>
