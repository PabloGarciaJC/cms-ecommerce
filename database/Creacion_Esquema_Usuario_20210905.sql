create database pablogarciajc_ecommerce;

use pablogarciajc_ecommerce;

create table Paises(
Id int auto_increment,
Nombre varchar(55),
constraint PK_PAISES PRIMARY KEY (Id),
constraint UQ_PAISES UNIQUE (Nombre)
)Engine=InnoDB;

create table Estados(
Id int auto_increment,
Nombre varchar(55),
Id_Pais int,
constraint PK_ESTADOS PRIMARY KEY (Id),
constraint FK_ESTADOS_PAISES FOREIGN KEY (Id_Pais) REFERENCES Paises(Id),
constraint UQ_ESTADOS UNIQUE (Nombre)
)Engine=InnoDB;

create table Ciudades(
Id int auto_increment,
Nombre varchar(55),
Id_Estado int,
constraint PK_CIUDADES PRIMARY KEY (Id),
constraint FK_CIUDADES_ESTADOS FOREIGN KEY (Id_Estado) REFERENCES Estados(Id),
constraint UQ_CIUDADES UNIQUE (Nombre)
)Engine=InnoDB;

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
CodigoPostal varchar(10),
Rol varchar(30),
Id_Pais int,
Id_Estado int,
Id_Ciudad int,
Url_Avatar varchar(200),
Url_Documento varchar(200),
constraint PK_USUARIOS PRIMARY KEY (Id),
constraint FK_USUARIOS_PAISES FOREIGN KEY (Id_Pais) REFERENCES Paises(Id),
constraint FK_USUARIOS_ESTADOS FOREIGN KEY (Id_Estado) REFERENCES Estados(Id),
constraint FK_USUARIOS_CIUDADES FOREIGN KEY (Id_Ciudad) REFERENCES Ciudades(Id),
constraint UQ_USUARIOS_USUARIO UNIQUE (Usuario),
constraint UQ_USUARIOS_EMAIL UNIQUE (Email)
)Engine=InnoDB;