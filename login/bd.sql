USE crud;



CREATE TABLE login(
	codigo INT(11) NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(45) DEFAULT NULL,
    senha VARCHAR(45) DEFAULT NULL,
    nome VARCHAR(45) DEFAULT NULL,
    dataInial DATE,
    dataUltima DATE,
    PRIMARY KEY (codigo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO login VALUES (null, 'cristianpie', '539ceab9a4c155868dd360023fd9ed09f5ff249b', 'cristian', '2018-03-13','2019-03-30');






DELETE FROM login WHERE codigo = 1;

SELECT * FROM login;

