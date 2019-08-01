<?php
	
$pdo = new PDO('mysql:host=localhost;dbname=prove_sistema_avaliacao',"root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo -> exec("SET CHARACTER SET utf8");

function gerar_formulario_questoes($cod_avaliacao, $embaralhar, $matricula) {
	$questoes = select_questoes_formulario($cod_avaliacao, $embaralhar);

	echo "<ul class='tabs'>";
	for ($i=0; $i < count($questoes); $i++) { 
		$noQuestao = $i+1;
		echo "<li class='tab'><a href='#q".$questoes[$i][0]."'>".$noQuestao."</a></li>";	
	}	
	echo "</ul>";

	for ($i=0; $i < count($questoes); $i++) { 
		$alunoJaRespondeu = alunoJaRespondeu($questoes[$i][0], $questoes[$i][3], $matricula); // Verifica se o aluno já respondeu a questão e, se for o caso, mostra junto a resposta numa badge

		$noQuestao = $i+1;
		
		echo "<div id='q".$questoes[$i][0]."' class='card-panel'>";
		if($alunoJaRespondeu) {
			echo "<span class='new badge green darken-1' data-badge-caption='Respondida'></span>";
		} else {
			echo "<span class='new badge red darken-1' data-badge-caption='Não respondida'></span>";
		}

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

function alunoJaRespondeu ($cod_questao, $tipo_questao, $matricula) {
	
	if ($tipo_questao == 1) {
		$query = "SELECT count(Alunos_Matricula) as 'Respondeu' FROM Discursiva WHERE Alunos_Matricula = ".$matricula." AND Questao_Codigo = ".$cod_questao;
	} else {
		$query = "SELECT count(RA.Alunos_Matricula) as 'Respondeu' FROM Resposta_Alternativa RA, Alternativa A
		WHERE Alunos_Matricula = ".$matricula."
		AND RA.Alternativa_Alternativa_Codigo = A.Codigo_Alternativa
		AND A.Questao_Codigo = ".$cod_questao;
	}

	$consulta = $GLOBALS['pdo']->query($query);
		
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		$respondeu = $linha['Respondeu'];

		if ($respondeu > 0) return true;
		else return false;
}

?>