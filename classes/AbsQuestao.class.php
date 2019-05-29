<?php

require_once "autoload.php";

abstract class AbsQuestao extends AbsCodigo {
	private $tipo;
	private $texto;
	private $enunciado;
	private $tags = array();

	function __construct() {
		$tipo = new TipoQuestao;
		$tag = new TagQuestao;
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
    
	public function __toString(){
        $txt = parent::__toString();
		$txt .= " | {Tipo}: ".$this->tipo->getDescricao();
		$txt .= "<br> | {Tags}: ";
		for ($i=0; $i < count($this->tags); $i++) { $txt .= $this->tags[$i]->getDescricao().", "; }
		$txt .= "<br> | Texto: ".$this->texto;
		$txt .= "<br> | Enunciado: ".$this->enunciado;
		return $txt;
	}
}

?>