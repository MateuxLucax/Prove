<!DOCTYPE html>
<?php
	$matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
	$senha = isset($_POST['senha']) ? sha1($_POST['senha']) : '';
	$tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : '';
?>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">

	<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
	<form action="" method="post" class="container">
		<div class="input-field col s12">
			<i class="material-icons prefix">person</i>
			<label for="matricula">Matrícula</label>
			<input type="text" name="matricula" id="matricula">
		</div>
		<div class="input-field col s12">
			<i class="material-icons prefix">lock</i>
			<label for="senha">Senha</label>
			<input type="password" name="senha" id="senha">
		</div>
	
		<p>
			<label>
				<input type="radio" class="with-gap tipo_usuario" value="aluno" name="tipo_usuario">
				<span>Aluno</span>
			</label>
		</p>
		<p>
			<label>
				<input type="radio" class="with-gap tipo_usuario" value="professor" name="tipo_usuario">
				<span>Professor</span>
			</label>
		</p>


		<button type="submit" class="btn black white-text waves-effect waves-light" name="acao" id="login" value="login">Login</button>
	</form>

	<?php
		if($matricula != '' && $senha != '') {
			if (isset($_GET['acao']))
				$acao = $_GET['acao'];
			else if (isset($_POST['acao']))
				$acao = $_POST['acao'];
			else
				$acao = '';

			if ($acao == 'logoff') {
				session_start();
				session_destroy();
			} else if ($acao == 'login') {
				if($tipo_usuario == 'aluno'){ include 'alunos_pdo.php'; }
				else if($tipo_usuario == 'professor'){ include 'professores_pdo.php'; }

				$linha_usuario = selectPDO('Matricula',$matricula);

				var_dump($linha_usuario);

				if ($senha == $linha_usuario[0][1]) {
					session_start();
					$_SESSION['matricula'] = $matricula;
					$_SESSION['nome'] = $linha_usuario[0][2];
					header("location:teste_login.php");
				} else {
					header("location:login.php?erro=1");
				}
			}
		}
	?>
</body>
</html>