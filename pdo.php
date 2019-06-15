<?php

require_once "autoload.php";
include 'conf/conf.inc.php';

# OBS: Algumas informações passadas na função PDO deverão ser alteradas quando o site for pra curvello.com/equipe5
$pdo = new PDO('mysql:host=localhost;dbname=prove_sistema_avaliacao;','root','');


/*Os objetos que devem ser transferidos para a página de PDO são armazenados numa seção
e essa seção é acessada na página de PDO (ex: criaObjetoUsuario)*/
$usuario = $_SESSION['usuario_pdo'];

if ($usuario instanceof Aluno)
	$tb = $tb_alunos;
else if ($usuario instanceof Professor)
	$tb = $tb_professores;

if (isset($_GET['acao'])) $acao = $_GET['acao'];
else if (isset($_POST['acao'])) $acao = $_POST['acao'];
else $acao = '';

try {
	switch ($acao) {
		case 'select':
			selectPDO();
			break;
		case 'insert':
			insertPDO();
			break;
		case 'delete':
			deletePDO();
			break;
		case 'update':
			updatePDO();
			break;
	}
} catch (PDOException $e) {
	echo 'Erro: '.$e->getMessage();
}

####################################################################################################

function selectPDO () {
	$consulta = $GLOBALS['pdo']->query("SELECT * FROM $tb;");
	while ($linha = $consulta->fetch(PDO:FETCH_ASSOC)) {
		echo "Matrícula: {$linha['Matricula']}";
		echo "<br>Senha: {$linha['Senha']}";
		echo "<br>Nome: {$linha['Nome']}";
		echo "<br>Data_Nascimento: {$linha['Data_Nascimento']}";
		echo "<br>Ultimo_Login: {$linha['Ultimo_Login']}";
	}
}

function insertPDO(){
	$stmt = $GLOBALS['pdo']->prepare('INSERT INTO $tb (Matricula, Senha, Nome, Data_Nascimento) VALUES (:matricula,:senha,:nome,:data_nascimento)');
	
}

####################################################################################################


?>