DROP DATABASE juzz;
CREATE DATABASE juzz;

use juzz;

CREATE TABLE IF NOT EXISTS USUARIOS(
	id 			BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre		VARCHAR(30) NOT NULL,
	ape1 		VARCHAR(30) NOT NULL,
	ape2 		VARCHAR(30) NOT NULL,
	email       VARCHAR(90) NOT NULL,
            CONSTRAINT USU_EMA_UK UNIQUE(email),
    password    CHAR(60) NOT NULL,
    activo 		BOOLEAN DEFAULT FALSE NOT NULL,
    ingreso		DATE NOT NULL
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Usuario";

CREATE TABLE IF NOT EXISTS CANALES(
	id 			BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre		VARCHAR(60) NOT NULL,
		CONSTRAINT CAN_NOM_UK UNIQUE(nombre),
	descripcion	MEDIUMTEXT,
	creacion 	DATE NOT NULL,
	usuario_id 	BIGINT UNSIGNED NOT NULL,
		CONSTRAINT CAN_FK FOREIGN KEY(usuario_id)
			REFERENCES USUARIOS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Canales";

CREATE TABLE IF NOT EXISTS PROGRAMAS(
	id 			BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre		VARCHAR(60) NOT NULL,
	descripcion	MEDIUMTEXT,
	creacion 	DATE NOT NULL,
	canal_id 		BIGINT UNSIGNED NOT NULL,
		CONSTRAINT PRO_FK FOREIGN KEY(canal_id)
			REFERENCES CANALES(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Programas";

CREATE TABLE IF NOT EXISTS SEGUIDORES(
	seguido_id  BIGINT UNSIGNED,
	 CONSTRAINT SEG_SEGUIDO_FK FOREIGN KEY(seguido_id) REFERENCES USUARIOS(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	seguidor_id BIGINT UNSIGNED,
	 CONSTRAINT SEG_SEGUIDOR_FK FOREIGN KEY(seguidor_id) REFERENCES USUARIOS(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT SEG_PK PRIMARY KEY(seguido_id,seguidor_id),
	fecha DATE NOT NULL,
	bloqueado	BOOLEAN DEFAULT FALSE NOT NULL
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Seguidores";

CREATE TABLE IF NOT EXISTS SUBSCRIPCIONES_PROGRAMAS(
	usuario_id BIGINT UNSIGNED,
	 CONSTRAINT SUBS_USU_FK FOREIGN KEY(usuario_id) REFERENCES USUARIOS(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	programa_id BIGINT UNSIGNED,
	 CONSTRAINT SUBS_PRO_FK FOREIGN KEY(programa_id) REFERENCES PROGRAMAS(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT SUBS_PK PRIMARY KEY(usuario_id,programa_id),
	fecha DATE NOT NULL,
	aviso BOOLEAN DEFAULT FALSE NOT NULL
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Subscripciones";

CREATE TABLE IF NOT EXISTS LIKES_PROGRAMAS(
	subscriptor_id BIGINT UNSIGNED,
	 CONSTRAINT LIK_USU_FK FOREIGN KEY(subscriptor_id) REFERENCES USUARIOS(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	subscripcion_id BIGINT UNSIGNED,
	 CONSTRAINT LIK_PRO_FK FOREIGN KEY(subscripcion_id) REFERENCES PROGRAMAS(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	fecha DATE NOT NULL,
	CONSTRAINT LIKPRO_PK PRIMARY KEY(subscriptor_id,subscripcion_id)
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de LIKES";

CREATE TABLE IF NOT EXISTS TERMINOS(
	id 		BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre	VARCHAR(30) NOT NULL,
		CONSTRAINT TER_UK UNIQUE(nombre),
	slug	VARCHAR(30) NOT NULL,
		CONSTRAINT SLU_UK UNIQUE(nombre),
	descripcion	MEDIUMTEXT
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Terminos";

CREATE TABLE IF NOT EXISTS CATEGORIAS(
	termino_id 		BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	CONSTRAINT CAT_TER_FK FOREIGN KEY(termino_id)
			REFERENCES TERMINOS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
	parent_id 	BIGINT UNSIGNED,
	 CONSTRAINT CAT_FK FOREIGN KEY(parent_id)
			REFERENCES CATEGORIAS(termino_id)
				ON DELETE CASCADE
				ON UPDATE CASCADE
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Categorias";

CREATE TABLE IF NOT EXISTS ETIQUETAS(
	termino_id 		BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		CONSTRAINT ETQ_TER_FK FOREIGN KEY(termino_id)
			REFERENCES TERMINOS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
	count	INTEGER	UNSIGNED DEFAULT 0 NOT NULL
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Categorias";


CREATE TABLE IF NOT EXISTS CATEGORIAS_USUARIOS(
	usuario_id BIGINT UNSIGNED,
	 CONSTRAINT CATUSU_USU_FK FOREIGN KEY(usuario_id)
	 	REFERENCES USUARIOS(id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	categoria_id 	BIGINT UNSIGNED,
	 CONSTRAINT CATUSU_CAT_FK FOREIGN KEY(categoria_id)
	 	REFERENCES CATEGORIAS(termino_id)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	CONSTRAINT CATUSU_PK PRIMARY KEY(usuario_id,categoria_id),
	orden	TINYINT UNSIGNED NOT NULL
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Categorias usuarios";

CREATE TABLE IF NOT EXISTS GENEROS(
	id 		BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre	VARCHAR(30) NOT NULL,
		CONSTRAINT GEN_NOM_UK UNIQUE(nombre),
	descripcion MEDIUMTEXT
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Generos";

CREATE TABLE IF NOT EXISTS EPISODIOS(
	id 		BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	titulo	VARCHAR(30) NOT NULL,
	file	VARCHAR(60) NOT NULL,
		CONSTRAINT EPI_FIL_UK UNIQUE(file),
	descripcion MEDIUMTEXT,
	poster	VARCHAR(60) NOT NULL,
	duracion TIME NOT NULL,
	categoria_id BIGINT UNSIGNED NOT NULL,
		CONSTRAINT EPI_CAT_FK FOREIGN KEY(categoria_id)
			REFERENCES CATEGORIAS(termino_id)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
	genero_id  BIGINT UNSIGNED NOT NULL,
		CONSTRAINT EPI_GEN_FK FOREIGN KEY(genero_id)
			REFERENCES GENEROS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
	programa_id BIGINT UNSIGNED NOT NULL,
		CONSTRAINT EPI_PRO_FK FOREIGN KEY(programa_id)
			REFERENCES PROGRAMAS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE
)ENGINE=INNODB CHARSET=LATIN1 COMMENT="Tabla de Episodios";

CREATE TABLE IF NOT EXISTS COMENTARIOS(
	id 			BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	fecha 		DATE NOT NULL,
	valido 		BOOLEAN NOT NULL DEFAULT TRUE,
	contenido	MEDIUMTEXT NOT NULL,
	parent_id		BIGINT UNSIGNED,
	 CONSTRAINT COM_PAR_FK FOREIGN KEY(parent_id)
			REFERENCES COMENTARIOS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
	propietario_id	BIGINT UNSIGNED NOT NULL,
			CONSTRAINT COM_PRO_FK FOREIGN KEY(propietario_id)
				REFERENCES USUARIOS(id)
					ON DELETE CASCADE
					ON UPDATE CASCADE,
	target	BIGINT UNSIGNED NOT NULL
)ENGINE=INNODB CHARSET=LATIN1 COMMENT='Tabla de Comentarios';

/* Implemetar disparador para que el target y el propietario no sean el mismo*/

/* Implementar disparador para que cuando se borre una tupla que sea objetivo de mucho comentarios, se borre dichos comentarios*/

CREATE TABLE IF NOT EXISTS NOTIFICACIONES(
	id 			BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	fecha		DATETIME NOT NULL,
	tipo		ENUM('NUEVO_EPISODIO','RESPUESTA_COMENTARIO') NOT NULL,
	vista		BOOLEAN NOT NULL DEFAULT FALSE,
	target_id      BIGINT UNSIGNED NOT NULL,
		CONSTRAINT NOT_FK FOREIGN KEY(target_id)
			REFERENCES USUARIOS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
	fuente      BIGINT UNSIGNED NOT NULL
)ENGINE=INNODB CHARSET=LATIN1 COMMENT='Tabla de Notificaciones';

/* Trabajar más tema de las actividades*/

CREATE TABLE IF NOT EXISTS ACTIVIDADES_USUARIOS(
	id 			BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	fecha       DATETIME NOT NULL,
	tipo		ENUM('PRUEBA') NOT NULL,
	usuario_id      BIGINT UNSIGNED NOT NULL,
		CONSTRAINT ACTU_FK FOREIGN KEY(usuario_id)
			REFERENCES USUARIOS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE
)ENGINE=INNODB CHARSET=LATIN1 COMMENT='Tabla de actividades  de los usuarios';

CREATE TABLE IF NOT EXISTS ACTIVIDADES_CANALES(
	id 			BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	fecha       DATETIME NOT NULL,
	tipo		ENUM('PRUEBA') NOT NULL,
	usuario_id      BIGINT UNSIGNED NOT NULL,
		CONSTRAINT ACTC_FK FOREIGN KEY(usuario_id)
			REFERENCES USUARIOS(id)
				ON DELETE CASCADE
				ON UPDATE CASCADE
)ENGINE=INNODB CHARSET=LATIN1 COMMENT='Tabla de actividades  de los usuarios';


mapping_types:
            enum: string
            set: string
            varbinary: string
            tinyblob: text

php app/console generate:bundle --namespace=juzz/juzzBundle --format=yml
php app/console doctrine:mapping:convert xml ./src/juzz/juzzBundle/Resources/config/doctrine/metadata/orm --from-database --force
php app/console doctrine:mapping:import AppBundlejuzzBundle annotation
php app/console doctrine:generate:entities AppBundlejuzzBundle --no-backup
-- Para Cargar Fixtures
php app/console doctrine:fixtures:load
