<?php
function printHeader() {
	?>
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
				<li><a href="entrar.php">Entrar</a></li>
				</ul>
			</div>
			</nav>
		</div>
		
		<ul class="sidenav" id="sidenav-mobile">
			<li><a href="./"><i class="material-icons">home</i>Home</a></li>
			<li><a href="sobre.html"><i class="material-icons">info</i>Sobre</a></li>
			<li><a href="entrar.php"><i class="material-icons">account_circle</i>Entrar</a></li>
		</ul>
	
	</header>
	<?php
}
?>