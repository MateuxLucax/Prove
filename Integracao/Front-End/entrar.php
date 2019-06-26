<!DOCTYPE html>
<?php
	$matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
	$senha = isset($_POST['senha']) ? sha1($_POST['senha']) : '';
	$tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : '';
?>

<html lang="pt-br">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Entrar - Prove</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/img/favicon.png" />

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- CSS -->
	<link href="assets/css/login/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>
	<header>

		<!-- Cabeçalho -->
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper container">
					<a href="index.php" class="brand-logo"><img src="assets/img/logo.svg" alt="Prove"></a>
					<a href="#" data-target="sidenav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a href="./">Home</a></li>
						<li><a href="sobre.html">Sobre</a></li>
						<li><a class="active" href="entrar.html">Entrar</a></li>
					</ul>
				</div>
			</nav>
		</div>
		
		<ul class="sidenav" id="sidenav-mobile">
			<li><a href="./"><i class="material-icons">home</i>Home</a></li>
			<li><a href="sobre.html"><i class="material-icons">info</i>Sobre</a></li>
			<li><a href="entrar.html"><i class="material-icons">account_circle</i>Entrar</a></li>
		</ul>
	
	</header>
	
	<main>
	<center>

		<div class="valign-wrapper login container">
			<div class="row">

				<div class="col s12">
					<img src="assets/img/avatar.svg" alt="User" class="login--img" />
				</div>
				<div class="col s12" style="margin-top: -2rem"> 
					<h1 class="login--title">Entrar</h1>
				</div>

				<div class="col s12 m6 offset-m3 container">
					<form action="" method="post">
						<input type="hidden" name="ultimo_login" id="ultimo_login" value="<?php echo date('Y-m-d H:i:s'); ?>">
						<div class="row">
							<div class="input-field col s12">
								<input id="matricula" name="matricula" type="text" class="validate">
								<label for="matricula">Matrícula</label>
							</div>
						</div>
						<div class="row" style="margin-top: -2rem">
							<div class="input-field col s12">
								<input id="senha" name="senha" type="password" class="validate">
								<label for="senha">Senha</label>
							</div>
						</div>
						<div class="row" style="margin-top: -2rem">
              <div class="input-field col s12">
                <label>
								  <input type="radio" class="with-gap tipo_usuario" value="aluno" name="tipo_usuario">
									<span>Aluno</span>
								</label>
							</div>
							<div class="input-field col s12">
								<label>
								  <input type="radio" class="with-gap tipo_usuario" value="professor" name="tipo_usuario">
									<span>Professor</span>
								</label>
              </div>
            </div>
            <br/>
						<div class="row" style="margin-top: -2rem">
							<div class="col s12">
								<p><a href="">Esqueci minha senha</a></p>
								<p>Ainda não é cadastrado? <a href="cadastre-se.php">Cadastre-se aqui</a></p>
							</div>
						</div>
						<div class="row">
							<div class="col s12 center">
								<button type="submit" name="acao" value="login" class="waves-effect waves-light btn">Entrar</a>
							</div>
						</div>
					</form>
				</div>

				<?php
					if($matricula != '' && $senha != '') {
						if (isset($_GET['acao'])) $acao = $_GET['acao'];
						else if (isset($_POST['acao'])) $acao = $_POST['acao'];
						else $acao = '';

						if ($acao == 'login') {
							if($tipo_usuario == 'aluno'){ include 'alunos_pdo.php'; }
							else if($tipo_usuario == 'professor'){ include 'professores_pdo.php'; }

							$linha_usuario = selectPDO('Matricula',$matricula);
							//var_dump($linha_usuario);

							if ($senha == $linha_usuario[0][1]) {
								session_start();
								$_SESSION['matricula'] = $matricula;
								$_SESSION['nome'] = $linha_usuario[0][2];
								header("location:index.php");
							} else {
								header("location:entrar.php?erro=1");
							}
						}
					}
				?>

			</div>
		</div>

	</center>
	</main>

	<footer>

	</footer>

	<!--  Scripts-->
	<script src="assets/js/jquery-2.1.1.min.js"></script>
	<script src="assets/js/materialize.min.js"></script>
	<script src="assets/js/init.js"></script>

	</body>

</html>
