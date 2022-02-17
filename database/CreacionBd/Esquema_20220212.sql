use pablogarciajc_ecommerce;
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
CREATE TABLE categorias(
    id int(255) auto_increment not null,
    categorias varchar(100) not null,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
  ) ENGINE = InnoDb;
CREATE TABLE productos(
    id int(255) auto_increment not null,
    categoria_id int(255),
    nombre varchar(100),
    descripcion text,
    precio float(100, 0),
    stock int(255),
    oferta float(100, 0),
    marca varchar(50),
    memoria_ram float(100, 0),
    imagen varchar(255),
    CONSTRAINT pk_categorias PRIMARY KEY(id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
  ) ENGINE = InnoDb;
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
CREATE table pedidos(
    id int(255) auto_increment,
    usuario_id int(255),
    pais varchar(100),
    ciudad varchar(100),
    direccion varchar(255),
    codigoPostal varchar(10),
    coste float(200, 2),
    estado varchar(20),
    fecha date,
    hora time,
    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES Usuarios(Id)
    
  ) ENGINE = InnoDb;

  use pablogarciajc_ecommerce;