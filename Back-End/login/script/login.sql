create database if not exists `login`;
USE `login`;

create table `login` (
`codigo` int(11) NOT NULL AUTO_INCREMENT,
`usuario` varchar(45) default null,
`senha` varchar(45) default null,
`nome` varchar(45) default null,
PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into login
values(null,'leonardo','a13c6557db7c55c118c75e6e3372b533b2d75934','leonardo');

select * from login;

