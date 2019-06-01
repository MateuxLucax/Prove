<?php
    require_once "autoload.php";

    class ResAlunoAvaliacao extends AbsCodigo {
        private $avaliacao;
        private $questoesRes = array();

        public function setAvaliacao($avaliacao) {
            if($avaliacao instanceof Avaliacao)$this->avaliacao=$avaliacao;}
        public function getAvaliacao(){return $this->avaliacao;}

        public function setQuestaoRes($questao) {
            if($questao instanceof ResAlunoQuestaoAlt || $questao instanceof ResAlunoDiscursiva)
                array_push($this->questoesRes,$questao);}
        public function getQuestaoRes(){return $this->questao;}

        function __toString(){
            $txt = "<div class='avaliacao-aluno'>[Avaliação de um aluno (respostas)]".parent::__toString();
            $txt .= "<br><b>NOTA: ".$this->notaAval()."</b>";
            $txt .= "<ul>";
            $txt .= "<li>{Avaliação}".$this->avaliacao."</li>";
            $txt .= "</ul>";
            $txt .= "<ol>";
            for ($i=0; $i < count($this->questoesRes); $i++) { 
                $txt .= "<li>".$this->questoesRes[$i]."</li>";
            }
            $txt .= "</ol>";
            $txt .= "</div>";

            return $txt;
        }

        #### MÉTODOS #####################################################################

        public function notaAvalPeso() {
            # Retorna a nota da avaliação dividida pelo peso da avaliação (nota que resultará na média
            # do trimestre / bimestre)
            return notaAval() / $this->avaliacao->getPeso();
        }
        
        public function notaAval() {
            # Retorna a nota da avaliação (no mínimo 0, no máximo 10)
            $notaAval=0;
            for ($i=0; $i < count($this->questoesRes); $i++) { 
                $notaAval += $this->questoesRes[$i]->pontuacao();
            }
            return $notaAval;
        }
    }

?>