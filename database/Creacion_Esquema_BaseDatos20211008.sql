CREATE TABLE IF NOT EXISTS `Paises` (
  `Codigo` varchar(2) NOT NULL,
  `Pais` varchar(100) NOT NULL,
  PRIMARY KEY (`Codigo`)
) Engine = InnoDB;
ALTER TABLE
  Paises CHANGE COLUMN Codigo Id varchar(2) NOT NULL;
CREATE TABLE IF NOT EXISTS `Ciudades` (
    `idCiudades` int(11) NOT NULL AUTO_INCREMENT,
    `Paises_Codigo` varchar(2) NOT NULL,
    `Ciudad` varchar(100) NOT NULL,
    PRIMARY KEY (`idCiudades`),
    KEY `Paises_Codigo` (`Paises_Codigo`),
    KEY `Ciudad` (`Ciudad`)
  ) Engine = InnoDB;
ALTER TABLE
  ciudades CHANGE COLUMN idCiudades Id int(11) NOT NULL;
ALTER TABLE
  ciudades CHANGE COLUMN Paises_Codigo Id_Pais varchar(2) NOT NULL;
create table Usuarios(
    Id int auto_increment,
    Usuario varchar(55),
    Password varchar(200),
    NumeroDocumento varchar(20),
    Nombres varchar(100),
    Apellidos varchar(100),
    Email varchar(100),
    NroTelefono varchar (30),
    Direccion varchar(250),
    Pais varchar(100),
    Ciudad varchar(100),
    CodigoPostal varchar(10),
    Rol varchar(30),
    Url_Avatar varchar(200),
    constraint PK_USUARIOS PRIMARY KEY (Id),
    constraint UQ_USUARIOS_USUARIO UNIQUE (Usuario),
    constraint UQ_USUARIOS_EMAIL UNIQUE (Email)
  ) Engine = InnoDB;
use pablogarciajc_ecommerce;
CREATE TABLE categorias(
    id int(255) auto_increment not null,
    categorias varchar(100) not null,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
  ) ENGINE = InnoDb;
use pablogarciajc_ecommerce;
CREATE TABLE productos(
    id int(255) auto_increment not null,
    categoria_id int(255),   
    nombre varchar(100),
    descripcion text,
    precio float(100, 2),    
    stock int(255),
    oferta float(100,0),
    marca varchar(50),
    /* memoria_ram varchar(50), */
    memoria_ram float(100,0),
    imagen varchar(255),
    CONSTRAINT pk_categorias PRIMARY KEY(id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
  ) ENGINE = InnoDb;