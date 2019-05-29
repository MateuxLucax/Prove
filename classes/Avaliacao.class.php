<?php

require_once "autoload.php";

class Avaliacao extends AbsCodigo {

	private $conteudo;
	private $dataInicio;
	private $dataFim;
	private $questoes = array();

	public function setConteudo($conteudo){$this->conteudo = $conteudo;}
	public function getConteudo(){return $this->conteudo;}

	public function setDataInicio($dataInicio){$this->dataInicio = $dataInicio;}
	public function getDataInicio(){return $this->dataInicio;}

	public function setDataFim($dataFim){$this->dataFim = $dataFim;}
	public function getDataFim(){return $this->dataFim;}

	public function setQuestao($questao){
		if($questao instanceof QuestaoAlternativa || $questao instanceof QuestaoDiscursiva)
			array_push($this->questoes, $questao); }
	public function getQuestao(){return $this->questao; }

	public function __toString(){
		$txt = "<div class='avaliacao'>[Avaliação]".parent::__toString();
		$txt .= " | Conteúdo: ".$this->conteudo;
		$txt .= " | Data início: ".$this->dataInicio;
		$txt .= " | Data fim: ".$this->dataFim;
		$txt .= "<br> | {Questões}: ";
		$txt .= "<ol>"; # Lista de questões
		for ($i=0; $i < count($this->questoes); $i++) { 
			$txt .= "<li>".$this->questoes[$i]."</li><br>";
		}
		$txt .= "</ol>"; # Fim lista de questões
		$txt .= "</div>";
		return $txt;
	}
}

?>