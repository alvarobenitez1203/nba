DROP DATABASE IF EXISTS nba;
CREATE DATABASE nba;

USE nba;

CREATE TABLE nba.usuarios (
	idusuario INT auto_increment NOT NULL,
	nombre varchar(100) NOT NULL,
	email varchar(50) NOT null UNIQUE,
	contrasenna varchar(150) NOT NULL,
	telefono INT NOT NULL,
	CONSTRAINT usuarios_pk PRIMARY KEY (idusuario)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


CREATE TABLE nba.equipos (
	idequipo INT auto_increment NOT NULL,
	nombre varchar(60) NOT NULL,
	pais varchar(60) NOT NULL,
	annofundacion INT(4) NOT NULL,
	conferencia varchar(10) NOT NULL,
	CONSTRAINT equipos_pk PRIMARY KEY (idequipo)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE nba.jugadores (
	idjugador INT auto_increment NOT NULL,
	nombre varchar(100) NOT NULL,
	edad INT(2) NOT NULL,
	posicion varchar(15) NOT NULL,
	nacionalidad varchar(60) NOT NULL,
	disponible BOOL NOT null default TRUE,
	idequipo INT NULL,
	CONSTRAINT jugadores_pk PRIMARY KEY (idjugador),
	CONSTRAINT jugadores_FK FOREIGN KEY (idequipo) REFERENCES nba.equipos(idequipo)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE nba.trofeos (
	idtrofeo INT auto_increment NOT NULL,
	nombre varchar(60) NOT NULL,
	tipo varchar(15) NOT NULL,
	CONSTRAINT trofeos_pk PRIMARY KEY (idtrofeo)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE nba.trofeos_jugadores (
	idtrofeo_jugador INT auto_increment NOT NULL,
	idtrofeo INT NOT NULL,
	idjugador INT NOT NULL,
	cantidad INT NOT NULL,
	annos varchar(150) NOT NULL,
	CONSTRAINT trofeos_jugadores_pk PRIMARY KEY (idtrofeo_jugador),
	CONSTRAINT trofeos_jugadores_FK FOREIGN KEY (idtrofeo) REFERENCES nba.trofeos(idtrofeo),
	CONSTRAINT trofeos_jugadores_FK_1 FOREIGN KEY (idjugador) REFERENCES nba.jugadores(idjugador)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE nba.trofeos_equipos (
	idtrofeo_equipo INT auto_increment NOT NULL,
	idtrofeo INT NOT NULL,
	idequipo INT NOT NULL,
	cantidad INT NOT NULL,
	annos varchar(150) NOT NULL,
	CONSTRAINT trofeos_equipos_pk PRIMARY KEY (idtrofeo_equipo),
	CONSTRAINT trofeos_equipos_FK FOREIGN KEY (idtrofeo) REFERENCES nba.trofeos(idtrofeo),
	CONSTRAINT trofeos_equipos_FK_1 FOREIGN KEY (idequipo) REFERENCES nba.equipos(idequipo)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;
