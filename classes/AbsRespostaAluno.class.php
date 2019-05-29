<?php

require_once "autoload.php";

class RespostaAlunoAlternativa extends AbsCodigo {
    private $correcao; #Valor binário: correta ou errada

    public function setCorrecao($correcao){$this->correcao=$correcao;}
    public function getCorrecao(){return $this->correcao;}

    function __toString(){
        return parent::__toString()." | Correção: ".$correcao;
    }
}

?>