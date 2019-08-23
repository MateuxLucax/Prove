use prove_sistema_avaliacao;

insert into Questao (Codigo_Questao, Tipo_Codigo) values (99, 2);

update Alternativa set Questao_Codigo = 99 where Questao_Codigo = 4;
update Alternativa set Questao_Codigo = 4 where Questao_Codigo = 5;
update Alternativa set Questao_Codigo = 5 where Questao_Codigo = 99;

delete from Questao where Codigo_Questao = 99;