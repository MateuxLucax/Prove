<?php

require_once "autoload.php";

class Aluno extends AbsMatriculaNomeData {
    private $respostas = array();

    public function setResposta($resposta){
        if($resposta instanceof RespostaQAlternativa || $resposta instanceof RespostaDiscursiva)
            array_push($this->respostas,$resposta); }
    public function getRespostas(){return $this->respostas;}

    function __toString(){
        $txt = parent::__toString();
        $txt .= "<br>{Respostas}";
        $txt .= "<ul>";
        for ($i=0; $i < count($this->respostas); $i++) { 
            $txt .= "<li>".$this->respostas[$i]."</li>"; }
        $txt .= "</ul>";

        return $txt;
    }
}

?>