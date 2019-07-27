<?php

// IMPORTANTE: Não pode embaralhar a ordem das alternativas, senão não vai funcionar, porque
// o registro de respostas em relação as alternativas funciona por estar na mesma ordem

require_once 'autoload.php';
include 'conf.php';

$acao = $_POST['acao'];
echo "Código da questão: ".$acao."<br/>";

$questao = $_POST['cod_questao'];
echo "Código da questão: ".$questao."<br/>";

$avaliacao = $_POST['cod_avaliacao'];
echo "Código da avaliação: ".$avaliacao."<br/>";

$nome_resposta = "resposta_q".$questao;
echo "Resposta (nome input): ".$nome_resposta."<br/>";

$matricula = $_POST['matricula'];
echo "Matrícula do aluno: ".$matricula."<br/>";

if (isset($_POST['noAlternativas'])) {
	$noAlternativas = $_POST['noAlternativas'];
	echo "Número de alternativas: ".$noAlternativas."<br/>";
}

if(isset($_POST['cod_alternativa'])) {
	$cod_alternativa = $_POST['cod_alternativa'];
	echo "Código das alternativas: ";
	for ($i=0; $i < count($cod_alternativa); $i++) { 
		echo $cod_alternativa[$i].", ";
	}
	echo "<br/>";
}

$res = $_POST[$nome_resposta];
var_dump($res);

echo "<a href='avaliacao_responder.php?codigo=".$avaliacao."'>Voltar</a>";

echo "<b><br/><br/>Importante: o sistema não deve manter mais de uma resposta para determinada questão por aluno. Deve permitir, no máximo, que o aluno mude sua resposta (comando update), e isso apenas entre o intervalo de tempo <i>data início</i>-<i>data fim</i>.<br/><br/></b>";

#### Construção dos objetos ####################################################################

if ($acao == 'addResAlternativa') {
	$resposta_alt = array();

	for ($i=0; $i < $noAlternativas; $i++) { 
		if(in_array($i, $res)) {
			$resposta_alt[] = '1';
		} else {
			$resposta_alt[] = '0';
		}
	}

	echo "<br/>Array de resposta (alternativa 1: marcada/verdadeira ou 0: não marcada/falsa)<br/>"; var_dump($resposta_alt); echo "<br/><br/>";

	for ($i=0; $i < count($resposta_alt); $i++) { 
		$resposta_alt_obj[$i] = new Resposta1Alternativa;
		$resposta_alt_obj[$i]->setResposta($resposta_alt[$i]);
	}

	$resposta_ques = new RespostaQAlternativa;

	for ($i=0; $i < count($resposta_alt_obj); $i++) { 
		$resposta_ques->setResposta($resposta_alt_obj[$i]);
	}

} else if ($acao == 'addResDiscursiva') {
	$resposta_disc = new RespostaDiscursiva;
	$resposta_disc->setResposta($res);
}

#### PDO #######################################################################################

$pdo = new PDO('mysql:host=localhost;dbname=prove_sistema_avaliacao',"root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo -> exec("SET CHARACTER SET utf8");

try {
	switch ($acao) {
		case 'addResDiscursiva':
			insertPDO_resDisc();
			break;

		case 'addResAlternativa':
			insertPDO_resAlt();
			break;
	}
} catch (PDOException $e) {
	echo "Erro: ".$e->getMessage();
}

#### Funções ###################################################################################

########################################################################################
#### Funções para respostas de questões discursivas

function insertPDO_resDisc() {
	
	$alunoJaRespondeu = jaRespondeu_disc();

	if($alunoJaRespondeu) {
		$sql = "UPDATE ".$GLOBALS['tb_res_discursiva']." SET Resposta = :Resposta WHERE Questao_Codigo = :Questao AND Questao_Codigo = :Questao";
		echo "<b><i>A resposta será <u>atualizada</u></i></b><br/>";
	} else {
		$sql = "INSERT INTO ".$GLOBALS['tb_res_discursiva']." (Resposta, Alunos_Matricula, Questao_Codigo) VALUES (:Resposta, :Matricula, :Questao)";
		echo "<b><i>A resposta será <u>registrada</u></i></b><br/>";
	}

	$stmt = $GLOBALS['pdo']->prepare($sql);

	$stmt->bindParam(':Resposta', $res2);
	$stmt->bindParam(':Matricula', $matricula);
	$stmt->bindParam(':Questao', $questao);

	$res2 = $GLOBALS['resposta_disc']->getResposta();
	$matricula = $GLOBALS['matricula'];
	$questao = $GLOBALS['questao'];

	$stmt->execute();

	echo "Linhas afetadas: ".$stmt->rowCount();
}

function jaRespondeu_disc() {
	$sql = "SELECT Questao_Codigo FROM ".$GLOBALS['tb_res_discursiva']." WHERE Alunos_Matricula = ".$GLOBALS['matricula'];

	$consulta = $GLOBALS['pdo']->query($sql);

	$qRespondidas = array();

	for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
		array_push($qRespondidas, $linha['Questao_Codigo']);
	}

	if (in_array($GLOBALS['questao'], $qRespondidas)) {
		return 1;
	} else {
		return 0;
	}
}

