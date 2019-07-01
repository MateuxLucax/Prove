<!DOCTYPE html>
<?php
	include 'series_pdo.php';

	if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
	} else if (isset($_POST['codigo'])) {
		$codigo = $_POST['codigo'];
	} else {
		$codigo = '';
	}

	$title = "Série: ";

	if (isset($codigo)) {
		$registros = selectPDO_serie('Codigo_Serie', $codigo); 
		$descricao = $registros[0][1];
		$title .= $descricao;
	}

?>
<html>
<head>
	<title><?php echo $title; ?></title>
</head>
<body>
	<?php
	if($codigo == '') {
		echo "<p><b>ERRO: </b> A página não recebeu o código de nenhuma série. </p>";
	} else {
		?>


		<main>

			<h1><?php echo $descricao ?></h1>

			<div id="disciplnas">
				<h4>Disciplinas:</h4>
				<?php
					$reg_disc = selectPDO_seriedisc($codigo);
					selectPDO_seriedisc_table($reg_disc);
				?>
			</div>

		</main>


		<?php 
	}
	?>
</body>
</html>