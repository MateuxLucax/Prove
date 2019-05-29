<?php

require_once "autoload.php";

class QuestaoDiscursiva extends AbsQuestao {
    private $respostas = array();

    public function setResposta($resposta){
        if($resposta instanceof RespostaAluno) array_push($this->respostas[$i], $resposta);}
    public function getResposta(){return $this->respostas;}

    function __toString(){
        
    }
}

?>