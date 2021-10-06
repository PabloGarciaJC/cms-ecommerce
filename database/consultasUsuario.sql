use pablogarciajc_ecommerce;

SELECT * FROM usuarios;

insert into Usuarios (Rol) values ('Admin');

UPDATE Usuarios SET Rol = 'Admin' WHERE Id = 5;

UPDATE Usuarios SET Nombres = 'Pepito' WHERE Id = 6;

UPDATE Usuarios SET Nombres = 'Pablo' WHERE Id = 10;

SELECT Usuario, Email from usuarios where usuario LIKE "%vegeta%" OR Email Like "%vegeta@vegeta.com%";

UPDATE Usuarios SET Usuario = '', NumeroDocumento = '', NroTelefono = '', Url_Avatar = '' WHERE Id = 15;