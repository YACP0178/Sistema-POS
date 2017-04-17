create database datospos;
use datospos;

create table user(
	id int not null auto_increment primary key,
	name varchar(50) not null,
	lastname varchar(50) not null,
	username varchar(50),
	password varchar(60) not null,
	status int not null default 1
);


create table category(
	id int not null auto_increment primary key,
	code varchar(50) not null,
	name varchar(50) not null,
	status int not null default 1
);

INSERT INTO `category` (`id`,`code`,`name`,`status`) VALUES (1, '0', '0', 2),(2, '001', 'Categoria Prueba', 1);

create table customer(
	id int not null auto_increment primary key,
	cc varchar(20) not null,
	name varchar(50) not null,
	lastname varchar(50) not null,
	email varchar(50),
	phone varchar(50),
	address varchar(255),
	status int not null default 1
);

create table provider(
	id int not null auto_increment primary key,
	nit varchar(20) not null,
	name varchar(50) not null,
	lastname varchar(50) not null,
	email varchar(50),
	phone varchar(50),
	address varchar(255),
	status int not null default 1
);

create table tax(
	id int not null auto_increment primary key,
	name varchar(60)  not null,
	value int not null,
	status int not null default 1
);

INSERT INTO `tax` (`id`,`name`,`value`,`status`) VALUES (1, '', 0, 2);
INSERT INTO `tax` (`name`,`value`) VALUES ('IVA', 16);

create table product(
	id int not null auto_increment primary key,
	code varchar(20),
	ref varchar(50) not null,
	description varchar(255) not null,
	unit varchar(255),
	category int,
	tax int,
	size varchar(50),
	coste float,
	price float,
	stockmin int default 1,
	location varchar(255),
	status int not null default 1,
	foreign key (category) references category(id),
	foreign key (tax) references tax(id)
);

create table movement(
	id int not null auto_increment primary key,
	name varchar(60)  not null,
	type varchar(1) not null,
	status int not null default 1
);

INSERT INTO `movement` (`id`,`name`,`type`) VALUES
('1','COMPRA','E'),('2','COMPRA DEVOLCUIÓN','E'),('3','VENTA','S'),('4','VENTA DEVOLCUIÓN','S');


create table stock(
	id int not null auto_increment primary key,
	product int not null,
	cant int not null,
	coste float,
	status int not null default 1,
	foreign key (product) references product(id)
);

create table inventory(
	id int not null auto_increment primary key,
	stock int not null,
	date datetime NOT NULL,
	movement int not null,
	user int not null,
	ecant int not null,
	evalue float not null,
	scant int not null,
	svalue float not null,
	pcant int not null,
	pvalue float not null,
	status int not null default 1,
	foreign key (movement) references movement(id),
	foreign key (stock) references stock(id),
	foreign key (user) references user(id)
);


create table input(
	id int not null auto_increment primary key,
	code varchar(20),
	date datetime NOT NULL,
	user int not null,
	provider int,
	movement int not null,
	status int not null default 1,
	foreign key (movement) references movement(id),
	foreign key (user) references user(id),
	foreign key (provider) references provider(id)
);

create table input_dt(
	id int not null auto_increment primary key,
	input int not null, 
	product int not null,
	cant int not null,
	discount int,
	value float,
	flete float,
	status int not null default 1,
	foreign key (product) references product(id),
	foreign key (input) references input(id)
);

create table output(
	id int not null auto_increment primary key,
	code varchar(20),
	date datetime NOT NULL,
	user int not null,
	customer int,
	movement int not null,
	status int not null default 1,
	foreign key (movement) references movement(id),
	foreign key (user) references user(id),
	foreign key (customer) references customer(id)
);

create table output_dt(
	id int not null auto_increment primary key,
	output int not null, 
	product int not null,
	cant int not null,
	discount int,
	value float,
	status int not null default 1,
	foreign key (product) references product(id),
	foreign key (output) references output(id)
);

create table config(
	id int not null auto_increment primary key,
	company varchar(60),
	manager varchar(255),
	nit varchar(20),
	address varchar(255),
	phone varchar(60),
	mean int,
	status int not null default 1
);

create table closing(
	id int not null auto_increment primary key,
	date datetime NOT NULL,
	description varchar(255),
	status int not null default 1
);

create table closing_dt(
	id int not null auto_increment primary key,
	closing int,
	product int not null,
	provider int,
	cant int,
	coste float,
	status int not null default 1,
	foreign key (closing) references closing(id),
	foreign key (product) references product(id),
	foreign key (provider) references provider(id)
);



INSERT INTO `provider` (`nit`,`name`,`lastname`,`email`, `phone`,`address`) 
VALUES ('1094938559', 'Proveedor', 'S.A.S', 'proveedor@gmail.com', '3108463797', "Villa ximena Mz 5 casa No 7");

INSERT INTO `user` (`name`, `lastname`, `username`, `password`, `status`) VALUES
('Bernardo', 'Zuluaga Aristizabal', 'admin','1234', 1);



INSERT INTO `product` (`code`,`ref`,`description`,`category`, `tax`,`coste`, `price`, `stockmin`,`location`) 
VALUES ('001', '001', 'Producto1', '2', '2', '10000','20000','10',''),
('002', '002', 'Producto2', '2', '2', '9000','17000','10',''),
('003', '003', 'Producto3', '2', '2', '7500','12000','10','');

INSERT INTO `config` (`company`,`manager`,`nit`,`phone`,`address`,`mean`)
VALUES ('Sitema Pos',  'Bernardo Alexander Zuluaga Aristizabal','1094938559', '3108463797', 'Barrio Sistema Pos',1);


INSERT INTO `customer` (`cc`,`name`,`lastname`,`email`, `phone`,`address`) 
VALUES ('1094938559', 'Ciente', 'Apellido cliente', 'cliente@gmail.com', '3108463797', "Villa ximena Mz 5 casa No 7");