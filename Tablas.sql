-- Tabla Usuario
CREATE TABLE Usuario (
    ci INT PRIMARY KEY,
    nombre VARCHAR(30),
    apellido VARCHAR(30),
    email VARCHAR(50) UNIQUE,
    contrasenia VARCHAR(50)
);

-- Tabla Partidos
CREATE TABLE Partidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    grupo CHAR(1) NOT NULL,
    equipo_1 VARCHAR(30) NOT NULL,
    equipo_2 VARCHAR(30) NOT NULL,
    goles_equipo_1 INT,
    goles_equipo_2 INT
);

-- Tabla Predicciones
CREATE TABLE Predicciones (
    idPrediccion INT PRIMARY KEY AUTO_INCREMENT,
    usuario_ci INT,
    nombre VARCHAR(30) UNIQUE,
    FOREIGN KEY (usuario_ci) REFERENCES Usuario(ci)
);

-- Tabla Prediccion_Partidos
CREATE TABLE Prediccion_Partidos (
    idPrediccion INT,
    partido_id INT,
    prediccion_goles_Equipo1 INT,
    prediccion_goles_Equipo2 INT,
    PRIMARY KEY (idPrediccion, partido_id),
    FOREIGN KEY (idPrediccion) REFERENCES Predicciones(idPrediccion),
    FOREIGN KEY (partido_id) REFERENCES Partidos(id)
);

-- Tabla Penca-General
CREATE TABLE Penca_General (
    idPencaGeneral INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) UNIQUE,
    Usuario INT,
    idPrediccion INT,
    puntosActuales INT,
    puesto INT,
    FOREIGN KEY (idPrediccion) REFERENCES Predicciones(idPrediccion),
    FOREIGN KEY (Usuario) REFERENCES Usuario(ci)
);


-- Tabla Penca-Grupal
CREATE TABLE Penca_Grupal (
    idPencaGrupal INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) UNIQUE,
    Usuario INT,
    codigoInvitacion TEXT,
    idPrediccion INT,
    puntosActuales INT,
    puesto INT,
    FOREIGN KEY (idPrediccion) REFERENCES Predicciones(idPrediccion),
    FOREIGN KEY (Usuario) REFERENCES Usuario(ci)
);


-- Insertar datos de ejemplo en la tabla Partidos
INSERT INTO Partidos (grupo, equipo_1, equipo_2)
VALUES
('A', 'Argentina', 'Peru'),
('A', 'Chile', 'Canada'),
('B', 'Mexico', 'Colombia'),
('B', 'Venezuela', 'Jamaica'),
('C', 'Estados Unidos', 'Uruguay'),
('C', 'Republica Dominicana', 'Bolivia'),
('D', 'Brasil', 'Ecuador'),
('D', 'Paraguay', 'Honduras');
