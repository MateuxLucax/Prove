<?php

require_once "autoload.php";

class Disciplina extends AbsCodigoDescricao {

	private $escola;
	private $serie;
	private $professores = array();
	private $alunos = array();

	function __construct() {
		$escola = new Escola;
		$serie = new Serie;
		$professor = new Professor;
		$aluno = new Aluno;
	}

	public function setSerie($serie){$this->serie=$serie;}
	public function getSerie(){return $this->serie;}

	public function setEscola($escola){
		if ($escola instanceof Escola) $this->escola=$escola; }
	public function getEscola(){return $this->escola;}

	public function setProfessor($professor){
		if ($professor instanceof Professor) array_push($this->professores, $professor); }
	public function getProfessor(){return $this->professor;}

	public function setAluno($aluno){
		if ($aluno instanceof AlunoCadastro) array_push($this->alunos, $aluno); }
	public function getAluno(){return $this->aluno;}


	public function __toString() {
		$txt = "<div class='disciplina'>[Disciplina]".parent::__toString();
		$txt .= "<dl>";
		$txt .= "<dt>{Série}</dt> <dd>".$this->serie."</dd>";
		$txt .= "<dt>{Escola}</dt> <dd>".$this->escola."</dd>";
		$txt .= "<dt>{Professores}</dt>";
		$txt .= "<dd> <dl>"; # Lista dentro de uma lista (lista de professores dentro da lista de atributos da disciplina)
		for ($i=0; $i < count($this->professores); $i++) { 
			$txt .= "<dt>Professor</dt> <dd>".$this->professores[$i]."</dd>"; }
		$txt .= "</dl> </dd>"; # Fim da lista de professores

		$txt .= "<dt>{Alunos}</dt>";
		$txt .= "<dd> <dl>"; # Lista dentro de uma lista (lista de alunos dentro da lista de atributos da disciplina)
		for ($i=0; $i < count($this->alunos); $i++) { 
			$txt .= "<dt>Aluno</dt> <dd>".$this->alunos[$i]."</dd>"; }
		$txt .= "</dt> </dd>";

		$txt .= "</div>";
		return $txt;
	}
}

?>