<!DOCTYPE html>
<?php
	include 'conf.php';
	include 'funcoes.php';
	include 'valida_secao_professor.php'; //Deve ser incluído em todas as páginas restritas para usuários do tipo Professor (E não é necessário incluir valida_secao.php também: valida_secao_professor.php já inclui valida_secao.php)
	include 'disciplinas_pdo.php';

	if (isset($_POST['acao'])) $acao = $_POST['acao'];
	else if (isset($_GET['acao'])) $acao = $_GET['acao'];
	else $acao = '';

	if($acao == 'editar_disciplina') {
		if(isset($_GET['codigo'])) $codigo = $_GET['codigo'];
		$reg_disc_edit = selectPDO_disc('Codigo_Disciplina', $codigo);
		//selectPDO_disc_table($reg_disc_edit);
	}

	if(isset($reg_disc_edit)) {
		$nome = $reg_disc_edit[0][1];
		$codigo_serie = $reg_disc_edit[0][2];
	} else {
		$nome = '';
		$codigo_serie = 1;
	}
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
		<link href="assets/css/login/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	</head>

	<body>
		<?php printHeader(); /*include 'funcoes.php'; lá em cima*/ ?>

		<main>
			<div class="container">
				<form action="disciplinas_pdo.php" method="post">
					<div class="input-field col s12">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" value="<?php echo $nome; ?>">
					</div>
					<div class="input-field col s12">
						<?php gerarSelect($tb_series, 'Serie_Codigo_Serie', $codigo_serie , 'Codigo_Serie', 'Descricao'); //funcoes.php ?> 
					</div>

					<?php if($acao == 'editar_disciplina') { ?>
						<input type="hidden" name="codigo" id="codigo" value="<?php echo $codigo; ?>">

						<div class="input-field col s12">
							<label for="Professores_Matricula">Adicionar professores</label>
							<?php gerarSelect($tb_professores, 'professor', 1, 'Matricula', 'Nome'); ?>

						</div>
					<?php } ?>

					<div class="input-field col s12">

						<?php if($acao != 'editar_disciplina') { ?>
							<button type="submit" name="acao" id="acao" value="cadastrar" class="btn waves-effect waves-light">Cadastrar</button>

						<?php } else { ?>
							<button type="submit" name="acao" id="acao" value="editar" class="btn waves-effect waves-light">Editar</button>
						<?php } ?> 

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