<?php

require_once "autoload.php";

abstract class AbsUsuario {

	private $matricula;
	private $nome;
	private $dataNascimento;
	private $ultimoLogin;

	public function setMatricula($matricula){$this->matricula=$matricula;}
	public function getMatricula(){return $this->matricula;}

	public function setNome($nome){$this->nome=$nome;}
	public function getNome(){return $this->nome;}

	public function setDataNascimento($dataNascimento){$this->dataNascimento=$dataNascimento;}
	public function getDataNascimento(){return $this->dataNascimento;}

	public function setUltimoLogin($ultimoLogin){$this->ultimoLogin=$ultimoLogin;}
	public function getUltimoLogin(){return $this->ultimoLogin;}

	public function __toString(){
		return " Matrícula: ".$this->matricula." | Nome: ".$this->nome." | Data de nascimento: ".$this->dataNascimento." | Último login: ".$this->ultimoLogin;
	}
}

?>