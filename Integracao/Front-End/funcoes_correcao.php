<?php
	$pdo = new PDO('mysql:host=localhost;dbname=prove_sistema_avaliacao',"root","");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo -> exec("SET CHARACTER SET utf8");

	
	$notas_aluno = notaTodasDiscAluno('201701');

	for ($i=0; $i < count($notas_aluno); $i++) { 
		for ($j=0; $j < count($notas_aluno[$i]); $j++) { 
			if(isset($notas_aluno[$i][$j])) echo $notas_aluno[$i][$j]." - ";
		}
		echo "<br/>";
	}

	function notasDisciplinaTodos($cod_disciplina) { // O MÁXIMO QUE O PROFESSOR VERÁ
		// gera uma matriz que tem as notas de todos os alunos da disciplina

		// consulta quais os alunos que fazem parte da disciplina
		$query = "SELECT Alunos_Matricula FROM Disciplina_has_Alunos WHERE Disciplina_Codigo_Disciplina = ".$cod_disciplina;
		$consulta = $GLOBALS['pdo']->query($query);
		$matriculas = array();
		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			array_push($matriculas, $linha['Alunos_Matricula']);
		}

		$notas_alunos = array();
		for ($i=0; $i < count($matriculas); $i++) { 
			$notas_alunos[$i] = array();
			$notas_alunos[$i][0] = $matriculas[$i];

			$notas = notasDisciplinaAluno($cod_disciplina, $matriculas[$i]);
			for ($j=0; $j < count($notas); $j++) { 
				array_push($notas_alunos[$i], $notas[$j]);
			}
		}

		return $notas_alunos;
	}

	function notaTodasDiscAluno($matricula) { // O MÁXIMO QUE O ALUNO VERÁ
		// gera uma matriz com as notas de um aluno de todas as disciplinas em que está

		// consulta de que disciplinas o aluno faz parte
		$query = "SELECT Disciplina_Codigo_Disciplina FROM Disciplina_has_Alunos WHERE Alunos_Matricula = ".$matricula;
		$consulta = $GLOBALS['pdo']->query($query);
		$cod_disciplinas = array();
		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			array_push($cod_disciplinas, $linha['Disciplina_Codigo_Disciplina']);
		}

		$notas_aluno = array();
		for ($i=0; $i < count($cod_disciplinas); $i++) { 
			$notas_aluno[$i] = array();
			$notas_aluno[$i][0] = $cod_disciplinas[$i];

			$notas_disciplina =  notasDisciplinaAluno($cod_disciplinas[$i], $matricula);
			for ($j=0; $j < count($notas_disciplina); $j++) { 
				array_push($notas_aluno[$i], $notas_disciplina[$j]);
			}
		}

		return $notas_aluno;


	}

	function notasDisciplinaAluno($cod_disciplina, $matricula) {
		// gera um array que tem todas as notas de um aluno na disciplina

		// consulta os códigos das avaliações que são da disciplina
		$query = "SELECT Codigo_Avaliacao FROM Avaliacoes WHERE Disciplina_Codigo_Disciplina = ".$cod_disciplina." ORDER BY Codigo_Avaliacao";
		$consulta = $GLOBALS['pdo']->query($query);
		$cod_avaliacoes = array();
		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			array_push($cod_avaliacoes, $linha['Codigo_Avaliacao']);
		}

		$notas = array();
		for ($i=0; $i < count($cod_avaliacoes); $i++) { 
			array_push($notas, notaAvaliacao($cod_avaliacoes[$i], $matricula));
		}

		return $notas;
	}

	function notaAvaliacao($cod_avaliacao, $matricula) {
		$correcao = correcaoAvaliacao($cod_avaliacao, $matricula);

		$qtd_questoes = count($correcao);
		if($qtd_questoes > 0) {
			$valor_questao = 10 / $qtd_questoes;

			$nota = 0;
			for ($i=0; $i < $qtd_questoes; $i++) { 
				$nota += $correcao[$i][1];
			}

			$nota *= $valor_questao;
		
			return round($nota,2);
		}
	}

	function correcaoAvaliacao($cod_avaliacao, $matricula) {
		// consulta os códigos das questões da prova
		$query = "SELECT Codigo_Questao FROM Questao Q, Questoes_has_Avaliacoes QA WHERE QA.Questoes_Codigo_Questao = Q.Codigo_Questao AND QA.Avaliacoes_Codigo_Avaliacao = ".$cod_avaliacao;
		$consulta = $GLOBALS['pdo']->query($query);
		$cod_questoes = array();
		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			array_push($cod_questoes, $linha['Codigo_Questao']);
		}

		$qtd_questoes = count($cod_questoes);

		// determina a pontuação que o aluno atingiu na prova
		$correcao = array();
		for ($i=0; $i < $qtd_questoes; $i++) { 
			$correcao[$i] = array();
			$correcao[$i][0] = $cod_questoes[$i];
			$correcao[$i][1] = correcaoResposta($cod_questoes[$i], $matricula);
		}
		
		return $correcao;
	}

	function correcaoResposta($cod_questao, $matricula) {
		// consulta o tipo da questão
		$query = "SELECT Tipo_Codigo FROM Questao WHERE Codigo_Questao = ".$cod_questao;
		$consulta = $GLOBALS['pdo']->query($query);
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		$tipo_codigo = $linha['Tipo_Codigo'];

		switch ($tipo_codigo) {
			case 1:
				return correcaoResposta_disc($cod_questao, $matricula);
				// retorna 0 (errada), 0.5 (meio certo) ou 1 (certo)
				// no banco de dados é 0errada 1meio 2certo
				// então a função retorna o valor do banco dividido por 2
				break;
			case 2:
				return correcaoResposta_unica($cod_questao, $matricula);
				// retorna 0 (errada) ou 1 (correta)
				break;
			case 3:
				return correcaoResposta_VouF($cod_questao, $matricula);
				// retorna a razão de qtd. alternativas acertadas sobre qtd. alternativas da questao
				// ou seja, se o usuário acertou 3 de 5 alternativas, o retorno é 0.6
				// assim, o valor máximo que a função retorna é 1 (5 acertadas sobre 5 alternativas -- todas)
				// o resultado passa pela função round() com precisão 1 (retorna com um número após a vírgula)
				break;
		}
	}

	function correcaoResposta_disc($cod_questao, $matricula) {
		// consulta o código da resposta que o usuário deu
		$query0 = "SELECT Codigo_Discursiva FROM Discursiva WHERE Alunos_Matricula = '".$matricula."' AND Questao_Codigo = ".$cod_questao;
		//var_dump($query0);
		$consulta = $GLOBALS['pdo']->query($query0);
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		$cod_resposta = $linha['Codigo_Discursiva'];

		if(isset($cod_resposta)) {
			// consulta a correção da resposta que o usuário deu
			$query = "SELECT Correta FROM Discursiva WHERE Codigo_Discursiva = ".$cod_resposta.";";
			//var_dump($query);
			$consulta = $GLOBALS['pdo']->query($query);
			$linha = $consulta->fetch(PDO::FETCH_ASSOC);
			return ($linha['Correta'] / 2);
		} else {
			return 0;
		}
	}

	function correcaoResposta_unica($cod_questao, $matricula) {
		// consulta qual é a alternativa correta
		$query1 = "SELECT Codigo_Alternativa FROM Alternativa WHERE Correta = 1 AND Questao_Codigo = ".$cod_questao;
		$consulta = $GLOBALS['pdo']->query($query1);
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		$alt_correta = $linha['Codigo_Alternativa'];

		// consulta se o aluno selecionou a alt_correta (a consulta retorna 1) ou se não selecionou (retorna 0) e a função já retorna isso
		$query2 = "SELECT Resposta FROM Resposta_Alternativa WHERE Alternativa_Alternativa_Codigo = ".$alt_correta." AND Alunos_Matricula = '".$matricula."'";
		$consulta = $GLOBALS['pdo']->query($query2);
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		return $linha['Resposta'];
	}

	function correcaoResposta_VouF($cod_questao, $matricula) {
		// OBS: AQUI A ORDEM É IMPORTANTE
		// consulta o conjunto de alternativas corretas e gera um array a partir disso
		// consulta, junto, quais são os códigos das alternativas, que são usados no array depois desse
		$query1 = "SELECT Codigo_Alternativa, Correta FROM Alternativa WHERE Questao_Codigo = ".$cod_questao." ORDER BY Codigo_Alternativa";

		$alt_corretas = array();
		$cod_alts = array();

		$consulta = $GLOBALS['pdo']->query($query1);
		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			array_push($alt_corretas, $linha['Correta']);
			array_push($cod_alts, $linha['Codigo_Alternativa']);
		}
		$qtd_alt = count($alt_corretas);

		// determina que valor os campos Alternativa_Alternativa_Codigo devem ter, em intervalo
		$inicial = $cod_alts[0];
		$final = $cod_alts[($qtd_alt-1)];
		// consulta o conjunto de respostas do usuário e gera um array a partir disso
		$query2 = "SELECT Resposta FROM Resposta_Alternativa WHERE Alternativa_Alternativa_Codigo >= ".$inicial." AND Alternativa_Alternativa_Codigo <= ".$final." AND Alunos_Matricula = '".$matricula."' ORDER BY Alternativa_Alternativa_Codigo";
		$consulta = $GLOBALS['pdo']->query($query2);
		$alt_respostas = array();
		for ($i = 0; $linha = $consulta->fetch(PDO::FETCH_ASSOC); $i++) {
			array_push($alt_respostas, $linha['Resposta']);
		}

		if(count($alt_respostas) == count($alt_corretas)) {

			$qtd_acertos = 0;
			for ($i=0; $i < $qtd_alt; $i++) { 
				if ($alt_corretas[$i] == $alt_respostas[$i]) {
					$qtd_acertos++;
				}
			}

			$correcao = $qtd_acertos / $qtd_alt;
			return round($correcao,2);
		} else {
			return 0;
		}
	}
?>