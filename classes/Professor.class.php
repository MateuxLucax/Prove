<?php

require_once "autoload.php";

class Professor extends AbsMatriculaNomeData {
    private $avaliacoes = array();
    private $questoes = array();

    public function setAvaliacao($avaliacao){
        if($avaliacao instanceof Avaliacao) array_push($this->avaliacoes,$avaliacao); }  
    public function getAvaliacoes(){return $this->avaliacoes; }

    public function setQuestao($questao){
        if ($questao instanceof QuestaoDiscursiva || $questao instanceof QuestaoAlternativa)
            array_push($this->questoes, $questao); }  
    public function getQuestoes(){return $this->questoes; }

    function __toString(){
        $txt = "<div class='professor'>[Professor]".parent::__toString();
        $txt .= "{Avaliações}";
        $txt .= "<ul>";
        for ($i=0; $i < count($this->avaliacoes); $i++) { 
            $txt .= "<li>".$this->avaliacoes[$i]."</li>"; }
        $txt .= "</ul>";
        $txt .= "{Questões}";
        $txt .= "<ul>";
        for ($i=0; $i < count($this->questoes); $i++) { 
            $txt .= "<li>".$this->questoes[$i]."</li>"; }
        $txt .= "</ul>";
        $txt .= "</div>";

        return $txt;
    }
    
}

?>