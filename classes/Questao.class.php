<?php

require_once "autoload.php";

class Questao extends AbsCodigo {
	private $tipo;
	private $texto;
	private $enunciado;
	private $tags = array();
	private $alternativas = array();
	#private $respostas = array();
	# Um objeto "Resposta" recebe um objeto "Aluno"
	# Ou um objeto "Aluno" recebe vários objetos "Resposta"?

	function __construct() {
		$tipo = new TipoQuestao;
		$tag = new TagQuestao;
		$alternativa = new Alternativa;
	}

	public function setTipo($tipo){
		if($tipo instanceof TipoQuestao) $this->tipo = $tipo; }
	public function getTipo(){return $this->tipo; }

	public function setTag($tag){
		if($tag instanceof TagQuestao) array_push($this->tags, $tag); }
	public function getTag(){return $this->tag; }

	public function setTexto($texto){$this->texto = $texto; }
	public function getTexto(){return $this->texto; }

	public function setEnunciado($enunciado){$this->enunciado = $enunciado; }
	public function getEnunciado(){return $this->enunciado; }

	public function setAlternativa($alternativa){
		if($alternativa instanceof Alternativa) array_push($this->alternativas, $alternativa); }
	public function getAlternativa(){return $this->alternativa; }

	public function __toString(){
		$txt = "<div class='questao'>[Questão]".parent::__toString();
		$txt .= " | {Tipo}: ".$this->tipo->getDescricao();
		$txt .= "<br> | {Tags}: ";
		for ($i=0; $i < count($this->tags); $i++) { $txt .= $this->tags[$i]->getDescricao().", "; }
		$txt .= "<br> | Texto: ".$this->texto;
		$txt .= "<br> | Enunciado: ".$this->enunciado;
		$txt .= "<br> | {Alternativas}: ";
		$txt .= "<ol>"; #Lista de alternativas
		for ($i=0; $i < count($this->alternativas); $i++) { $txt .= "<li>".$this->alternativas[$i]->getDescricao()."</li>";	}
		$txt .= "</ol>";
		$txt .= "</div>";
		return $txt;
	}
}

?>