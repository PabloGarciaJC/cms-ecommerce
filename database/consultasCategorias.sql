
use pablogarciajc_ecommerce;

insert into categorias (nombre) VALUES ('Pablo');

insert into categorias (nombre, Fecha_Ingreso) VALUES ('Pablo', CURDATE());

SELECT nombre, DATE_FORMAT(Fecha_Ingreso, "%d / %m / %Y") AS Fecha_Ingreso from categorias WHERE id = 2;

SELECT * from categorias;




