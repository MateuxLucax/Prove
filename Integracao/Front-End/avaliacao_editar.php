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

	<!-- CSS -->
	<link href="assets/css/login/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
	<div class="container">
		
		<?php if($codigo != '') { ?>

			<form action="avaliacao_pdo.php" method="post" class="card-panel">
				<div class="input-field col s12">
					<label for="conteudo">Conteúdo</label>
					<input type="text" name="conteudo" id="conteudo" value="<?php echo $conteudo; ?>">
				</div>

					<div class="input-field col s12">   
					<input type="text" name="dataInicio" id="dataInicio" value="<?php echo $data_inicio; ?>">
					<span class="helper-text">Data início</span>
				</div>

				<div class="input-field col s12">   
					<input type="text" name="dataFim" id="dataFim" value="<?php echo $data_fim; ?>">
					<span class="helper-text">Data fim</span>
				</div>

				<div class="input-field col s12">
					<?php gerarSelect($tb_disciplinas, 'Disciplina_Codigo_Disciplina', 0, 'Codigo_Disciplina', 'Nome'); ?>
				</div>
				
				<div class="input-field col s12">   
					<div class="switch">Embaralhar <br/>
						<label for="embaralhar">Não
							<input type="checkbox" name="embaralhar" id="embaralhar" value="<?php echo $embaralhar; ?>">
							<span class="lever"></span>
							Sim</label>
					</div>
				</div>

				<input type="hidden" name="Codigo_Avaliacao" value="<?php echo $codigo; ?>">
				<button type="submit" name="acao" value="editar" class="btn black waves-effect waves-light">Editar</button>
			</form>

			<div id="addQuestao" class="card-panel teal-text">
				<div class="row">
					<div class="col s12">
						<ul class="tabs">
							<li class="tab col s4"><a href="#discursiva">Discursiva</a></li>
							<li class="tab col s4"><a href="#unicaesc">Única Escolha</a></li>
							<li class="tab col s4"><a href="#vouf">Verdadeiro ou Falso</a></li>
						</ul>
					</div>
				</div>

				<div id="discursiva">
					<form action="avaliacao_pdo.php" method="post">
						<div class="input-field col s12">
							<textarea name="Texto" id="Texto" class="materialize-textarea"></textarea>
							<label for="Texto">Texto</label>
						</div>

						<div class="input-field col s12">
							<input name="Enunciado" id="Enunciado" class="validate">
							<label for="Enunciado">Enunciado</label>
						</div>

						<input type="hidden" name="Tipo_Codigo" value="1">

						<input type="hidden" name="Avaliacao_Codigo_Avaliacao" value="<?php echo $codigo; ?>">

						<div class="center-align">
							<button type="submit" name="acao" class="btn green" value="cadastrar_questao">Cadastrar</button>
						</div>
					</form>

				</div>
	   			<div id="unicaesc" class="col s12">B</div>
	   			<div id="vouf" class="col s12">C</div>
	   			
	   		</div>
			
			<div id="questoes">
				<?php
					$questoes = selectPDO_avalques($codigo);
					selectPDO_avalques_table($questoes);
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