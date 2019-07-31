<!DOCTYPE html>
<?php

	if (isset($_POST['codigo'])) {
		$codigo = $_POST['codigo'];
	} else if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
	} else {
		$codigo = '';
	}

	include 'disciplinas_pdo.php';
	include 'avaliacao_pdo.php';
	include 'funcoes.php';
	include 'conf.php';
	date_default_timezone_set('America/Sao_Paulo');

	$registros = selectPDO_discaval($codigo, 'avaliacao');

	if($codigo != '') { 
			
		$cod_disciplina = $registros[0][0];
		$disciplina = $registros[0][1];
		$cod_avaliacao = $registros[0][2];
		$conteudo = $registros[0][3];
		$data_inicio = $registros[0][4];
		$data_fim = $registros[0][5];
		$peso = $registros[0][6];
		$embaralhar = $registros[0][7];

		$title = $disciplina." - ".$conteudo;

	} else {
		$title = '';
	}

?>
<html>
<head>
	<title><?php echo $title ?></title> 
	<meta charset="utf-8">

	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<style type="text/css">
		select { display: block; } /*Tive que colocar, porque por padrão o select estava com display:none por algum motivo*/
	</style>

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
	<div class="container">
		<?php
			function 
		?>
		<?php if($codigo != '') { ?>

			
			
			
			<?php if($_SESSION['tipo'] == 'aluno') {
				$reg_disc_alun = selectPDO_discalun($cod_disciplina);
				$alunos_na_disciplina = array();
				for ($i=0; $i < count($reg_disc_alun); $i++) { 
					array_push($alunos_na_disciplina, $reg_disc_alun[$i][0]);
				}
				if(in_array($_SESSION['matricula'], $alunos_na_disciplina)) {
					?>
					<form action="avaliacao_responder.php" method="post">
						<input type="hidden" name="codigo" value="<?php echo $cod_avaliacao; ?>">
						<input type="hidden" name="matricula" value="<?php echo $_SESSION['matricula']; ?>">
						<button type="submit" class="btn waves-effect waves-light">Responder</button>
					</form>
					<?php
				}
			} ?>





			<div id="info-avaliacao">
			<?php
				echo "<p style='color:lightgrey'>#".$cod_avaliacao."</p>";
				echo "<p><b>Conteúdo:</b> ".$conteudo."</p>";
				echo "<p><b>Disponível entre</b> ".$data_inicio." <b>e</b> ".$data_fim."</p>";
				echo "<p><b>Peso: </b>".$peso."</p>";
				echo "<p><b>Embaralhar questões:</b> ".$embaralhar."</p>";
			?>
			</div>
			
			<hr/>			
			
			<div id="questoes">
				<?php
					$questoes = selectPDO_avalques_all($codigo); //all = todas as questões, incluindo as alternativas e as questões discursivas
					mostrar_questoes($questoes); //função em funcoes
				?>
			</div>

		<?php } else { ?>

			<div id="erro_codigo">
				<p><b>Erro: </b> a página não recebeu nenhum código. Adicione, no final da URL, <code>?codigo=[codigo da disciplina]</code></p>
			</div>

		<?php } ?>
	</div>

	<!--  Scripts-->
	<script src="assets/js/jquery-2.1.1.min.js"></script>
	<script src="assets/js/materialize.min.js"></script>
	<script src="assets/js/init.js"></script>
		
</body>
</html>