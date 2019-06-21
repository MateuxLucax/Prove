-- MySQL Script generated by MySQL Workbench
-- Fri Jun 14 21:02:50 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema prove_sistema_avaliacao
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema prove_sistema_avaliacao
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prove_sistema_avaliacao` DEFAULT CHARACTER SET utf8 ;
USE `prove_sistema_avaliacao` ;

-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Escola`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Escola` (
  `Codigo_Escola` INT NOT NULL,
  `Nome` VARCHAR(75) NOT NULL,
  PRIMARY KEY (`Codigo_Escola`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Serie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Serie` (
  `Codigo_Serie` INT NOT NULL,
  `Descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Codigo_Serie`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Disciplinas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Disciplinas` (
  `Codigo_Disciplina` INT NOT NULL,
  `Nome` VARCHAR(50) NOT NULL,
  `Escola_Codigo_Escola` INT NOT NULL,
  `Serie_Codigo_Serie` INT NOT NULL,
  PRIMARY KEY (`Codigo_Disciplina`),
  INDEX `fk_Disciplinas_Escola1_idx` (`Escola_Codigo_Escola` ASC),
  INDEX `fk_Disciplinas_Serie1_idx` (`Serie_Codigo_Serie` ASC),
  CONSTRAINT `fk_Disciplinas_Escola1`
    FOREIGN KEY (`Escola_Codigo_Escola`)
    REFERENCES `prove_sistema_avaliacao`.`Escola` (`Codigo_Escola`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Disciplinas_Serie1`
    FOREIGN KEY (`Serie_Codigo_Serie`)
    REFERENCES `prove_sistema_avaliacao`.`Serie` (`Codigo_Serie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Alunos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Alunos` (
  `Matricula` VARCHAR(15) NOT NULL,
  `Nome` VARCHAR(100) NOT NULL,
  `Data_Nascimento` DATE NOT NULL,
  `Ultimo_Login` DATETIME NULL,
  `Senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Matricula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Professores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Professores` (
  `Matricula` VARCHAR(20) NOT NULL,
  `Nome` VARCHAR(100) NOT NULL,
  `Data_Nascimento` DATE NOT NULL,
  `Ultimo_Login` DATETIME NULL,
  `Senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`Matricula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Avaliacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Avaliacoes` (
  `Codigo_Avaliacao` INT NOT NULL,
  `Conteudo` VARCHAR(50) NOT NULL,
  `Descricao` VARCHAR(50) NOT NULL,
  `Disciplina_Codigo_Disciplina` INT NOT NULL,
  `Data_Inicio` DATETIME NOT NULL,
  `Data_Fim` DATETIME NOT NULL,
  `Finalizada` TINYINT NULL,
  PRIMARY KEY (`Codigo_Avaliacao`),
  INDEX `fk_Avaliacoes_Disciplina1_idx` (`Disciplina_Codigo_Disciplina` ASC),
  CONSTRAINT `fk_Avaliacoes_Disciplina1`
    FOREIGN KEY (`Disciplina_Codigo_Disciplina`)
    REFERENCES `prove_sistema_avaliacao`.`Disciplinas` (`Codigo_Disciplina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Professores_has_Disciplina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Professores_has_Disciplina` (
  `Professores_Matricula` VARCHAR(20) NOT NULL,
  `Disciplina_Codigo_Disciplina` INT NOT NULL,
  PRIMARY KEY (`Professores_Matricula`, `Disciplina_Codigo_Disciplina`),
  INDEX `fk_Professores_has_Disciplina_Disciplina1_idx` (`Disciplina_Codigo_Disciplina` ASC),
  INDEX `fk_Professores_has_Disciplina_Professores_idx` (`Professores_Matricula` ASC),
  CONSTRAINT `fk_Professores_has_Disciplina_Professores`
    FOREIGN KEY (`Professores_Matricula`)
    REFERENCES `prove_sistema_avaliacao`.`Professores` (`Matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Professores_has_Disciplina_Disciplina1`
    FOREIGN KEY (`Disciplina_Codigo_Disciplina`)
    REFERENCES `prove_sistema_avaliacao`.`Disciplinas` (`Codigo_Disciplina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Disciplina_has_Alunos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Disciplina_has_Alunos` (
  `Disciplina_Codigo_Disciplina` INT NOT NULL,
  `Alunos_Matricula` VARCHAR(15) NOT NULL,
  `Cadastrado` TINYINT NOT NULL,
  PRIMARY KEY (`Disciplina_Codigo_Disciplina`, `Alunos_Matricula`),
  INDEX `fk_Disciplina_has_Alunos_Alunos1_idx` (`Alunos_Matricula` ASC),
  INDEX `fk_Disciplina_has_Alunos_Disciplina1_idx` (`Disciplina_Codigo_Disciplina` ASC),
  CONSTRAINT `fk_Disciplina_has_Alunos_Disciplina1`
    FOREIGN KEY (`Disciplina_Codigo_Disciplina`)
    REFERENCES `prove_sistema_avaliacao`.`Disciplinas` (`Codigo_Disciplina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Disciplina_has_Alunos_Alunos1`
    FOREIGN KEY (`Alunos_Matricula`)
    REFERENCES `prove_sistema_avaliacao`.`Alunos` (`Matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Palavras_Chave`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Palavras_Chave` (
  `Codigo_Palavras_Chave` INT NOT NULL,
  `Descricao` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`Codigo_Palavras_Chave`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Tipo` (
  `Codigo_Tipo` INT NOT NULL,
  `Descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Codigo_Tipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Questao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Questao` (
  `Codigo_Questao` INT NOT NULL,
  `Enunciado` VARCHAR(100) NOT NULL,
  `Texto` TEXT NULL,
  `Palavra_Chave` INT NOT NULL,
  `Tipo_Codigo` INT NOT NULL,
  PRIMARY KEY (`Codigo_Questao`),
  INDEX `fk_Questoes_Palavras_Chave1_idx` (`Palavra_Chave` ASC),
  INDEX `fk_Questao_Tipo1_idx` (`Tipo_Codigo` ASC),
  CONSTRAINT `fk_Questoes_Palavras_Chave1`
    FOREIGN KEY (`Palavra_Chave`)
    REFERENCES `prove_sistema_avaliacao`.`Palavras_Chave` (`Codigo_Palavras_Chave`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Questao_Tipo1`
    FOREIGN KEY (`Tipo_Codigo`)
    REFERENCES `prove_sistema_avaliacao`.`Tipo` (`Codigo_Tipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Questoes_has_Avaliacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Questoes_has_Avaliacoes` (
  `Questoes_Codigo_Questao` INT NOT NULL,
  `Avaliacoes_Codigo_Avaliacao` INT NOT NULL,
  PRIMARY KEY (`Questoes_Codigo_Questao`, `Avaliacoes_Codigo_Avaliacao`),
  INDEX `fk_Questoes_has_Avaliacoes_Avaliacoes1_idx` (`Avaliacoes_Codigo_Avaliacao` ASC),
  INDEX `fk_Questoes_has_Avaliacoes_Questoes1_idx` (`Questoes_Codigo_Questao` ASC),
  CONSTRAINT `fk_Questoes_has_Avaliacoes_Questoes1`
    FOREIGN KEY (`Questoes_Codigo_Questao`)
    REFERENCES `prove_sistema_avaliacao`.`Questao` (`Codigo_Questao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Questoes_has_Avaliacoes_Avaliacoes1`
    FOREIGN KEY (`Avaliacoes_Codigo_Avaliacao`)
    REFERENCES `prove_sistema_avaliacao`.`Avaliacoes` (`Codigo_Avaliacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Alternativa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Alternativa` (
  `Codigo_Alternativa` INT NOT NULL,
  `Descricao` VARCHAR(100) NOT NULL,
  `Correta` TINYINT NOT NULL,
  `Questao_Codigo` INT NOT NULL,
  PRIMARY KEY (`Codigo_Alternativa`),
  INDEX `fk_Alternativa_Questao1_idx` (`Questao_Codigo` ASC),
  CONSTRAINT `fk_Alternativa_Questao1`
    FOREIGN KEY (`Questao_Codigo`)
    REFERENCES `prove_sistema_avaliacao`.`Questao` (`Codigo_Questao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Discursiva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Discursiva` (
  `Codigo_Discursiva` INT NOT NULL,
  `Resposta` TEXT NOT NULL,
  `Alunos_Matricula` VARCHAR(15) NOT NULL,
  `Questao_Codigo` INT NOT NULL,
  PRIMARY KEY (`Codigo_Discursiva`),
  INDEX `fk_Discursiva_Alunos1_idx` (`Alunos_Matricula` ASC),
  INDEX `fk_Discursiva_Questao1_idx` (`Questao_Codigo` ASC),
  CONSTRAINT `fk_Discursiva_Alunos1`
    FOREIGN KEY (`Alunos_Matricula`)
    REFERENCES `prove_sistema_avaliacao`.`Alunos` (`Matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Discursiva_Questao1`
    FOREIGN KEY (`Questao_Codigo`)
    REFERENCES `prove_sistema_avaliacao`.`Questao` (`Codigo_Questao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Texto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Texto` (
  `Codigo_Texto` INT NOT NULL,
  `Respostas` LONGTEXT NOT NULL,
  `Questao_Codigo` INT NOT NULL,
  `Alunos_Matricula` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`Codigo_Texto`),
  INDEX `fk_Texto_Questao1_idx` (`Questao_Codigo` ASC),
  INDEX `fk_Texto_Alunos1_idx` (`Alunos_Matricula` ASC),
  CONSTRAINT `fk_Texto_Questao1`
    FOREIGN KEY (`Questao_Codigo`)
    REFERENCES `prove_sistema_avaliacao`.`Questao` (`Codigo_Questao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Texto_Alunos1`
    FOREIGN KEY (`Alunos_Matricula`)
    REFERENCES `prove_sistema_avaliacao`.`Alunos` (`Matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prove_sistema_avaliacao`.`Resposta_Alternativa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prove_sistema_avaliacao`.`Resposta_Alternativa` (
  `Codigo_Resposta` INT NOT NULL AUTO_INCREMENT,
  `Alternativa_Alternativa_Codigo` INT NOT NULL,
  `Alunos_Matricula` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`Codigo_Resposta`),
  UNIQUE INDEX `idResposta_UNIQUE` (`Codigo_Resposta` ASC),
  INDEX `fk_Resposta_Alternativa1_idx` (`Alternativa_Alternativa_Codigo` ASC),
  INDEX `fk_Resposta_Alunos1_idx` (`Alunos_Matricula` ASC),
  CONSTRAINT `fk_Resposta_Alternativa1`
    FOREIGN KEY (`Alternativa_Alternativa_Codigo`)
    REFERENCES `prove_sistema_avaliacao`.`Alternativa` (`Codigo_Alternativa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Resposta_Alunos1`
    FOREIGN KEY (`Alunos_Matricula`)
    REFERENCES `prove_sistema_avaliacao`.`Alunos` (`Matricula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


############################################################################
#### Inserção de registros #################################################
############################################################################

#### Professores:Matricula,Nome,Data_Nascimento,Ultimo_Login,Senha
INSERT INTO `Professores` VALUES ('2015459988','Professor Teste','2017-12-21','2019-12-21 23:44:34','2e6f9b0d5885b6010f9167787445617f553a735f');
## Senha que gera este sha1: teste
INSERT INTO `Professores` VALUES ('2017459988','Professor Teste 2','2014-12-21','2019-12-21 21:45:34','2e6f9b0d5885b6010f9167787445617f553a735f');

SELECT * FROM Professores WHERE Matricula = '2015459988';

SELECT * FROM Professores;

SELECT Matricula, Senha, Nome, Data_Nascimento, Ultimo_Login FROM Professores WHERE Nome like '% %';

SELECT Matricula, Senha, Nome, Data_Nascimento, Ultimo_Login FROM Professores WHERE Nome like '% %';

SELECT * FROM Professores WHERE Nome LIKE '% %';

INSERT INTO `Alunos` (`Matricula`, `Senha`, `Nome`, `Data_Nascimento`, `Ultimo_Login`) VALUES
('2017305998','e0f68134d29dc326d115de4c8fab8700a3c4b002','Teste 123','2002-03-17','2019-03-12 16:22:32');