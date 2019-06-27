<?php
session_start();

include 'conf.php';

if (isset($_POST['acao'])) $acao = $_POST['acao'];
else if (isset($_GET['acao'])) $acao = $_GET['acao'];
else $acao = '';

require_once "autoload.php";

#### Construção do objeto ##########################################################################

if (!$acao == '') {	
	echo "Ação: ".$acao."<br>";
	
	$disc = new Disciplina;
	if(isset($_POST['codigo'])) $disc->setCodigo($_POST['codigo']);
	if(isset($_POST['nome'])) $disc->setDescricao($_POST['nome']);
	if(isset($_POST['Serie_Codigo_Serie'])) $serie_codigo = intval($_POST['Serie_Codigo_Serie']);
	echo $disc;
	//echo "Senha: ".$_POST['senha'];
}

#### PDO ###########################################################################################

$pdo = new PDO('mysql:host=localhost;dbname=prove_sistema_avaliacao',"root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
	switch ($acao) {
		case 'cadastrar':
			insertPDO();
			break;
		case 'editar':
			updatePDO();
			break;
		case 'deletar':
			deletePDO();
			break;
	}	
} catch (PDOException $e) {
	echo "Erro: ".$e->getMessage();
}

#### Funções ###############################################

function selectPDO($criterio = 'Nome', $pesquisa = '') {
	try {
		$sql = "SELECT * FROM ".$GLOBALS['tb_disciplinas']." WHERE ".$criterio." ";
		if ($criterio == 'Nome') 
			$sql .= " like '%".$pesquisa."%'";
		else $sql .= ' = '.$pesquisa;
		$sql .= ";";
		//var_dump($sql); echo "<br>";

		$consulta = $GLOBALS['pdo']->query($sql);

		$registros = array();

		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			$registros[$i] = array();
			array_push($registros[$i], $linha['Codigo_Disciplina']);
			array_push($registros[$i], $linha['Nome']);
			array_push($registros[$i], $linha['Serie_Codigo_Serie']);
		}

		return $registros;
	} catch (PDOException $e) {
		echo "Erro: ".$e->getMessage();
	}
}

function selectPDOtable ($registros) {
	# $registros deve ser o retorno da função selectPDO()
	# ou seja, poderia-se chamar essa função assim: prinSelectPDOasTable(selectPDO());
	/*A função de select do PDO só retorna os valores da tabela em uma matriz
	A função printSelectTable imprime os dados da matriz em uma tabela*/
	
	echo "<table class='highlight centered responsive-table'>
	<thead class='black white-text'>
	<tr>
		<th>Código</th>
		<th>Nome</th>
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

function insertPDO() {
	$stmt = $GLOBALS['pdo']->prepare("INSERT INTO ".$GLOBALS['tb_disciplinas']." (Nome, Serie_Codigo_Serie) VALUES (:Nome, :Serie_Codigo)");

	$stmt->bindParam(':Nome', $nome);
	$stmt->bindParam(':Serie_Codigo', $serie_cod);
	
	$nome = $GLOBALS['disc']->getDescricao();
	$serie_cod = $GLOBALS['serie_codigo'];

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();


	// Quando um professor cria uma disciplina, ele deve ser automaticamente registrado nela
	
	echo '..'.$_SESSION['matricula'].'..';

	$stmt2 = $GLOBALS['pdo']->prepare("INSERT INTO ".$GLOBALS['tb_disc_prof']." (Professores_Matricula, Disciplina_Codigo_Disciplina) VALUES (:Professores_Matricula, :Disciplina_Codigo)");
	$stmt2->bindParam(':Professores_Matricula', $_SESSION['matricula']);
	$stmt2->bindParam(':Disciplina_Codigo', $codigo);

	$matricula = $_SESSION['matricula'];
	$codigo = proxCodigo();

	$stmt2->execute();

	echo "Linhas afetadas: ".$stmt2->rowCount();
}

function proxCodigo() {
	// Devido ao fato de que, em seguida do cadastro da disciplina, se cadastra, na tabela n:n, o professor que acabou de criar a disciplina, se torna necessário saber qual será o próximo código que o MySQL geraria pelo auto_increment
	$registros = selectPDO();
	$codigos = array();
	for ($i=0; $i < count($registros); $i++) { 
		array_push($codigos, $registros[$i][0]);
	}
	sort($codigos);
	return $codigos[(count($codigos)-1)];
}



function updatePDO() {
	$stmt = GLOBALS['pdo']->prepare("UPDATE ".$GLOBALS['tb_disciplinas']." SET Nome = :Nome, Serie_Codigo_Serie = :Serie_Codigo WHERE Codigo = :Codigo");

	$stmt->bindParam(':Codigo', $codigo);
	$stmt->bindParam(':Nome', $nome);
	$stmt->bindParam(':Serie_Codigo', $serie_cod);
	
	$codigo = $GLOBALS['disc']->getCodigo();
	$nome = $GLOBALS['disc']->getDescricao();
	$serie_cod = $GLOBALS['serie_codigo'];

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

function deletePDO() {
	$stmt = $GLOBALS['pdo']->prepare("DELETE FROM ".$GLOBALS['tb_disciplinas']." WHERE Codigo = :Codigo");

	$stmt->bindParam(':Codigo', $codigo);

	$codigo = $GLOBALS['disc']->getCodigo();

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

?>