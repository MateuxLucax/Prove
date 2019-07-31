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
$pdo -> exec("SET CHARACTER SET utf8");

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
		$sql = "SELECT * FROM ".$GLOBALS['tb_avaliacoes']." WHERE ".$criterio." ";
		if ($criterio == 'Conteudo') {
			$sql .= " like '%".$pesquisa."%'";
		} else {
			$sql .= ' = '.$pesquisa;
		}
		$sql .= ";";

		echo $sql;
		//var_dump($sql); echo "<br>";

		$consulta = $GLOBALS['pdo']->query($sql);

		$registros = array();

		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			$registros[$i] = array();
			array_push($registros[$i], $linha['Codigo_Avaliacao']);
			array_push($registros[$i], $linha['Conteudo']);
			array_push($registros[$i], $linha['Data_Inicio']);
			array_push($registros[$i], $linha['Data_Fim']);
			array_push($registros[$i], $linha['Peso']);
			array_push($registros[$i], $linha['Embaralhar']);
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

function selectPDO_avalques_all($codigo) {
	$sql = 'select Q.Codigo_Questao, Q.Enunciado, Q.Texto, T.Codigo_Tipo, T.Descricao as \'Tipo\', AL.Codigo_Alternativa, AL.Descricao, AL.Correta
		FROM Avaliacoes A, Questao Q, Questoes_has_Avaliacoes QA, Tipo T, Alternativa AL
		WHERE T.Codigo_Tipo = Q.Tipo_Codigo
		AND AL.Questao_Codigo = Q.Codigo_Questao
		AND QA.Questoes_Codigo_Questao = Q.Codigo_Questao
		AND QA.Avaliacoes_Codigo_Avaliacao = A.Codigo_Avaliacao
		AND A.Codigo_Avaliacao = '.$codigo;

	$consulta = $GLOBALS['pdo']->query($sql);

	$registros = array();

	for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
		$registros[$i] = array();

		array_push($registros[$i], $linha['Codigo_Questao']);
		array_push($registros[$i], $linha['Texto']);
		array_push($registros[$i], $linha['Enunciado']);
		array_push($registros[$i], $linha['Codigo_Tipo']);
		array_push($registros[$i], $linha['Tipo']);
		array_push($registros[$i], $linha['Codigo_Alternativa']);
		array_push($registros[$i], $linha['Descricao']);
		array_push($registros[$i], $linha['Correta']);
	}


	$sql = 'select Q.Codigo_Questao, Q.Enunciado, Q.Texto, T.Codigo_Tipo, T.Descricao as "Tipo"
	FROM Avaliacoes A, Questao Q, Questoes_has_Avaliacoes QA, Tipo T
	WHERE QA.Questoes_Codigo_Questao = Q.Codigo_Questao
	AND QA.Avaliacoes_Codigo_Avaliacao = A.Codigo_Avaliacao
	AND T.Codigo_Tipo = Q.Tipo_Codigo
	AND Q.Tipo_Codigo != 2
	AND  Q.Tipo_Codigo != 3
	AND A.Codigo_Avaliacao = '.$codigo;

	$consulta = $GLOBALS['pdo']->query($sql);

	# $i = (count($registros)-1) !!!!! não pode ser $i = 0 porque dessa forma iria sobrepor o que foi registrado na consulta anterior
	for ($i = (count($registros)); $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
		$registros[$i] = array();
		array_push($registros[$i], $linha['Codigo_Questao']);
		array_push($registros[$i], $linha['Texto']);
		array_push($registros[$i], $linha['Enunciado']);
		array_push($registros[$i], $linha['Codigo_Tipo']);
		array_push($registros[$i], $linha['Tipo']);
	}

	return $registros;

}


////////////////////////////////////////////////////////////////////////////////////////////////
// Funções para criação do formulário no qual o aluno responde as questões de uma avaliação



