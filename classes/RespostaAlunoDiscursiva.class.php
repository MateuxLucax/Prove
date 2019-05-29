<?php

require_once "autoload.php";

class RespostaAlunoAlternativa extends AbsRespostaAluno {
    private $resposta; #Texto
    private $comentario; #Comentário do professor explicando, por exemplo,
                         #o que faltou na resposta, o que está errado e o que está certo etc.

    public function setResposta($resposta){$this->resposta=$resposta;}
    public function getResposta(){return $this->resposta;}
    public function setComentario($comentario){$this->comentario=$comentario;}
    public function getComentario(){return $this->comentario;}

    function __toString(){
        return parent::__toString()." | Resposta do aluno: ".$resposta." | Comentário do professor: ".$this->comentario;
    }
}

?>