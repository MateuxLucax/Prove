<?php

require_once "autoload.php";

class QuestaoAlternativa extends AbsQuestao {
    private $alternativas = array();

    public function setAlternativa($alternativa){
		if($alternativa instanceof Alternativa) array_push($this->alternativas, $alternativa); }
    public function getAlternativa(){return $this->alternativa; }
    
    function __toString(){
        $txt = "<div class='questao'>[Questão]".parent::__toString();
        $txt .= "{Alternativas}";
        $txt .= "<ol>"; #Lista de alternativas
        for ($i=0; $i < count($this->alternativas); $i++) { 
            $txt .= "<li>".$this->alternativas[$i]."</li>";
        }
        $txt .= "</ol>";
        $txt .= "</div>";

        return $txt;
    }
}

?>