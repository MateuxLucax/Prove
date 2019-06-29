<?php

include 'conf.php';

if (isset($_POST['acao'])) $acao = $_POST['acao'];
else if (isset($_GET['acao'])) $acao = $_GET['acao'];
else $acao = '';

require_once "autoload.php";

#### Construção do objeto ##########################################################################

if (!$acao == '') {	
	echo "Ação: ".$acao."<br>";
	
	$avaliacao = new Avaliacao;
	if(isset($_POST['Codigo_Avaliacao'])) $avaliacao->setCodigo_Avaliacao($_POST['Codigo_Avaliacao']);
	if(isset($_POST['conteudo'])) $avaliacao->setConteudo($_POST['conteudo']);
	if(isset($_POST['dataInicio'])) $avaliacao->setDataInicio($_POST['dataInicio']);
	if(isset($_POST['dataFim'])) $avaliacao->setDataFim($_POST['dataInicio']);
	if(isset($_POST['peso'])) $avaliacao->setPeso($_POST['peso']);
	if(isset($_POST['embaralhar'])) $avaliacao->setEmbaralhar($_POST['embaralhar']);
	else $avaliacao->setEmbaralhar(0);
	
	
	echo $avaliacao;
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

function selectPDO($criterio = 'Conteudo', $pesquisa = '') {
	try {
		$sql = "SELECT * FROM ".$GLOBALS['$tb_avaliacoes']." WHERE ".$criterio." ";
		if ($criterio == 'Conteudo' || $criterio = 'Matricula') 
			$sql .= " like '%".$pesquisa."%'";
		else $sql .= ' = '.$pesquisa;
		$sql .= ";";
		//var_dump($sql); echo "<br>";

		$consulta = $GLOBALS['pdo']->query($sql);

		$registros = array();

		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			$registros[$i] = array();
			array_push($registros[$i], $linha['Codigo_Avaliacao']);
			array_push($registros[$i], $linha['conteudo']);
			array_push($registros[$i], $linha['dataInicio']);
			array_push($registros[$i], $linha['dataFim']);
			array_push($registros[$i], $linha['peso']);
			array_push($registros[$i], $linha['embaralhar']);
		}

		return $registros;
	} catch (PDOException $e) {
		echo "Erro: ".$e->getMessage();
	}
}

function printSelectPDOAsTable ($registros) {
	# $registros deve ser o retorno da função selectPDO()
	# ou seja, poderia-se chamar essa função assim: prinSelectPDOasTable(selectPDO());
	
	echo "<table class='highlight centered responsive-table'>
	<thead class='black white-text'>
	<tr>
		<th>Codigo Avaliacao</th>
		<th>Conteudo</th>
		<th>Data de Inicio</th>
		<th>Data de Fim</th>
		<th>Peso</th>
		<th>Embaralhar</th>
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
	$stmt = $GLOBALS['pdo']->prepare("INSERT INTO ".$GLOBALS['tb_avaliacoes']." (Conteudo, Data_Inicio, Data_Fim, Peso, Embaralhar, Disciplina_Codigo_Disciplina) VALUES (:Conteudo, :Data_Inicio, :Data_Fim, :Peso, :Embaralhar, :Disciplina)");

	$stmt->bindParam(':Conteudo', $conteudo);
	$stmt->bindParam(':Data_Inicio', $data_inicio);
	$stmt->bindParam(':Data_Fim', $data_fim);
	$stmt->bindParam(':Peso', $peso);
	$stmt->bindParam(':Embaralhar', $embaralhar);
	$stmt->bindParam(':Disciplina', $disciplina);

	$conteudo = $GLOBALS['avaliacao']->getConteudo();
	$data_inicio = $GLOBALS['avaliacao']->getDataInicio();
	$data_fim = $GLOBALS['avaliacao']->getDataFim();
	$peso = $GLOBALS['avaliacao']->getPeso();
	$embaralhar = $GLOBALS['avaliacao']->getEmbaralhar();
	$disciplina = $_POST['Disciplina_Codigo_Disciplina'];

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

function updatePDO() {
	$stmt = GLOBALS['pdo']->prepare("UPDATE ".$GLOBALS['$tb_avaliacoes']." SET Matricula = :Matricula, Senha = :Senha, Nome = :Nome, Data_Nascimento = :Data_Nascimento, Ultimo_Login = :Ultimo_Login, Email = :Email");

	$stmt->bindParam(':Matricula', $matricula);
	$stmt->bindParam(':Senha', $senha);
	$stmt->bindParam(':Nome', $nome);
	$stmt->bindParam(':Data_Nascimento', $data_nascimento);
	$stmt->bindParam(':Ultimo_Login', $ultimo_login);
	$stmt->bindParam(':Email', $email);

	$matricula = $GLOBALS['aluno']->getMatricula();
	$senha = $GLOBALS['aluno']->getSenha();
	$nome = $GLOBALS['aluno']->getNome();
	$data_nascimento = $GLOBALS['aluno']->getDataNascimento();
	$ultimo_login = $GLOBALS['aluno']->getUltimoLogin();
	$email = $GLOBALS['aluno']->getEmail();

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

function deletePDO() {
	$stmt = $GLOBALS['pdo']->prepare("DELETE FROM ".$GLOBALS['$tb_avaliacoes']." WHERE Matricula = :Matricula");

	$stmt->bindParam(':Matricula', $matricula);

	$matricula = $GLOBALS['aluno']->getMatricula();

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

?>