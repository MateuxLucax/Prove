<!DOCTYPE html>
<html>

<head>
	<title>Página de teste</title>
	<style type="text/css">
		.disciplina{ background-color: lightgrey; }
		.questao { background-color: lightblue; }
		.avaliacao { background-color: lightgreen; }
	</style>
</head>

<body>
<?php

	require_once "autoload.php";

	$escola1 = new Escola;
	$escola1->setCodigo(1);
	$escola1->setDescricao("IFC");
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

	$serie1 = new Serie;
	$serie1->setCodigo(1);
	$serie1->setDescricao("3TECINFO");
	echo "[Série]".$serie1."<br><br>";

	$alunocad1 = new AlunoCadastro;
	$alunocad1->setAluno($aluno1);
	$alunocad1->setCadastrado(0);
	$alunocad2 = new AlunoCadastro;
	$alunocad2->setAluno($aluno2);
	$alunocad2->setCadastrado(1);

	$disc1 = new Disciplina;
	$disc1->setCodigo(1);
	$disc1->setDescricao("Programação");
	$disc1->setEscola($escola1);
	$disc1->setSerie($serie1);
	$disc1->setProfessor($prof1);
	$disc1->setProfessor($prof2);
	$disc1->setAluno($alunocad1);
	$disc1->setAluno($alunocad2);
	echo $disc1."<br><hr>";

	$tipo1 = new TipoQuestao;
	$tipo1->setCodigo(1);
	$tipo1->setDescricao("Única escolha");
	echo "[Tipo de questão] ".$tipo1."<br>";
	$tipo2 = new TipoQuestao;
	$tipo2->setCodigo(2);
	$tipo2->setDescricao("Verdadeiro ou falso");
	echo "[Tipo de questão] ".$tipo2."<br>";

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

	$ques1 = new Questao;
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

	$ques2 = new Questao;
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

	$aval1 = new Avaliacao;
	$aval1->setCodigo(1);
	$aval1->setConteudo("Laços de repetição e PHP");
	$aval1->setDataInicio("01/04/2017");
	$aval1->setDataFim("07/04/2017");
	$aval1->setDisciplina($disc1);
	$aval1->setQuestao($ques1);
	$aval1->setQuestao($ques2);
	echo $aval1."<br><hr>";

?>
</body>
</html>