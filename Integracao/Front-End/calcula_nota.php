<!DOCTYPE html>
<?php
	include 'conf.php';
	include 'funcoes.php';
	include 'valida_secao.php';
?>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>Calcula Nota</title>

		<!-- Linkagem para GoogleCharts -->
		<script type="text/javascript" src="js/loader.js"></script>

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.png" />

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- CSS -->
		<link href="assets/css/materialize.css" type="text/css" rel="stylesheet">
	</head>

	<body>
		<?php printHeader(); /*include 'funcoes.php'; lá em cima*/ ?>

        <?php 
			$vetor = array("['Excelente', 1]", "['Ótimo', 4]", "['Bom', 2]", "['Razoável', 1]", "['Ruim', 1]", "['Péssimo', 1]"); //['LEGENDA', NUMERO PARA CALCULO]
			$titulo = 'Desempenho na Prova';
			$div = 'grafico';
		
			
			geraGraficoSetor($vetor, $titulo, $div);


         ?>
		<div id="grafico" style="width: 900px; height: 500px;"></div>

	<br/><br/><br/><br/>


	<?php
		$sql='SELECT Correta FROM alternativa';

	?>




		<footer>
		</footer>

		<!--  Scripts-->
		<script src="assets/js/jquery-2.1.1.min.js"></script>
		<script src="assets/js/materialize.min.js"></script>
		<script src="assets/js/init.js"></script>

	</body>
</html>