########################################################################################
#### Funções para respostas de questões alternativas

function insertPDO_resAlt() {

	$resposta = $GLOBALS['resposta_ques']->getRespostas();
		for ($i=0; $i < count($resposta); $i++) { 
			$resposta[$i] = $resposta[$i]->getResposta();
		}

	$alunoJaRespondeu = jaRespondeu_alt();
	if ($alunoJaRespondeu) {

		echo "<b><i>A resposta será <u>atualizada</u></i></b><br/>";
		$cnt_linhas = 0;
		for ($i=0; $i < count($resposta); $i++) { 
			$sql = "UPDATE ".$GLOBALS['tb_res_alternativa']." ";
			$sql .= " SET Resposta = :Resposta ";
			$sql .= " WHERE Alunos_Matricula = :Matricula ";
			$sql .= " AND Alternativa_Alternativa_Codigo = :Alternativa";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindParam(":Resposta", $res2);
			$stmt->bindParam(":Alternativa", $alternativa);
			$stmt->bindParam(":Matricula", $matricula);

			$res2 = $resposta[$i];
			$alternativa = $GLOBALS['cod_alternativa'][$i];
			$matricula = $GLOBALS['matricula'];

			$stmt->execute();

			echo "Linhas afetadas: ".$stmt->rowCount();
			if($stmt->rowCount() == 1) $cnt_linhas++;
			echo " - Ao total: ".$cnt_linhas."<br/>";
		}
		

	} else {

		echo "<b><i>A resposta será <u>registrada</u></i></b><br/>";
		$cnt_linhas = 0;
		for ($i=0; $i < count($resposta); $i++) { 
			$sql = "INSERT INTO ".$GLOBALS['tb_res_alternativa']." ";
			$sql .= " (Resposta, Alternativa_Alternativa_Codigo, Alunos_Matricula) ";
			$sql .= " VALUES (:Resposta, :Alternativa, :Matricula) ";

			$stmt = $GLOBALS['pdo']->prepare($sql);

			$stmt->bindParam(":Resposta", $res2);
			$stmt->bindParam(":Alternativa", $alternativa);
			$stmt->bindParam(":Matricula", $matricula);

			$res2 = $resposta[$i];
			$alternativa = $GLOBALS['cod_alternativa'][$i];
			$matricula = $GLOBALS['matricula'];

			$stmt->execute();

			echo "Linhas afetadas: ".$stmt->rowCount();
			if($stmt->rowCount() == 1) $cnt_linhas++;
			echo " - Ao total: ".$cnt_linhas."<br/>";
		}

	}
}

function jaRespondeu_alt() {
	$sql = "SELECT Alternativa_Alternativa_Codigo FROM ".$GLOBALS['tb_res_alternativa']." WHERE Alunos_Matricula = ".$GLOBALS['matricula'];

	$consulta = $GLOBALS['pdo']->query($sql);

	$altRespondidas = array();

	for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
		array_push($altRespondidas, $linha['Alternativa_Alternativa_Codigo']);
	}

	if (in_array($GLOBALS['cod_alternativa'][0], $altRespondidas)) {
		return 1;
	} else {
		return 0;
	}
}

?>