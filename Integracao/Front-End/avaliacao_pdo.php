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
	if(isset($_POST['Codigo_Avaliacao'])) $avaliacao->setCodigo($_POST['Codigo_Avaliacao']);
	if(isset($_POST['conteudo'])) $avaliacao->setConteudo($_POST['conteudo']);
	if(isset($_POST['dataInicio'])) $avaliacao->setDataInicio($_POST['dataInicio']);
	if(isset($_POST['dataFim'])) $avaliacao->setDataFim($_POST['dataInicio']);
	if(isset($_POST['peso'])) $avaliacao->setPeso($_POST['peso']);
	if(isset($_POST['embaralhar'])) $avaliacao->setEmbaralhar($_POST['embaralhar']);
	if(isset($_POST['Disciplina_Codigo_Disciplina'])) $disciplina = $_POST['Disciplina_Codigo_Disciplina'];
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
			insertPDO_aval();
			break;
		case 'editar':
			updatePDO_aval();
			break;
		case 'deletar':
			deletePDO_aval();
			break;
		case 'cadastrar_questao':
			insertPDO_avalques();
			break;
	}	
} catch (PDOException $e) {
	echo "Erro: ".$e->getMessage();
}

#### Funções ###############################################

function selectPDO_aval($criterio = 'Conteudo', $pesquisa = '') {
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

function selectPDO_aval_table ($registros) {
	# $registros deve ser o retorno da função selectPDO_aval()
	# ou seja, poderia-se chamar essa função assim: prinselectPDO_avalasTable(selectPDO_aval());
	
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

function insertPDO_aval() {
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

	header("location:disciplina.php?codigo=".$disciplina);
}

function updatePDO_aval() {
	$stmt = $GLOBALS['pdo']->prepare("UPDATE ".$GLOBALS['tb_avaliacoes']." SET Conteudo = :Conteudo, Data_Inicio = :Data_Inicio, Data_Fim = :Data_Fim, Peso = :Peso, Embaralhar = :Embaralhar, Disciplina_Codigo_Disciplina = :Disciplina WHERE Codigo_Avaliacao = :Codigo");


	$stmt->bindParam(':Codigo', $codigo);
	$stmt->bindParam(':Conteudo', $conteudo);
	$stmt->bindParam(':Data_Inicio', $data_inicio);
	$stmt->bindParam(':Data_Fim', $data_fim);
	$stmt->bindParam(':Peso', $peso);
	$stmt->bindParam(':Embaralhar', $embaralhar);
	$stmt->bindParam(':Disciplina', $disciplina);
	
	$codigo = $GLOBALS['avaliacao']->getCodigo();
	$conteudo = $GLOBALS['avaliacao']->getConteudo();
	$data_inicio = $GLOBALS['avaliacao']->getDataInicio();
	$data_fim = $GLOBALS['avaliacao']->getDataFim();
	$peso = $GLOBALS['avaliacao']->getPeso();
	$embaralhar = $GLOBALS['avaliacao']->getEmbaralhar();
	$disciplina = $_POST['Disciplina_Codigo_Disciplina'];

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

function deletePDO_aval() {
	$stmt = $GLOBALS['pdo']->prepare("DELETE FROM ".$GLOBALS['$tb_avaliacoes']." WHERE Codigo_Avaliacao = :Codigo_Avaliacao");

	$stmt->bindParam(':Codigo_Avaliacao', $codigo);

	$codigo = $GLOBALS['aluno']->getCodigo_Avaliacao();

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}


/////////////////////////////////////////////////////////////////////
// Funções para comandos referentes a relação avaliação-questão (N:N)

function selectPDO_avalques($codigo_aval = '') {
	try {	
		if ($codigo_aval == 'só_questão') {
			$sql = 'select Codigo_Questao, Texto, Enunciado, Tipo_Codigo as \'Tipo\' FROM Questao';
		}
		else {	
			$sql = 'select A.Codigo_Avaliacao, A.Conteudo, Q.Codigo_Questao, Q.Texto, Q.Enunciado, T.Descricao as \'Tipo\'
				FROM Questao Q, Questoes_has_Avaliacoes QA, Avaliacoes A, Tipo T
				WHERE QA.Questoes_Codigo_Questao = Q.Codigo_Questao
				AND QA.Avaliacoes_Codigo_Avaliacao = A.Codigo_Avaliacao
				AND Q.Tipo_Codigo = T.Codigo_Tipo ';
				
			if($codigo_aval != '') {
				$sql .= ' AND QA.Avaliacoes_Codigo_Avaliacao = '.$codigo_aval;
			}
		}

		//var_dump($sql);

		$consulta = $GLOBALS['pdo']->query($sql);

		$registros = array();

		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			$registros[$i] = array();
			if(isset($linha['Codigo_Avaliacao'])) array_push($registros[$i], $linha['Codigo_Avaliacao']);
			if(isset($linha['Conteudo'])) array_push($registros[$i], $linha['Conteudo']);
			array_push($registros[$i], $linha['Codigo_Questao']);
			array_push($registros[$i], $linha['Texto']);
			array_push($registros[$i], $linha['Enunciado']);
			array_push($registros[$i], $linha['Tipo']);
		}

		return $registros;


		//if($tipo == 'unica escolha' || $tipo == 'verdadeiro ou falso') { mostrar alternativas }

	} catch (PDOException $e) {
		echo "Erro: ".$e->getMessage();
	}
}

function selectPDO_avalques_table ($registros) {
	
	echo "<table class='highlight centered responsive-table'>
	<thead class='black white-text'>
	<tr>
		<th>Codigo Avaliacao</th>
		<th>Conteudo</th>
		<th>Codigo Questao</th>
		<th>Texto</th>
		<th>Enunciado</th>
		<th>Tipo</th>
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

function insertPDO_avalques() {
	$questoes = selectPDO_avalques('só_questão'); // Não faz o SELECT com a relação com a avaliação
	if(count($questoes) > 0) {
		$proxCodigo = $questoes[(count($questoes)-1)][2] + 1;
	} else {
		$proxCodigo = 1;
	}

	$stmt = $GLOBALS['pdo']->prepare("INSERT INTO ".$GLOBALS['tb_questoes']." (Enunciado, Texto, Tipo_Codigo) VALUES (:Enunciado, :Texto, :Tipo_Codigo)");

	$stmt->bindParam(':Enunciado', $_POST['Enunciado']);
	$stmt->bindParam(':Texto', $_POST['Texto']);
	$stmt->bindParam(':Tipo_Codigo', $_POST['Tipo_Codigo']);
		
	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();

	//// Adicionar questão na avaliação

	$stmt = $GLOBALS['pdo']->prepare("INSERT INTO ".$GLOBALS['tb_aval_ques']." (Questoes_Codigo_Questao, Avaliacoes_Codigo_Avaliacao) VALUES (:Questao, :Avaliacao)");

	$stmt->bindParam(':Questao', $proxCodigo);
	$stmt->bindParam(':Avaliacao', $_POST['Avaliacao_Codigo_Avaliacao']);
		
	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();	

	//header("location:avaliacao.php?codigo=".$);
}
?>