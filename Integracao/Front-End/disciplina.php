<!DOCTYPE html>

<!-- ####################### ( SÓ VISUALIZA ) ##############################  -->
<?php
    //session_start();
    // echo $_SESSION['matricula'];

    include 'valida_secao.php';
	include 'disciplinas_pdo.php';
	include 'conf.php';
	include 'funcoes.php';

	if (isset($_POST['codigo'])) {
		$codigo = $_POST['codigo'];
	} else if (isset($_GET['codigo'])) {
		$codigo = $_GET['codigo'];
	}

	if(isset($codigo)) {
		//echo "Código: ".$codigo;
		$registros = selectPDO_disc('Codigo_Disciplina', $codigo); 
		$nome = $registros[0][1];
		$codigo_serie = $registros[0][2];
		$serie = $registros[0][3];
	}
?>
<html>
<head>
	<title>Disciplina: <?php echo $nome; ?> (<?php echo $serie; ?>)</title>
</head>
<body>
	<?php if(isset($codigo)) { ?>

	<?php //selectPDO_disc_table($registros); ?>

	<h1><?php echo $serie ?> - <?php echo $nome; ?></h1>

	<div id="professores">
		<?php $reg_prof = selectPDO_discprof($codigo);
			discprof_table ($reg_prof); ?>
	</div>
	<br/><br/><br/><br/><hr/><br/><br/><br/><br/>
	<div id="alunos">
		<?php $reg_alun = selectPDO_discalun($codigo);
            
            
            discalun_table($reg_alun); ?> (Substituir essa tabela, gerada por uma função, por uma tabela na própria pagina)
		
		<div id="adicao_aluno" style="border:1px solid black; ">
			<p>Segure o CTRL para selecionar vários alunos</p>
			<form action="disciplinas_pdo.php" method="post">
				<?php gerarSelectMultiple($tb_alunos, 'matriculas', 'Matricula', 'Nome'); ?>
				<input type="hidden" name="disciplina" value="<?php echo $codigo ?>">
			</form>
		</div>
	</div>
	<br/><br/><br/><br/><hr/><br/><br/><br/><br/>
	<div id="avaliacoes">
		<?php $reg_aval = selectPDO_discaval($codigo, 'disciplina');
			discalun_table($reg_aval); ?>
	</div>
        



		<br/><br/><br/>
		<a href="disciplina_editar.php?codigo=<?php echo $codigo; ?>">Editar disciplina</a>

        



	<?php } else { ?>
		<p><b>Erro:</b> A página não recebeu o código de uma disciplina</p>
	<?php } ?>

    <?php
        function discalun_table ($registros) {
            echo "<table class='highlight centered responsive-table' border='5'>
            <thead class='black white-text'>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Código</th>
                <th>Disciplina</th>
            </tr>
            </thead>
            <tdbody>";
        
            for ($i=0; $i < count($registros); $i++) {
                echo "<tr>";
                for ($j=0; $j < count($registros[$i]); $j++) { 
                    echo "<td>".$registros[$i][$j]."</td>";
                }
        
                echo "<tr>";
            }
            echo "</tbody>
            </table>";
        }

        function discprof_table ($registros) {
            echo "<table class='highlight centered responsive-table' border='5'>
            <thead class='black white-text'>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Código</th>
                <th>Disciplina</th>
            </tr>
            </thead>
            <tdbody>";
        
            for ($i=0; $i < count($registros); $i++) {
                echo "<tr>";
                for ($j=0; $j < count($registros[$i]); $j++) { 
                    echo "<td>".$registros[$i][$j]."</td>";
                }
                echo "<tr>";
            }
            echo "</tbody>
            </table>";
        }
    ?>
</body>
</html>