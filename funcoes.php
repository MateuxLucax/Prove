<?php

include 'professores_pdo.php';

printSelectTable() {
	/*A função de select do PDO só retorna os valores da tabela em uma matriz
	A função printSelectTable imprime os dados da matriz em uma tabela*/
	$registros = selectPDO();

	foreach ($regitros[0] as $coluna => $registro) {
		# code...
	}
}

?>