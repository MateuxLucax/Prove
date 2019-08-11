<!DOCTYPE html>

<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Painel de controle - Prove</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/img/favicon.png" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- CSS -->
  <link href="../assets/css/general.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../assets/css/custom/disciplinas.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
</head>

<body>
  <header>

	<!-- Cabeçalho -->
	<div class="hide-on-large-only">
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper">
					<a href="../" class="brand-logo"><img src="../assets/img/logo.svg" alt="Prove"></a>
					<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				</div>
			</nav>
		</div>
	</div>
      
	<ul class="sidenav" id="mobile-navbar">
		<li><center><img src="../assets/img/logo.svg" class="logo-sidenav"></center></li>
		<li><a href="../">Home</a></li>
		<li><a href="../sobre">Sobre</a></li>
		<li><a data-target="login" class="modal-trigger">Entrar</a></li>
	</ul>

	<ul id="slide-out" class="sidenav sidenav-fixed">
		<li><center><img src="../assets/img/logo.svg" class="logo-sidenav logo-sidenav-fixed"></center></li>
		<li><a class="waves-effect" href="../">Home</a></li>
		<li><a class="waves-effect"  href="../sobre">Sobre</a></li>
		<li><a data-target="login" class="modal-trigger waves-effect">Entrar</a></li>
		<li><div class="divider"></div></li>
		<li><a class="subheader">Turmas</a></li>
		<li><a class="waves-effect" href="#3 INFO">3 INFO</a></li>
	</ul>
	
  	<div id="login" class="modal modal-login">
		<form action="../entrar.php">
			<div class="modal-login-box">
				<center>
					<img src="../assets/img/avatar-white.svg" class="modal-login-avatar">
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
						<p class="prove-text text-branco">Ainda não é cadastrado? <a class="modal-login-link" href="../cadastro">Cadastre-se aqui</a></p>
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
    <div class="section">
		<div class="row">
			<div class="col s12">
				<h3 class="title prove-text center">Painel de controle</h3>
			</div>
		</div>
		<div class="disciplinas">
			<div class="row scrollspy"  id="3 INFO">
				<div class="col s12">
					<h4 class="title prove-text text-verde">3 INFO</h4>
					<div class="row">
						<div class="col s12 m6 l4">
							<div class="card hoverable">
								<div class="card-content">
									<a href=""><span class="card-title title-minor">Programação</span></a>
									<p>Próximas provas: </p>
									<p><a href="#">POO - 10/09 as 10:00</a></p>
									<p><a href="#">PDO - 10/09 as 10:00</a></p>
								</div>
								<div class="card-action center">
									<a href="#" class="tooltipped" data-position="bottom" data-tooltip="Alunos"><i class="material-icons">group</i></a>
									<a href="#" class="tooltipped" data-position="bottom" data-tooltip="Gráficos"><i class="material-icons">pie_chart</i></a>
									<a href="#" class="tooltipped" data-position="bottom" data-tooltip="Provas"><i class="material-icons">ballot</i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
  </main>

  <footer class="page-footer">
    <div class="footer-copyright">
	  <a class="disciplinas-footer" target="_blank" href="https://github.com/MateuxLucax/Prove">Prove</a>
      <a class="disciplinas-footer" target="_blank" href="https://opensource.org/licenses/MIT">MIT License</a>
    </div>
  </footer>

  <!--  Scripts-->
  <script src="../assets/js/materialize.min.js"></script>
  <script>
	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.collapsible');
		var instances = M.Collapsible.init(elems, {accordion: false});{
 	   	var elems = document.querySelectorAll('.scrollspy');
		var instances = M.ScrollSpy.init(elems, { scrollOffset: 0});
		var elems = document.querySelectorAll('.tooltipped');
		var instances = M.Tooltip.init(elems);
	});
  </script>
  <script src="../assets/js/init.js"></script>

  </body>

</html>