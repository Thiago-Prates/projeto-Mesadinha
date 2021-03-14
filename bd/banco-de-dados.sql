create database projetoMesadinha;
use projetoMesadinha;




create table usuario(
id int unsigned not null auto_increment primary key,
nome varchar(100) not null,
email varchar(150) not null,
endereco varchar(150) not null,
telefone char(15) not null,
senha varchar(150) not null
)engine=innodb;

create table categoria(
id int unsigned not null auto_increment primary key,
name varchar(50) not null,
usuario_id int unsigned not null,
foreign key(usuario_id) references usuario(id)
)engine=innodb;

create table conta(
id int unsigned not null auto_increment primary key,
nome varchar(100) not null,
tipo varchar(10) not null, 
usuario_id int unsigned not null,
categoria_id int unsigned not null,
foreign key(usuario_id) references usuario(id),
foreign key(categoria_id) references categoria(id)
)engine=innodb;

create table lancamento(
cod int unsigned not null auto_increment primary key,
valor double not null,
data date not null,
usuario_id int unsigned not null,
conta_id int unsigned not null,
foreign key(usuario_id) references usuario(id),
foreign key(conta_id) references conta(id)
)engine=innodb;
