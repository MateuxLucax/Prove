<!DOCTYPE html>
<?php
	include 'disciplinas_pdo.php';
	include 'conf.php';
	include 'funcoes.php';

	if (isset($_POST['codigo'])) {
		$codigo = $_POST['codigo'];
	} else if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
	}

	if(isset($codigo)) {
		//echo "Código: ".$codigo;
		$registros = selectPDO_disc('Codigo_Disciplina', $codigo); 
		$nome = $registros[0][1];
		$codigo_serie = $registros[0][2];
		$serie = $registros[0][3];
	}
?>
<html>
<head>
	<title>Disciplina: <?php echo $nome; ?> (<?php echo $serie; ?>)</title>
</head>
<body>
	<?php if(isset($codigo)) { ?>

	<?php //selectPDO_disc_table($registros); ?>

	<h1><?php echo $serie ?> - <?php echo $nome; ?></h1>

	<div id="professores">
		<?php $reg_prof = selectPDO_discprof($codigo);
			selectPDO_discprof_table($reg_prof); ?>
		<button>Adicionar professor</button> <- deve abrir modal etc.
		Embaixo: o que deve estar no modal:
		<div id="adicao_professor" style="border:1px solid black; ">
			<form action="disciplinas_pdo.php" method="post">
				<?php gerarSelect($tb_professores, 'matricula', 0, 'Matricula', 'Nome'); ?>
				<input type="hidden" name="disciplina" value="<?php echo $codigo; ?>">
				<button type="submit" name="acao" id="acao" value="add_prof">Adicionar</button>
			</form>
		</div>
	</div>
	<br/><br/><br/><br/><hr/><br/><br/><br/><br/>
	<div id="alunos">
		<?php $reg_alun = selectPDO_discalun($codigo);
			selectPDO_discalun_table($reg_alun); ?> (Substituir essa tabela, gerada por uma função, por uma tabela na própria pagina)
		<button>Adicionar alunos</button> <- deve abrir modal etc. <br/> Abaixo é o que deve estar no modal:</div>
		<div id="adicao_aluno" style="border:1px solid black; ">
			<p>Segure o CTRL para selecionar vários alunos</p>
			<form action="disciplinas_pdo.php" method="post">
				<?php gerarSelectMultiple($tb_alunos, 'matriculas', 'Matricula', 'Nome'); ?>
				<input type="hidden" name="disciplina" value="<?php echo $codigo ?>">
				<button type="submit" name="acao" id="acao" value="add_alun">Adicionar</button>
			</form>
		</div>
	</div>
	<br/><br/><br/><br/><hr/><br/><br/><br/><br/>
	<div id="avaliacoes">
		<?php $reg_aval = selectPDO_discaval($codigo);
			selectPDO_discaval_table($reg_aval); ?>
		<a href="cadastro_avaliacao.php">Adicionar avaliação</a>
	</div>

	<?php } else { ?>
		<p><b>Erro:</b> A página não recebeu o código de uma disciplina</p>
	<?php } ?>
</body>
</html>