<?php

require_once "autoload.php";

class AbsResposta extends AbsCodigo {
    private $pontuacao;

    public function setPontuacao($pontuacao){$this->pontuacao=$pontuacao;}
    public function getPontuacao(){return $this->pontuacao;}

    function __toString(){
        return parent::__toString()." | Pontuação: ".$this->pontuacao;
    }
}

?>