 <!DOCTYPE html>
<?php
    include 'connect/connect.php';
    $titulo = "Integração com BD";
    $tb_tabela = 'login';
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="_css/rede.css">
	<title><?php echo $titulo ?></title>
	<meta charset="utf-8">
    <style>

    </style>  
</head>
<body>
	<center> 
		<div class="postagem">
      <h1>Banco de Dados de Estados</h1>
      <hr>
      <form method="get" action="acaoInserir.php" id="form">
        <input type="hidden" name="tabela" value="<?php echo $tb_tabela ?>">
        <input type="hidden" name="pagina" value="cadUser.php">
        <input type="hidden" name="numero" value="5"><!-- MUDAR PARA QUANTIDADE DE CAMPOS -->

        <label for="nome">Usuário:</label><br/>
        <input type="text" name="n1" id="n1" placeholder="usuario" required = "true" value=""> <br/><br/>

        <hr/><label for="nome">Senha:</label><br/>
        <input type="password" name="n2" id="n2" placeholder="senha" required = "true" value=""> <br/><br/>

        <hr/><label for="nome">Nome:</label><br/>
        <input type="text" name="n3" id="n3" placeholder="nome" required = "true" value=""> <br/><br/>

        <input type="hidden" name="n4" id="n4" placeholder="Data hj"  required = "true" readonly value="<?php echo date('d/m/Y') ?>">
        <input type="hidden" name="n5" id="n5" placeholder="Data hj"  required = "true" readonly value="<?php echo date('d/m/Y') ?>">

        
       
        <input type="submit" name="acao" value="salvar">
        &nbsp; &nbsp; &nbsp;
        <a href="index.php">Já tenho cadastro</a>
      </form>
		</div>
	</center>
</body>
</html>
<!--
     create database crud;
use crud;










create table prova (
codigo int primary key auto_increment,
nomepaciente varchar (45),
nomemed varchar (45),
dataconsulta date,
medicamento int,
plano varchar (45),
valor decimal(8,2)
);

insert into prova values
(default, 'Daiane', 'Dr. Bigode', str_to_date('18/10/2001', '%d/%m/%Y'), 0, 'SUS', 150.00),
(default, 'Daniele', 'Dr. Bigode', str_to_date('02/05/2002', '%d/%m/%Y'), 0, 'SUS', 175.00),
(default, 'Julia', 'Dr. Bigode', str_to_date('26/03/2002', '%d/%m/%Y'), 1, 'Particular', 59.99),
(default, 'Rian', 'Dr. Bigode', str_to_date('11/11/2002', '%d/%m/%Y'), 0, 'Social', 378.96),
(default, 'Mateus', 'Dr. Trump', str_to_date('15/07/2001', '%d/%m/%Y'), 1, 'Plano de Saúde', 302.00),
(default, 'Maria', 'Dr. Trump', str_to_date('18/04/2001', '%d/%m/%Y'), 1, 'SUS', 500.00),
(default, 'Franciele', 'Dr. Bigode', str_to_date('25/01/1995', '%d/%m/%Y'), 0, 'Social', 150.00),
(default, 'Kiko', 'Dr. Trump', str_to_date('20/09/2000', '%d/%m/%Y'), 1, 'Plano de Saúde', 60.00),
(default, 'Pituco', 'Dr. Trump', str_to_date('06/01/2005', '%d/%m/%Y'), 0, 'Particular', 90.50),
(default, 'Laira', 'Dr. Trump', str_to_date('25/02/1990', '%d/%m/%Y'), 1, 'Plano de Saúde', 200.00);


select * from prova;


-->