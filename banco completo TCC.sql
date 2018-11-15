drop database beauty_calendar;

create database beauty_calendar;

use beauty_calendar;

#criar tabela de serviço

create table tb_servico (
preco varchar(8),
tipo varchar(15),
descricao varchar(60),
id_servico int auto_increment primary key,
foto varchar(80),
duracao varchar(5),
id_profissional int ,
nome varchar(40)
);

#criar tabela de atendimento

create table tb_atendimento (
dia int(1),
horario_inicio varchar(5),
horario_final varchar(5),
id_atendimento int auto_increment primary key,
id_profissional int 
);

#criar tabela de excessões

create table tb_excessao (
data date,
horario_inicio varchar(5),
horario_final varchar(5),
id_excessao int auto_increment primary key,
id_atendimento int ,
foreign key(id_atendimento) references tb_atendimento (id_atendimento)
);

#criar tabela de endereço

create table tb_endereco (
id_endereco int auto_increment primary key,
bairro varchar(60),
uf varchar(2),
cidade varchar(40),
logradouro varchar(40),
numero varchar(5),
complemento varchar(18)
);

#criar tabela de fotos do salão

create table tb_feed_foto (
id int auto_increment primary key,
caminho varchar(80),
id_salao int
);

#criar tabela de profissionais do salão

create table tb_profissional (
id_profissional int auto_increment primary key,
nome varchar(80),
descricao varchar(60),
foto varchar(80),
telefone varchar(14)
);

#criar tabela de agendamento

create table tb_agenda (
id_agenda int auto_increment primary key,
dia date,
horario varchar(5),
status varchar(1),
id_cliente int not null,
id_profissional int not null,
foreign key(id_profissional) references tb_profissional (id_profissional)
);

#criar tabela de disponibilidade do funcionario

create table tb_disponibilidade (
dia date not null,
hora varchar(5) not null,
disponivel varchar(1) not null default'D',
id_disponibilidade int auto_increment primary key,
ocupado varchar(1)
);

#criar tabela de cliente

create table tb_cliente (
id_cliente int auto_increment primary key,
nome varchar(80) not null,
celular varchar(15) not null,
cpf varchar(14) not null,
foto varchar(80) not null,
telefone varchar(14),
sexo varchar(1) not null,
imgFundo varchar(80) not null,
id_endereco int not null,
id_loginC int not null,
foreign key(id_endereco) references tb_endereco (id_endereco)
);

#criar tabela do salão

create table tb_salao (
id_salao int auto_increment primary key,
cpf varchar(14) not null,
email varchar(60) not null,
celular varchar(15) not null,
telefone varchar(14),
nome varchar(80) not null,
cnpj varchar(18),
img varchar(80) not null,
id_endereco int not null,
id_loginS int not null,
foreign key(id_endereco) references tb_endereco (id_endereco)
);

#criar tabela de relacionamento entre profissional e salão

create table tb_salao_profissional (
id_salao int ,
id_profissional int ,
id_salao_profissional int auto_increment primary key,
foreign key(id_salao) references tb_salao (id_salao),
foreign key(id_profissional) references tb_profissional (id_profissional)
);

#criar tabela de relação de profissional e disponibilidade

create table tb_profissional_disponibilidade (
id_profissional int ,
id_disponibilidade int ,
id_prof_disponibilidade int auto_increment primary key,
foreign key(id_profissional) references tb_profissional (id_profissional),
foreign key(id_disponibilidade) references tb_disponibilidade (id_disponibilidade)
);

#criar tabela de login do cliente

create table tb_loginC (
id_login_cliente int auto_increment primary key,
usuario varchar(40),
senha varchar(60)
);

create table tb_loginS (
id_login_salao int auto_increment primary key,
usuario varchar(40),
senha varchar(60)
);

#adicinando as chaves estrangeiras de cada tabela

alter table tb_servico add foreign key(id_profissional) references tb_profissional (id_profissional);
alter table tb_atendimento add foreign key(id_profissional) references tb_profissional (id_profissional);
alter table tb_feed_foto add foreign key(id_salao) references tb_salao (id_salao);
alter table tb_agenda add foreign key(id_cliente) references tb_cliente (id_cliente);
alter table tb_cliente add foreign key(id_loginC) references tb_loginC (id_login_cliente);
alter table tb_salao add foreign key(id_loginS) references tb_loginS (id_login_salao);

select * from tb_cliente;

insert into tb_endereco(bairro,uf,cidade,logradouro,numero,complemento) 
values('jd maria beatriz','SP','CARAPICUIBA','EST EGILIO VITORELLO','132','AP 53 C');

insert into tb_loginC(usuario,senha) values('Filipe','123');

insert into tb_cliente(nome,celular,cpf,foto,sexo,imgFundo,id_endereco,id_loginC)
values('Filipe','(11) 94835-7012','464.471.848-36','img/boy.jpg','M','img/fundo.jpg',1,1);

SELECT s.nome, s.img,e.cidade,s.id_salao from tb_salao s 
            inner join tb_endereco e on s.id_endereco = e.id_endereco
            where e.cidade = 'CITY';
            select * from tb_cliente;
            
            
            SELECT cli.nome, cli.celular, cli.cpf,end.logradouro,end.bairro,
 	end.uf,end.cidade,end.numero,end.complemento from tb_cliente cli 
 	inner join tb_endereco end on cli.id_endereco = end.id_endereco
 	where cli.id_cliente = 1;
    
    
    update tb_cliente set nome = 'FLP', celular = '(11) 95647-4521', cpf = '123.456.222-33' where id_cliente = 1;
    
    