<?php
session_start();

require_once "autoload.php";
include "conf/conf.inc.php";
include "funcoes.php";

# OBS: Algumas informações passadas na função PDO deverão ser alteradas quando o site for pra curvello.com/equipe5
$pdo = new PDO('mysql:host=localhost;dbname=prove_sistema_avaliacao;','root','');


/*Os objetos que devem ser transferidos para a página de PDO são armazenados numa seção
e essa seção é acessada na página de PDO (ex: criaObjetoUsuario)*/
$objeto = unserialize($_SESSION['objeto_pdo']); /* O objeto tem que ser inserido na seção como serializado, isto é, convertido para string. A pág de PDO tem que, então, converter de string para objeto - isso se faz com a função unserialize()*/

/* $matrizClassesTb = matriz declarada no conf.inc.php que relaciona as classes com as tabelas do BD*/
for ($i=0; $i < $matrizClassesTb; $i++) {
	if ($objeto instanceof $matrizClassesTb[$i][0]) {
		$tb = $matrizClassesTb[$i][1];
		break;
	}
}

if (isset($_GET['acao'])) $acao = $_GET['acao'];
else if (isset($_POST['acao'])) $acao = $_POST['acao'];
else $acao = '';

/*** TESTES *******//**/
$registros = selectPDO('registros');
$nome_colunas = selectPDO('nome_colunas');

for ($i=0; $i < count($nome_colunas); $i++) { 
	echo $nome_colunas[$i].", ";
} echo "<hr>";

for ($i=0; $i < count($registros); $i++) { 
	foreach ($registros[$i] as $coluna => $registro) {
		echo $coluna."=".$registro."<br>";
	}
	echo "<hr>";
}

insertPDO();
/**//*** FIM TESTES ***/


/*try {
	switch ($acao) {
		case 'select':
			selectPDO();
			break;
		case 'insert':
			insertPDO();
			break;
		case 'delete':
			deletePDO();
			break;
		case 'update':
			updatePDO();
			break;
	}
} catch (PDOException $e) {
	echo 'Erro: '.$e->getMessage();
}*/

####################################################################################################

function selectPDO ($retorno) { /*$retorno:descrição do que o select deve retornar*/
	$consulta = $GLOBALS['pdo']->query("SELECT * FROM ".$GLOBALS['tb']);
	
	$campos = array();
		for ($i=0; $i < $consulta->columnCount(); $i++) { 
			$col = $consulta->getColumnMeta($i);
			array_push($campos, $col['name']);
		}
	if($retorno == 'nome_colunas') 
		return $campos;

	$registros = array();
	for ($i=0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) { 
		for ($j=0; $j < count($campos); $j++) { 
			$registros[$i][$campos[$j]] = $linha[$campos[$j]];
		}
	}
	if($retorno == 'registros')
		return $registros;
}

function insertPDO(){
	$nomeColunas = selectPDO('nome_colunas');
	$sql = "INSERT INTO ".$GLOBALS['tb']." (";
	for ($i=0; $i < count($nomeColunas); $i++) { 
		$sql .= $nomeColunas[$i];
		if ($i != (count($nomeColunas)-1) ) {
			$sql .= ",";
		}
	}
	$sql .= ")";
	//echo $sql;
	$sql .= " VALUES (";
	for ($i=0; $i < count($nomeColunas); $i++) { 
		$sql .= ":".$nomeColunas[$i];
		if ($i != (count($nomeColunas)-1) ) {
			$sql .= ",";
		}
	}
	$sql .= ")";
	//echo $sql;

	$stmt = $GLOBALS['pdo']->prepare($sql);
	$valores = $GLOBALS['objeto']->getValoresEmVetorPDO();
	for ($i=0; $i < count($nomeColunas); $i++) { 
		$stmt->bindParam(':'.$nomeColunas[$i], $valores[$i]);
	}
	$stmt->execute();
	echo "Linhas afetadas: ".$stmt->rowCount();

}

####################################################################################################

?>