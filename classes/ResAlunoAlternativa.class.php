<?php

require_once "autoload.php";

class ResAlunoAlternativa extends AbsCodigo {
    private $resposta; #Valor binário
    private $alternativa;

    function __construct()  {
        $alternativa = new Alternativa;
    }

    public function setResposta($resposta){$this->resposta=$resposta;}
    public function getResposta(){return $this->resposta;}

    public function setAlternativa($alternativa){
        if($alternativa instanceof Alternativa)$this->alternativa=$alternativa;}
    public function getAlternativa(){return $this->alternativa;}

    function __toString(){
        $txt = parent::__toString();
        if($this->correta()) $txt .= "<b style='color:green'>";
        else $txt .= "<b style='color:red'>";
        $txt .= " Resposta do aluno: ".$this->resposta;
        $txt .= "</b>";
        return $txt;
    }

    #### MÉTODOS ####################################################################

    public function correta(){
        # Retorna se a resposta do aluno corresponde com a resposta correta da alternativa
        # Ou seja, se o aluno acertou ou não a alternativa
        if($this->resposta == $this->alternativa->getCorreta())
            return true;
        else return false;
    }
}

?>