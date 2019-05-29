<?php

require_once "autoload.php";

class RespostaAluno extends AbsCodigo {
    private $resposta; #Valor binário

    public function setResposta($resposta){$this->resposta=$resposta;}
    public function getResposta(){return $this->resposta;}

    function __toString(){
        return parent::__toString()." | Resposta do aluno: ".$resposta;
    }
}

?>