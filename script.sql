DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS recluso;
DROP TABLE IF EXISTS celda;
DROP TABLE IF EXISTS pabellon;

create table usuario( 
    id_usuario serial, 
    nombre varchar(100), 
    apellido varchar(100), 
    correo varchar(100) unique, 
    clave varchar(100), 
    roles json, 
	estado varchar(1),
	
    constraint pk_usuario primary key (id_usuario) 
); 

create table pabellon(
	id_pabellon serial,
	nombre varchar(50),
	cant_celdas int,
	estado varchar(1),

	constraint pk_ticket primary key(id_pabellon)
);

create table celda(
	id_celda serial,
	capacidad int,
	estado varchar(1),
	id_pabellon int,

	constraint pk_celda primary key(id_celda),

	constraint fk_celda_pabellon foreign key(id_pabellon)
		references pabellon (id_pabellon)

);

create table recluso(
	id_recluso serial,
	identificacion varchar(12),
	delitos JSON,
	sentencia int,
	ficha_ingreso boolean,
	estado varchar(1),
	id_pabellon int,

	constraint pk_recluso primary key(id_recluso),
	
	constraint fk_recluso_pabellon foreign key(id_pabellon)
		references pabellon(id_pabellon)

);

INSERT INTO usuario(
nombre, apellido, correo, clave, roles)
VALUES
(
'Josthin', 'Ayon', 'oswayon9@hotmail.com',
'$2y$13$yE9EI8TQZ04C9HWWmcpWOuLQbm8l/zAHa2SKr.EpkyQLhengUBMuS',
'["ROLE_ADMIN"]'
);
