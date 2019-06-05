<?php

require_once "autoload.php";

class RespostaDiscursiva extends AbsCodigo {
    private $texto; # Resposta discursiva do aluno -- o que ele escreveu como resposta
    private $correcao; # Comentário do professor sobre a resposta: porque errou, o que faltou, se foi boa etc.
    private $pontuacao; # Pontuação que professor dá
    # A pontuação das questões alternativas é feita automaticamente pelo código -- não existe como atributo

    public function setTexto($texto){$this->texto=$texto;}
    public function getTexto(){return $this->texto;}

    public function setCorrecao($correcao){$this->correcao=$correcao;}
    public function getCorrecao(){return $this->correcao;}

    public function setPontuacao($pontuacao){$this->pontuacao=$pontuacao;}
    public function getPontuacao(){return $this->pontuacao;}

    function __toString() {
        $txt = parent::__toString();
        $txt .= " | Pontuação: ".$this->pontuacao;
        $txt .= "<br> | Texto do aluno: ".$this->texto;
        $txt .= "<br> | Correção do professor: ".$this->correcao;

        return $txt;
    }

}

?>