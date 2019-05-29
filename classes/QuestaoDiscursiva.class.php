<?php

require_once "autoload.php";

class QuestaoDiscursiva extends AbsQuestao {
    private $respostas = array();

    public function setResposta($resposta){
        if($resposta instanceof RespostaAlunoDiscursiva) array_push($this->respostas[$i], $resposta);}
    public function getRespostas(){return $this->respostass;}

    function __toString(){
        $txt = parent::__toString();
        $txt .= " | Respostas: ";
        $txt .= "<ol>";
        for ($i=0; $i < count($this->respostas); $i++) { 
            $txt .= "<li>".$this->respostas[$i].</li>";
        }
        $txt .= "</ol>";
    }

    #### MÉTODOS ###################################################################
    
}

?>