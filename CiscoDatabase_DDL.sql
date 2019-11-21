CREATE DATABSE cisco;
USE DATABASE cisco;

CREATE TABLE docente(
	id varchar(30) not null,
    nombre varchar(30) not null,
    apellido varchar(30) not null,
    contraseña varchar(30) not null,
    PRIMARY KEY(id)
);

CREATE TABLE alumnos(
	mat varchar(30) not null,
    nombre varchar(30) not null,
    apellido varchar(30) not null,
    contraseña varchar(30) not null,
    doc varchar(30) not null,
    FOREIGN KEY (doc) REFERENCES docente(id),
    PRIMARY KEY(mat)
);

