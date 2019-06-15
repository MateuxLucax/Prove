<?php

include "conf/conf.inc.php";

function matrizClassesTabelas () {
	$matriz = array (
		array ('Aluno', $tb_alunos),
		array ('Professor',$tb_professores)
		// falta adicionar ainda
	);

	return $matriz;
}

?>