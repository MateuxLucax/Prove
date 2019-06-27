<?php
	include 'valida_secao.php';
	include 'professores_pdo.php';
	$registros = selectPDO();

	// Isola a coluna de matrículas do "SELECT * FROM Professor" em um array
	$matriculas = array();
	for ($i=0; $i < count($registros); $i++) { 
		array_push($matriculas, $registros[$i][0]);
	}
	//var_dump($matriculas);

	//Verifica se a matrícula da seção está no array de matrículas (existe no banco de dados na tabela de Professor)
	$existeNoBD = in_array($_SESSION['matricula'], $matriculas);
	if (!$existeNoBD) header('entrar.php?erro=2');
?>

