<!DOCTYPE html>
<html>

<head>
	<title>Página de teste</title>
	<style type="text/css">
		.disciplina{ background-color: lightgrey; }

		.questao { background-color: lightblue; }

		.avaliacao { background-color: lightgreen; }

		.resposta-1alternativa { background-color: lightpink; }
		.resposta { background-color: slateblue; }

		.aluno { background-color: grey; }

		.professor { background-color: green; color: white; }
		.professor div { color:black; }
	</style>
</head>

<body>
<?php

	require_once "autoload.php";

	$serie1 = new Serie;
	$serie1->setCodigo(1);
	$serie1->setDescricao("3TECINFO");
	echo "[Série]".$serie1."<br>";
	$serie2 = new Serie;
	$serie2->setCodigo(2);
	$serie2->setDescricao("2TECINFO");
	echo "[Série]".$serie2."<br>";

	$escola1 = new Escola;
	$escola1->setCodigo(1);
	$escola1->setDescricao("IFC");
	$escola1->setSerie($serie1);
	$escola1->setSerie($serie2);
	echo "[Escola] ".$escola1."<br>";

	$aluno1 = new Aluno;
	$aluno1->setMatricula("2017592212");
	$aluno1->setNome("João da Silva");
	$aluno1->setDataNascimento("01/01/2001");
	echo "[Aluno] ".$aluno1."<br>";
	$aluno2 = new Aluno;
	$aluno2->setMatricula("2013591122");
	$aluno2->setNome("João da Silva Jr.");
	$aluno2->setDataNascimento("02/02/1998");
	echo "[Aluno] ".$aluno2."<br>";

	$prof1 = new Professor;
	$prof1->setMatricula("1998121233");
	$prof1->setNome("João Silva II");
	$prof1->setDataNascimento("03/03/1970");
	echo "[Professor]".$prof1."<br>";
	$prof2 = new Professor;
	$prof2->setMatricula("2998222233");
	$prof2->setNome("João Silva III");
	$prof2->setDataNascimento("03/03/1972");
	echo "[Professor]".$prof2."<br>";

	$alunocad1 = new AlunoCadastro;
	$alunocad1->setAluno($aluno1);
	$alunocad1->setCadastrado(0);
	$alunocad2 = new AlunoCadastro;
	$alunocad2->setAluno($aluno2);
	$alunocad2->setCadastrado(1);

	$tipo1 = new TipoQuestao;
	$tipo1->setCodigo(1);
	$tipo1->setDescricao("Única escolha");
	echo "[Tipo de questão] ".$tipo1."<br>";
	$tipo2 = new TipoQuestao;
	$tipo2->setCodigo(2);
	$tipo2->setDescricao("Verdadeiro ou falso");
	echo "[Tipo de questão] ".$tipo2."<br>";
	$tipo3 = new TipoQuestao;
	$tipo3->setCodigo(3);
	$tipo3->setDescricao("Discursiva");
	echo "[Tipo de questão] ".$tipo3."<br>";

	$tag1 = new TagQuestao;
	$tag1->setCodigo(1);
	$tag1->setDescricao("Programacao");
	echo "[Tag de questão] ".$tag1."<br>";
	$tag2 = new TagQuestao;
	$tag2->setCodigo(2);
	$tag2->setDescricao("LogicaProg");
	echo "[Tag de questão] ".$tag2."<br>";
	$tag3 = new TagQuestao;
	$tag3->setCodigo(3);
	$tag3->setDescricao("LacosRepeticao");
	echo "[Tag de questão] ".$tag3."<br>";

	$q1alt1 = new Alternativa;
	$q1alt1->setCodigo(1);
	$q1alt1->setDescricao("while(){}");
	$q1alt1->setCorreta(0);
	echo "[Alternativa] ".$q1alt1."<br>";
	$q1alt2 = new Alternativa;
	$q1alt2->setCodigo(2);
	$q1alt2->setDescricao("for(){}");
	$q1alt2->setCorreta(0);
	echo "[Alternativa] ".$q1alt2."<br>";
	$q1alt3 = new Alternativa;
	$q1alt3->setCodigo(3);
	$q1alt3->setDescricao("do{}while()");
	$q1alt3->setCorreta(1);
	echo "[Alternativa] ".$q1alt3."<br><br>";

	$ques1 = new QuestaoAlternativa;
	$ques1->setPeso(5);
	$ques1->setCodigo(1);
	$ques1->setTipo($tipo1);
	$ques1->setTexto("As estruturas de repetição também são conhecidas como laços (loops) e são utilizados para executar, repetidamente, uma instrução ou bloco de instrução enquanto determinada condição estiver sendo satisfeita.");
	$ques1->setEnunciado("Qual o laço de repetição que executa certo código enquanto uma condição é atendida mesmo que, de início, a condição não seja atendida?");
	$ques1->setTag($tag1);
	$ques1->setTag($tag2);
	$ques1->setTag($tag3);
	$ques1->setAlternativa($q1alt1);
	$ques1->setAlternativa($q1alt2);
	$ques1->setAlternativa($q1alt3);
	echo $ques1."<br><br>";

	$q2alt1 = new Alternativa;
	$q2alt1->setCodigo(4);
	$q2alt1->setDescricao('if($valor == 5 || $valor == 55){ echo "Parabéns, você acertou!"; }');
	$q2alt1->setCorreta(1);
	echo "[Alternativa] ".$q2alt1."<br>";
	$q2alt2 = new Alternativa;
	$q2alt2->setCodigo(5);
	$q2alt2->setDescricao('array_push($valoresPares,28);');
	$q2alt2->setCorreta(1);
	echo "[Alternativa] ".$q2alt2."<br>";
	$q2alt3 = new Alternativa;
	$q2alt3->setCodigo(6);
	$q2alt3->setDescricao('int main() { cout << "Eu juro que sou um código PHP" << endl; }');
	$q2alt3->setCorreta(0);
	echo "[Alternativa] ".$q2alt3."<br><br>";

	$ques2 = new QuestaoAlternativa;
	$ques2->setPeso(4);
	$ques2->setCodigo(2);
	$ques2->setTipo($tipo2);
	$ques2->setTexto("O PHP (um acrônimo recursivo para PHP: Hypertext Preprocessor) é uma linguagem de script open source de uso geral, muito utilizada, e especialmente adequada para o desenvolvimento web e que pode ser embutida dentro do HTML.");
	$ques2->setEnunciado("Escreva V para os códigos válidos em PHP e F para os códigos inválidos.");
	$ques2->setTag($tag1);
	$ques2->setTag($tag2);
	$ques2->setAlternativa($q2alt1);
	$ques2->setAlternativa($q2alt2);
	$ques2->setAlternativa($q2alt3);
	echo $ques2."<br><br>";

	$ques3 = new QuestaoDiscursiva;
	$ques3->setPeso(1);
	$ques3->setCodigo(3);
	$ques3->setTipo($tipo3);
	$ques3->setTexto('<?php
	$variavel = 1;
	echo $variavel;
	$variavel++;
	echo $variavel;
	if($variavel > 10){
		echo $variavel."é maior que 10";
	}
	else {
		echo $variavel."é menor que 10";
	}
	?>');
	$ques3->setEnunciado("O que o código PHP acima faz? Descreva em detalhes.");
	$ques3->setTag($tag1);
	$ques3->setTag($tag2);	
	echo $ques3;

	$aval1 = new Avaliacao;
	$aval1->setCodigo(1);
	$aval1->setConteudo("Laços de repetição e PHP");
	$aval1->setDataInicio("01/04/2017");
	$aval1->setDataFim("07/04/2017");
	$aval1->setQuestao($ques1);
	$aval1->setQuestao($ques2);
	$aval1->setQuestao($ques3);
	$aval1->setPeso(6);
	$aval1->setEmbaralhar(1);
	echo $aval1."<br><hr>";
	
	$disc1 = new Disciplina;
	$disc1->setCodigo(1);
	$disc1->setDescricao("Programação");
	$disc1->setSerie($serie1);
	$disc1->setProfessor($prof1);
	$disc1->setProfessor($prof2);
	$disc1->setAluno($alunocad1);
	$disc1->setAluno($alunocad2);
	$disc1->setAvaliacao($aval1);
	echo $disc1."<br><hr>";

	$q1alt1_r1 = new Resposta1Alternativa;
	$q1alt1_r1->setCodigo(1);
	$q1alt1_r1->setResposta(0);
	$q1alt1->setResposta($q1alt1_r1); 
	#echo $q1alt1;
	$q1alt2_r1 = new Resposta1Alternativa;
	$q1alt2_r1->setCodigo(2);
	$q1alt2_r1->setResposta(1);
	$q1alt2->setResposta($q1alt2_r1); 
	$q1alt3_r1 = new Resposta1Alternativa;
	$q1alt3_r1->setCodigo(3);
	$q1alt3_r1->setResposta(0);
	$q1alt3->setResposta($q1alt3_r1);

	$q1_r1 = new RespostaQAlternativa;
	$q1_r1->setCodigo(1);
	$q1_r1->setResposta($q1alt1_r1);
	$q1_r1->setResposta($q1alt2_r1);
	$q1_r1->setResposta($q1alt3_r1);
	$ques1->setResposta($q1_r1);
	#echo $ques1."<br>";

	$q2alt1_r1 = new Resposta1Alternativa;
	$q2alt1_r1->setCodigo(4);
	$q2alt1_r1->setResposta(1);
	$q2alt1->setResposta($q2alt1_r1); 
	#echo $q2alt1;
	$q2alt2_r1 = new Resposta1Alternativa;
	$q2alt2_r1->setCodigo(5);
	$q2alt2_r1->setResposta(1);
	$q2alt2->setResposta($q2alt2_r1); 
	$q2alt3_r1 = new Resposta1Alternativa;
	$q2alt3_r1->setCodigo(6);
	$q2alt3_r1->setResposta(1);
	$q2alt3->setResposta($q2alt3_r1);

	$q2_r1 = new RespostaQAlternativa;
	$q2_r1->setCodigo(2);
	$q2_r1->setResposta($q2alt1_r1);
	$q2_r1->setResposta($q2alt2_r1);
	$q2_r1->setResposta($q2alt3_r1);
	$ques2->setResposta($q2_r1);
	#echo $ques2."<br>";

	$q3_r1 = new RespostaDiscursiva;
	$q3_r1->setCodigo(5);
	$q3_r1->setResposta("subtrai 10 da variavel #varivavel e conta de 1 a 10 se 1 for maior que 10");
	$q3_r1->setCorrecao("Não tem nada a ver com o código. O símbolo que precede o nome da variável no PHP é $ não #.");
	$q3_r1->setPontuacao(0);
	$ques3->setResposta($q3_r1);
	#echo $ques3."<br>";

	###aluno2###

	$q1alt1_r2 = new Resposta1Alternativa;
	$q1alt1_r2->setCodigo(7);
	$q1alt1_r2->setResposta(1);
	$q1alt1->setResposta($q1alt1_r2); 
	#echo $q1alt1;
	$q1alt2_r2 = new Resposta1Alternativa;
	$q1alt2_r2->setCodigo(8);
	$q1alt2_r2->setResposta(0);
	$q1alt2->setResposta($q1alt2_r2); 
	$q1alt3_r2 = new Resposta1Alternativa;
	$q1alt3_r2->setCodigo(9);
	$q1alt3_r2->setResposta(0);
	$q1alt3->setResposta($q1alt3_r2);

	$q1_r2 = new RespostaQAlternativa;
	$q1_r2->setCodigo(3);
	$q1_r2->setResposta($q1alt1_r2);
	$q1_r2->setResposta($q1alt2_r2);
	$q1_r2->setResposta($q1alt3_r2);
	$ques1->setResposta($q1_r2);
	echo $ques1."<br>";

	$q2alt1_r2 = new Resposta1Alternativa;
	$q2alt1_r2->setCodigo(10);
	$q2alt1_r2->setResposta(0);
	$q2alt1->setResposta($q2alt1_r2); 
	#echo $q2alt1;
	$q2alt2_r2 = new Resposta1Alternativa;
	$q2alt2_r2->setCodigo(11);
	$q2alt2_r2->setResposta(1);
	$q2alt2->setResposta($q2alt2_r2); 
	$q2alt3_r2 = new Resposta1Alternativa;
	$q2alt3_r2->setCodigo(12);
	$q2alt3_r2->setResposta(0);
	$q2alt3->setResposta($q2alt3_r2);

	$q2_r2 = new RespostaQAlternativa;
	$q2_r2->setCodigo(4);
	$q2_r2->setResposta($q2alt1_r2);
	$q2_r2->setResposta($q2alt2_r2);
	$q2_r2->setResposta($q2alt3_r2);
	$ques2->setResposta($q2_r2);
	echo $ques2."<br>";

	$q3_r2 = new RespostaDiscursiva;
	$q3_r2->setCodigo(6);
	$q3_r2->setResposta("Declara a variável com valor 1, adiciona 1 a esse valor, verifica se é menor que 10 ou menor e imprime uma mensagem conforme.");
	$q3_r2->setCorrecao("Está correto, mas a explicação não aborda a lógica if(){}else{} muito bem.");
	$q3_r2->setPontuacao(0.9);
	$ques3->setResposta($q3_r2);

	$aluno1->setResposta($q1_r1);
	$aluno1->setResposta($q2_r1);
	$aluno1->setResposta($q3_r1);
	echo $aluno1."<br>";
	
	$aluno2->setResposta($q1_r2);
	$aluno2->setResposta($q2_r2);
	$aluno2->setResposta($q3_r2);
	echo $aluno2."<br><hr>";

	$prof1->setQuestao($ques1);
	$prof1->setQuestao($ques2);
	$prof1->setQuestao($ques3);
	$prof1->setAvaliacao($aval1);
	echo $prof1."<br><br>";

?>
</body>
</html>