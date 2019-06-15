<?php

require_once "autoload.php";
include "conf/conf.inc.php";

#### Recebimento dos dados #########################################################################

if ( isset($_GET['acao']) ) {
	$acao = $_GET['acao'];
} else if ( isset($_POST['acao']) ) {
	$acao = $_POST['acao'];
} else {
	$acao = '';
}

echo "Ação: ".$acao."<br>";

$matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$senhaSHA1 = isset($_POST['senha']) ? sha1($_POST['senha']) : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';
$tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : '';
$ultimo_login = isset($_POST['ultimo_login']) ? $_POST['ultimo_login'] : '';

echo "Matrícula: ".$matricula."<br>";
echo "Senha: ".$senha."<br>";
echo "Senha (sha1): ".$senhaSHA1."<br>";
echo "Nome: ".$nome."<br>";
echo "Data de nascimento: ".$data_nascimento."<br>";
echo "Tipo de usuário: ".$tipo_usuario."<br>";
echo "Último login: ".$ultimo_login."<br>";

#### Criação do objeto #############################################################################

if ($tipo_usuario == $tb_alunos) {
	$usuario = new Aluno;
} else if ($tipo_usuario == $tb_professores) {
	$usuario = new Professor;
}

$usuario->setMatricula($matricula);
$usuario->setSenha($senhaSHA1);
if ($acao == 'cadastrar') {
	$usuario->setDataNascimento($data_nascimento);
	$usuario->setNome($nome);
} else if ($acao == 'login') {
	$usuario->setUltimoLogin($ultimo_login);
}
echo "<br>[Usuário] ".$usuario."<br>";

####################################################################################################

if ($acao == 'cadastrar') {
	/*O objeto terá que ser armazenado numa seção para poder ser acessado na página de PDO*/
	$_SESSION['objeto_pdo'] = $usuario;
	header('location:pdo.php?acao=insert');
}
	


?>