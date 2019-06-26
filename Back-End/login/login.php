<!DOCTYPE html>
<?php 
	session_start();
	if (isset($_SESSION['usuario'])) 
		header("location:index.php");
 ?>
<html>
<head>
	<meta charset="utf-8">
	<title> Login </title>
</head>
<body>
<form action="acaoLogin.php" id="form" method="post">
	<fieldset>
		<legend>Autenticação</legend>

		<!--<label for="nome">Nome</label>
		<input type="text" name="nome" id="nome" value=""><br/><br/>-->

		<label for="user">Usuário</label>
		<input type="text" name="user" id="user" value=""><br/><br/>

		<label for="pass">Senha</label>
		<input type="password" name="pass" id="pass" value=""><br/><br/>

		<hr/><label for="datahj">Data hoje:</label><br/>
        <input type="text" name="n6" id="n6" placeholder="Data hoje"  required = "true" readonly value="<?php echo date('d/m/Y') ?>"><br/><br/>

		<button name="acao" value="login" id="login" type="submit">Entrar</button>
		&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
		<a href="cadUser.php">Não tenho cadastro</a>
	</fieldset>
</form>
</body>
</html>