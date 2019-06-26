<?php 
 include 'connect/connect.php';

 $acao = '';
 if (isset($_GET["acao"]))
 	$acao = $_GET["acao"];

 if ($acao == "logoff"){
 	session_start();
 	session_destroy();
 	header("location:login.php");
 }else{
 	if (isset($_POST["acao"])){
 		$acao = $_POST["acao"];
 		if ($acao == "login"){
 			$user = $_POST['user'];
 			$senha = $_POST['pass'];
 			logar($user,$senha);
 		}
 	}
 }

 function logar($user,$senha){
 	$sql = "SELECT * FROM ".$GLOBALS['login']. " WHERE usuario = '$user'";
 	$result = mysqli_query($GLOBALS['conexao'],$sql);
 	$senhaBD = "";
 	$usuario = "";
 	$nome = "";
 	$dataUltima = "";

 	while ($row = mysqli_fetch_array($result)){
 		$senhaBD = $row['senha'];
 		$usuario = $row['usuario'];
 		$nome = $row['nome'];
 		$dataUltima = date('Y-m-d');
 		$codigo = $row['codigo'];
 	}

 	$senha = sha1($senha);
 	if ($senha == $senhaBD) {
 		session_start();
 		$_SESSION['usuario'] = $usuario;
 		$_SESSION['nome'] = $nome;

 		$sql = "UPDATE ".$GLOBALS['login']. " SET usuario = '". $user. "',
	          dataUltima = '".$dataUltima ."'
	          WHERE codigo = ".$codigo;
	    echo $sql;
	    $result = mysqli_query($GLOBALS['conexao'], $sql);

	    $_SESSION['dataUltima'] = $dataUltima;

 		header("location:index.php");
 	}else{
 		header("location:login.php");
 	}
 }
?>