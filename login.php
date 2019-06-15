<!DOCTYPE html>


<?php
include 'conf/conf.inc.php';

session_start();

if(isset($_SESSION['matricula'])){
	header("location:index.php");
}

$title="Login";
?>


<html>
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8">
</head>


<body>

	<form action="criaObjetoUsuario.php" method="post">
	<fieldset>
		<legend>Login</legend>
		
		<label for="matricula">Matrícula</label><br>
		<input type="text" name="matricula" id="matricula" value=""><br><br>

		<label for="senha">Senha</label><br>
		<input type="password" name="senha"><br><br>

		<label for="tipoUsuario">Tipo de usuário </label><br>
		<input type="radio" name="tipoUsuario" id="tipoUsuario" value="<?php echo $tb_alunos ?>">Aluno
		<input type="radio" name="tipoUsuario" id="tipoUsuario" value="<?php echo $tb_professores ?>">Professor

		<input type="hidden" name="ultimoLogin" value="<?php date('Y-m-d H:i:s') ?>"><br><br>

		<button name="acao" value="login" id="login" type="submit">Entrar</button>
	</fieldset>
	</form>

	<hr>

	<form action="criaObjetoUsuario.php" method="post">
	<fieldset>
		<legend>Cadastro</legend>
		
		<label for="matricula">Matrícula</label><br>
		<input type="text" name="matricula" id="matricula" value=""><br><br>

		<label for="senha">Senha</label><br>
		<input type="password" name="senha"><br><br>

		<label for="nome">Nome</label><br>
		<input type="text" name="nome"><br><br>

		<label for="data_nascimento">Data de nascimento</label><br>
		<input type="date" name="data_nascimento"><br><br>

		<label for="tipo_usuario">Tipo de usuário </label><br>
		<input type="radio" name="tipo_usuario" id="tipo_usuario" value="<?php echo $tb_alunos ?>">Aluno
		<input type="radio" name="tipo_usuario" id="tipo_usuario" value="<?php echo $tb_professores ?>">Professor<br><br>

		<button name="acao" value="cadastrar" id="cadastrar" type="submit">Cadastrar</button>
	</fieldset>
	</form>

</body>
</html>