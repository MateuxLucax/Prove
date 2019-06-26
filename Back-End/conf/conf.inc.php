<?php
	date_default_timezone_get('America/Sao_Paulo');

	// Banco de Dados para configuração
	// $url deve ser diferente?
	$url = "127.0.0.1";
	$dbname = "prove_sistema_avaliacao";
	$usuario = "root";
	$password = "";
 
	// Tabelas do Banco de Dados
	$tb_alunos = "Alunos";
	$tb_professores = "Professores";

	// Matriz que relaciona tabelas do banco de dados com as classes
	$matrizClassesTb = array(
		array('Aluno',$tb_alunos),
		array('Professor',$tb_professores)
		//faltam outros
	);
?>