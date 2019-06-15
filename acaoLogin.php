<?php
	include 'connect/connect.php';

	if (isset($_GET['acao']))
		$acao = $_GET['acao'];
	else if (isset($_POST['acao']))
		$acao = $_POST['acao'];
	else
		$acao = '';

	if ($acao == "logoff") {
		session_start();
		session_destroy();
		header("location:login.php");
	}
	else if ($acao == "login") {
		$matricula = $_POST['matricula'];
		$senha = $_POST['senha'];
		$tipoUsuario = $_POST['tipoUsuario'];
		$ultimoLogin = $_POST['ultimoLogin'];
		logar($matricula,$senha,$tipoUsuario);
	}



	function logar($matricula, $senha, $tipo) {
		/*A variável $tipo deve receber o nome da tabela ('Alunos' ou 'Professores') tal como está escrito no conf.inc.php (já funciona assim no form da página login.php, onde o value de cada input é <?php echo $tb_alunos ou $tb_professores ?>) -- ou seja, por isso "SELECT * FROM $tipo" deve funcionar */
		$sql = "SELECT * FROM ".$tipo." WHERE Matricula = '".$matricula."'";
		#echo $sql;
		$result = mysqli_query($GLOBALS['conexao'],$sql);

		while ($row = mysqli_fetch_array($result)) {
			$senhaBD = $row['Senha'];
			$matricula = $row['Matricula'];
			$nome = $row['Nome'];
		}

		$senha = sha1($senha);

		if ($senha == $senhaBD) {
			session_start();
			$_SESSION['matricula'] = $matricula;
			$_SESSION['nome'] = $nome;

			header("location:index.php");
		} else {
			header("location:login.php");
		}
	}
?>