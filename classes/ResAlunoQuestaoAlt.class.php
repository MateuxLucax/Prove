<?php

require_once "autoload.php";

class ResAlunoQuestaoAlt extends AbsCodigo {
    private $questao;
    private $alternativasRes = array();

    function __construct()  {
        $questao = new QuestaoAlternativa;
        $alternativaRes = new ResALunoAlternativa;
    }

    public function setQuestao($questao){
        if($questao instanceof QuestaoAlternativa)$this->questao=$questao;}
    public function getQuestao(){return $this->questao;}

    public function setAlternativaRes($alternativaRes){
        if($alternativaRes instanceof ResAlunoAlternativa) array_push($this->alternativasRes,$alternativaRes);}
    public function getAlternativasRes(){return $this->alternativasRes;}

    function __toString(){
        $txt = "<div class='resposta'>[Resposta]".parent::__toString();
        $txt .= "<ul>";
        $txt .= "<li>{Questão}".$this->questao."</li>";
        $txt .= "</ul>";
        $txt .= "<br>{Resposta do aluno}";
        $txt .= "<ol>";
        for ($i=0; $i < count($this->alternativasRes); $i++) { 
            $txt .= "<li>".$this->alternativasRes[$i]."</li>";
        }
        $txt .= "</ol>";
        $txt .= "Qtd corretas: ".$this->qtdCorretas()."<br>";
        $txt .= "No alternativas: ".count($this->alternativasRes)."<br>";
        $txt .= "<b>Pontuação: ".$this->pontuacao()."</b>";
        $txt .= "</div>";

        return $txt;
    }

    #### MÉTODOS ####################################################################

    public function pontuacao(){
        # Retorna quantos pontos o aluno conseguiu dessa resposta
        $noAlternativas = count($this->alternativasRes);
        $corretas = $this->qtdCorretas();
        $peso = $this->questao->getPeso();

        $pontuacao = ($peso * $corretas) / $noAlternativas;
        /*Regra de três
        (Peso: pontuação que o aluno obteria caso acertasse todas as alternativas)

          pontuacao            peso
        -------------  =  ----------------
          corretas         noAlternativas

        pontuacao * noAlternativas = peso * corretas
        pontuacao = (corretas * peso) / noAlternativas

        Se acertando a quantidade de alternativas que a questão tem (ou seja, todas) eu obtenho uma pontuação
        igual ao peso, que pontuação eu obtenho se acertar um outro número de alternativas? (corretas: quantas
        o aluno acertou)        
        */
        return $pontuacao;
    }

    public function qtdCorretas(){
        # Retorna quantas alternativas o aluno acertou
        $corretas=0;
        for ($i=0; $i < count($this->alternativasRes); $i++) { 
            if($this->alternativasRes[$i]->correta())
                $corretas++;
        }
        return $corretas;
    }
}

?>