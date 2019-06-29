<?php
include 'conf.php';
include 'connect/connect.php';

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
				<?php if(isset($_SESSION['matricula'])) { ?>
					<li><a href="logoff.php">Sair</a></li>
				<?php } else { ?>
					<li><a href="entrar.php">Entrar</a></li>
				<?php } ?>
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

function gerarSelect($tabela, $selectName, $codigo, $value, $texto) {
	$sql = "SELECT * FROM $tabela";

	$result = mysqli_query($GLOBALS['conexao'], $sql);

	echo "<select name='$selectName'>";
	while ($row = mysqli_fetch_array($result)) {

		echo "<option value=".$row["$value"].">".$row["$texto"]."</option>";
		
	}
	echo "</select>";
}

function gerarSelectMultiple($tabela, $selectName, $value, $texto) {
	$sql = "SELECT * FROM $tabela";

	$result = mysqli_query($GLOBALS['conexao'], $sql);

	echo "<select multiple name='".$selectName."[]' class='form-control'>";
	while ($row = mysqli_fetch_array($result)) {
		echo "<option value=".$row["$value"]." ".$selected.">".$row["$texto"]." (#".$row["$value"].")</option>";
	}
	echo "</select>";
}
?>