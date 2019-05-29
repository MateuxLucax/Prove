<?php

require_once "autoload.php";

class RespostaAluno extends AbsCodigo {
    private $resposta;
    /* Para cada objeto Alternativa existirão vários objetos RespostaAluno (um para cada aluno)
    que dizem se o aluno selecionou essa como a correta (como no caso da questão de tipo "única escolha")
    ou se selecionou como verdadeiro (valor 1) ou falso (valor 0) (no caso da questão de tipo "verdadeiro ou falso") */

    /* Um objeto Aluno recebe vários objetos RespostaAluno
    ou um objeto AlunoCadastro recebe vários objetos RespostaAluno

    ou um objeto RespostaAluno recebe um objeto Aluno
    ou um objeto RespostaAluno recebe um objeto AlunoCadastro? */

    public function setResposta($resposta){$this->resposta=$resposta;}
    public function getResposta(){return $this->resposta;}

    function __toString(){
        return parent::__toString()." | Resposta do aluno: ".$resposta;
    }
}

?>