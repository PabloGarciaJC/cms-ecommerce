use pablogarciajc_ecommerce;
SELECT * FROM usuarios;

UPDATE Usuarios SET Rol = 'Admin' WHERE Id = 2;

UPDATE Usuarios SET Rol = 'Admin' WHERE Id = 1;

insert into Usuarios (Rol) values ('Admin');

UPDATE Usuarios SET Rol = 'Admin' WHERE Id = 2;

UPDATE Usuarios SET Nombres = 'Pepito' WHERE Id = 6;

UPDATE Usuarios SET Nombres = 'Pablo' WHERE Id = 10;

SELECT Usuario, Email from usuarios where usuario LIKE "%vegeta%" OR Email Like "%vegeta@vegeta.com%";

UPDATE Usuarios SET Usuario = '', NumeroDocumento = '', NroTelefono = '', Url_Avatar = '' WHERE Id = 15;

ALTER TABLE ciudades CHANGE COLUMN idCiudades Id int(11) NOT NULL;
ALTER TABLE ciudades CHANGE COLUMN Paises_Codigo Id_Pais varchar(2) NOT NULL;

ALTER TABLE ciudades ADD CONSTRAINT FK_CIUDADES_PAISES FOREIGN KEY (Id_Pais) REFERENCES Paises(Id);