<!DOCTYPE html>
<?php include 'conf/conf.inc.php'; 
	  include 'connect/connect.php';
?>
<html>
<head>
	<title><?php echo $tittle; ?></title>
</head>
<body>
<?php 
	include 'menu.php';
 ?>
 <a href="acaoLogin.php?acao=logoff">sair</a>
 <br><br><br>
 <h1> BEM VINDO </h1>

 <?php 


 	$sql = "SELECT * FROM login";
	echo $sql."<br/>";
	$result = mysqli_query($conexao, $sql);
	echo $_SESSION['dataUltima'].'<br/>';
 ?>

</body>
</html>