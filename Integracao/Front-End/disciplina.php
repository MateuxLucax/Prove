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
		echo "Código: ".$codigo;
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

	<?php selectPDO_disc_table($registros); ?>

	<h1><?php echo $serie ?> - <?php echo $nome; ?></h1>

	<div id="professores">
		<?php $reg_prof = selectPDO_discprof($codigo);
			selectPDO_discprof_table($reg_prof); ?>
		<button>Adicionar professor</button> <- deve abrir modal etc.
	</div>

	<div id="alunos">
	</div>

	<div id="avaliacoes">
	</div>

	<?php } else { ?>
		<p><b>Erro:</b> A página não recebeu o código de uma disciplina</p>
	<?php } ?>
</body>
</html>