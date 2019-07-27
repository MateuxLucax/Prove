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

$noAlternativas = $_POST['noAlternativas'];
echo "Número de alternativas: ".$noAlternativas."<br/>";

$cod_alternativa = $_POST['cod_alternativa'];
echo "Código das alternativas: ";
for ($i=0; $i < count($cod_alternativa); $i++) { 
	echo $cod_alternativa[$i].", ";
}
echo "<br/>";

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

function insertPDO_resDisc() {
	//echo $GLOBALS['resposta_disc'];

	$sql = "INSERT INTO ".$GLOBALS['tb_res_discursiva']." (Resposta, Alunos_Matricula, Questao_Codigo) VALUES (:Resposta, :Matricula, :Questao)";

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

function insertPDO_resAlt() {




	# !! RESTRIÇÃO: O aluno não pode ter mais de uma resposta para cada questão
	# if () {} else { updatePDO_resAlt }
	# tb falta fazer um updatePDO_resDisc


	

	$resposta = $GLOBALS['resposta_ques']->getRespostas();
	for ($i=0; $i < count($resposta); $i++) { 
		$resposta[$i] = $resposta[$i]->getResposta();
	}

	//var_dump($resposta);

	$cnt_linhas = 0;
	for ($i=0; $i < count($resposta); $i++) { 
		$sql = "INSERT INTO ".$GLOBALS['tb_res_alternativa']." ";
		$sql .= " (Alternativa_Alternativa_Codigo, Alunos_Matricula) ";
		$sql .= " VALUES (:Alternativa, :Matricula) ";

		$stmt = $GLOBALS['pdo']->prepare($sql);

		$stmt->bindParam(":Alternativa", $alternativa);
		$stmt->bindParam(":Matricula", $matricula);

		$alternativa = $GLOBALS['cod_alternativa'][$i];
		$matricula = $GLOBALS['matricula'];

		$stmt->execute();

		echo "Linhas afetadas: ".$stmt->rowCount();
		if($stmt->rowCount() == 1) $cnt_linhas++;
		echo " - Ao total: ".$cnt_linhas."<br/>";
	}
}

?>