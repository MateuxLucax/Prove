<?php

include 'conf.php';

if (isset($_POST['acao'])) $acao = $_POST['acao'];
else if (isset($_GET['acao'])) $acao = $_GET['acao'];
else $acao = '';

require_once "autoload.php";

#### Construção do objeto ##########################################################################

if (!$acao == '') {	
	echo "Ação: ".$acao."<br>";
	
	$prof = new Professor;
	if(isset($_POST['matricula'])) $prof->setMatricula($_POST['matricula']);
	if(isset($_POST['senha'])) $prof->setSenha(sha1($_POST['senha']));
	if(isset($_POST['nome'])) $prof->setNome($_POST['nome']);
	if(isset($_POST['data_nascimento'])) $prof->setDataNascimento($_POST['data_nascimento']);
	if(isset($_POST['ultimo_login'])) $prof->setUltimoLogin($_POST['ultimo_login']);
	if(isset($_POST['email'])) $prof->setUltimoLogin($_POST['email']);
	echo $prof;
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
		$sql = "SELECT * FROM ".$GLOBALS['tb_professores']." WHERE ".$criterio." ";
		if ($criterio == 'Nome' || $criterio = 'Matricula') 
			$sql .= " like '%".$pesquisa."%'";
		else $sql .= ' = '.$pesquisa;
		$sql .= ";";
		//var_dump($sql); echo "<br>";

		$consulta = $GLOBALS['pdo']->query($sql);

		$registros = array();

		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			$registros[$i] = array();
			array_push($registros[$i], $linha['Matricula']);
			array_push($registros[$i], $linha['Senha']);
			array_push($registros[$i], $linha['Nome']);
			array_push($registros[$i], $linha['Data_Nascimento']);
			array_push($registros[$i], $linha['Ultimo_Login']);
		}

		return $registros;
	} catch (PDOException $e) {
		echo "Erro: ".$e->getMessage();
	}
}

function printSelectPDOAsTable ($registros) {
	# $registros deve ser o retorno da função selectPDO()
	# ou seja, poderia-se chamar essa função assim: prinSelectPDOasTable(selectPDO());
	/*A função de select do PDO só retorna os valores da tabela em uma matriz
	A função printSelectTable imprime os dados da matriz em uma tabela*/
	
	echo "<table class='highlight centered responsive-table'>
	<thead class='black white-text'>
	<tr>
		<th>Matrícula</th>
		<th>Senha</th>
		<th>Nome</th>
		<th>Data de nascimento</th>
		<th>Último login</th>
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
	$stmt = $GLOBALS['pdo']->prepare("INSERT INTO ".$GLOBALS['tb_professores']." (Matricula, Senha, Nome, Data_Nascimento, Ultimo_Login) VALUES (:Matricula, :Senha, :Nome, :Data_Nascimento, :Ultimo_Login)");

	$stmt->bindParam(':Matricula', $matricula);
	$stmt->bindParam(':Senha', $senha);
	$stmt->bindParam(':Nome', $nome);
	$stmt->bindParam(':Data_Nascimento', $data_nascimento);
	$stmt->bindParam(':Ultimo_Login', $ultimo_login);

	$matricula = $GLOBALS['prof']->getMatricula();
	$senha = $GLOBALS['prof']->getSenha();
	$nome = $GLOBALS['prof']->getNome();
	$data_nascimento = $GLOBALS['prof']->getDataNascimento();
	$ultimo_login = $GLOBALS['prof']->getUltimoLogin();

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

function updatePDO() {
	$stmt = GLOBALS['pdo']->prepare("UPDATE ".$GLOBALS['tb_professores']." SET Matricula = :Matricula, Senha = :Senha, Nome = :Nome, Data_Nascimento = :Data_Nascimento, Ultimo_Login = :Ultimo_Login");

	$stmt->bindParam(':Matricula', $matricula);
	$stmt->bindParam(':Senha', $senha);
	$stmt->bindParam(':Nome', $nome);
	$stmt->bindParam(':Data_Nascimento', $data_nascimento);
	$stmt->bindParam(':Ultimo_Login', $ultimo_login);

	$matricula = $GLOBALS['prof']->getMatricula();
	$senha = $GLOBALS['prof']->getSenha();
	$nome = $GLOBALS['prof']->getNome();
	$data_nascimento = $GLOBALS['prof']->getDataNascimento();
	$ultimo_login = $GLOBALS['prof']->getUltimoLogin();

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

function deletePDO() {
	$stmt = $GLOBALS['pdo']->prepare("DELETE FROM ".$GLOBALS['tb_professores']." WHERE Matricula = :Matricula");

	$stmt->bindParam(':Matricula', $matricula);

	$matricula = $GLOBALS['prof']->getMatricula();

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

?>