function gerar_formulario_questoes($cod_avaliacao, $embaralhar, $matricula) {
	$questoes = select_questoes_formulario($cod_avaliacao, $embaralhar);

	echo "<ul class='tabs'>";
	for ($i=0; $i < count($questoes); $i++) { 
		$noQuestao = $i+1;
		echo "<li class='tab'><a href='#q".$questoes[$i][0]."'>".$noQuestao."</a></li>";	
	}	
	echo "</ul>";

	for ($i=0; $i < count($questoes); $i++) { 
		$noQuestao = $i+1;
		
		echo "<div id='q".$questoes[$i][0]."' class='card-panel'>";

			echo "<p><b>".$noQuestao.")</b></p>";
			if(isset($questoes[$i][1])) echo "<p>".$questoes[$i][1]."</p>";
			echo "<p><b>".$questoes[$i][2]."</b></p>";

			echo "<form action='resposta_pdo.php' method='post'>";
				echo "<input type='hidden' name='cod_avaliacao' value='".$cod_avaliacao."'>";
				echo "<input type='hidden' name='matricula' value='".$matricula."'>";
				echo "<input type='hidden' name='cod_questao' value='".$questoes[$i][0]."'>";

				if($questoes[$i][3] == 1) {

					echo "<textarea class='materialize-textarea' name='resposta_q".$questoes[$i][0]."'></textarea>";

				} else {
						
					$alternativas = select_alternativas_formulario($questoes[$i][0]);
					$tipo_input = $questoes[$i][3] == 2 ? 'radio' : 'checkbox';

					echo "<div class='alternativas'>";
					$cnt = 0;
					for ($j=0; $j < count($alternativas); $j++) { 
						echo "<p> <label>";
							echo "<input type='".$tipo_input."'
								name='resposta_q".$questoes[$i][0]."[]'
								value='".$j."'>";
							echo "<span>".$alternativas[$j][1]."</span>";
						echo "</label> </p>";

						echo "<input type='hidden' name='cod_alternativa[]' value='".$alternativas[$j][0]."'>";

						$cnt++;
					}
					echo "<input type='hidden' name='noAlternativas' value='".$cnt."'>";
					echo "</div>";
				}

				$acao = $questoes[$i][3] == 1 ? 'addResDiscursiva' : 'addResAlternativa';
				echo "<button class='btn waves-effect waves-light' type='submit' name='acao' value='".$acao."'>Responder</button>";
			echo "</form>";
		echo "</div>";
	}

}



function select_questoes_formulario ($cod_avaliacao, $embaralhar) {
	try {
		$sql = " SELECT ";
		$sql .= " Q.Codigo_Questao, Q.Texto, Q.Enunciado, Q.Tipo_Codigo ";
		$sql .= " FROM ".$GLOBALS['tb_questoes']." Q, ".$GLOBALS['tb_avaliacoes']." A, ".$GLOBALS['tb_aval_ques']." QA ";
		$sql .= " WHERE Q.Codigo_Questao = QA.Questoes_Codigo_Questao ";
		$sql .= " AND A.Codigo_Avaliacao = QA.Avaliacoes_Codigo_Avaliacao ";
		$sql .= " AND A.Codigo_Avaliacao = ".$cod_avaliacao." ";
		if($embaralhar) { $sql .= " ORDER BY RAND() "; }

		//var_dump($sql);

		$consulta = $GLOBALS['pdo']->query($sql);
	
		$registros = array();

		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			$registros[$i] = array();
			array_push($registros[$i], $linha['Codigo_Questao']);
			array_push($registros[$i], $linha['Texto']);
			array_push($registros[$i], $linha['Enunciado']);
			array_push($registros[$i], $linha['Tipo_Codigo']);
		}

		return $registros;
	} catch (PDOException $e) {
		echo "Erro: ".$e->getMessage();
	}
}



function select_alternativas_formulario($cod_questao) {
	try {
		$sql = " SELECT ";
		$sql .= " Codigo_Alternativa, Descricao ";
		$sql .= " FROM ".$GLOBALS['tb_alternativa']." ";
		$sql .= " WHERE Questao_Codigo = ".$cod_questao;
		$sql .= " ORDER BY Codigo_Alternativa";

		//var_dump($sql);

		$consulta = $GLOBALS['pdo']->query($sql);
	
		$registros = array();

		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			$registros[$i] = array();
			array_push($registros[$i], $linha['Codigo_Alternativa']);
			array_push($registros[$i], $linha['Descricao']);
		}

		return $registros;

	} catch (PDOException $e) {
		echo "Erro: ".$e->getMessage();
	}
}

?>