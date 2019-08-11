<!DOCTYPE html>

<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Home - Prove</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/img/favicon.png" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CSS -->
  <link href="assets/css/general.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>
  <header>

	<!-- Cabeçalho -->
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper container">
			<a href="./" class="brand-logo"><img src="assets/img/logo.svg" alt="Prove"></a>
			<a href="#" data-target="mobile-navbar" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a class="active" href="./">Home</a></li>
				<li><a href="sobre">Sobre</a></li>
  			<li><a data-target="login" class="modal-trigger">Entrar</a></li>
			</ul>
			</div>
		</nav>
	</div>
      
	<ul class="sidenav" id="mobile-navbar">
		<li><a class="waves-effect"  class="active" href="./">Home</a></li>
		<li><a class="waves-effect"  href="sobre">Sobre</a></li>
		<li><a class="waves-effect"  data-target="login" class="modal-trigger">Entrar</a></li>
	</ul>

  	<div id="login" class="modal modal-login">
		<form action="entrar.php">
			<div class="modal-login-box">
				<center>
					<img src="assets/img/avatar-white.svg" class="modal-login-avatar">
				</center>
				<h4 class="title prove-text text-branco center">Entrar</h4>
				<div class="row">
					<div class="col s12">
						<div class="input-field">
							<input id="matricula" type="text" class="validate">
							<label for="matricula">Matrícula</label>
						</div>
					</div>
					<div class="col s12">
						<div class="input-field">
							<input id="senha" type="password" class="validate">
							<label for="senha">Senha</label>
						</div>
					</div>
					<div class="col s12">
						<p class="prove-text text-branco">Ainda não é cadastrado? <a class="modal-login-link" href="cadastro">Cadastre-se aqui</a></p>
					</div>
				</div>
				<div class="row">
					<div class="col s12 center">
						<button type="sumbmit" class="modal-close btn modal-login-btn">Entrar</button>
					</div>
				</div>
			</div>
		</form>
  	</div>

  </header>

  <main>
  </main>

  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span class="left" id="copyright-js"></span> &nbsp; <a target="_blank" href="https://github.com/MateuxLucax/Prove">Prove</a>
        <span class="right"><a target="_blank" href="https://opensource.org/licenses/MIT">MIT License</a></span>
      </div>
    </div>
  </footer>

  <!--  Scripts-->
  <script src="assets/js/materialize.min.js"></script>
  <script src="assets/js/init.js"></script>

  </body>

</html>