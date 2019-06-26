<?php
	// Inicialização / conexão PDO
	$pdo = new PDO('mysql:host=localhost;dbname=prove_sistema_avaliacao',"root","");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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