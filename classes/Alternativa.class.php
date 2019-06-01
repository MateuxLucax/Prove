<?php

require_once "autoload.php";

class Alternativa extends AbsCodigoDescricao {
	private $correta; # Atributo binário (é a alternativa correta ou não)

	public function setCorreta($correta){$this->correta=$correta;}
	public function getCorreta(){return $this->correta;}

	public function __toString(){
		return parent::__toString()." | Correta: ".$this->correta;
	}
}

?>