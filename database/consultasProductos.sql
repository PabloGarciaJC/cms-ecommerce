INSERT INTO productos (imagen) VALUES ('hola');

select * from productos;

INSERT INTO productos (nombre) VALUES ('hola');

UPDATE Productos SET imagen = "google";

SELECT p.id, p.imagen, p.nombre, p.marca, p.stock, p.precio, p.oferta, c.categorias from productos p INNER JOIN categorias c ON p.categoria_id = c.id ORDER BY c.id DESC;

SELECT p.id, p.imagen, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.categoria_id, c.categorias as nombreCategoria from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.categoria_id = 13;
  
SELECT p.id, p.nombre, p.marca, p.stock, p.precio, p.oferta, c.categorias from productos p
INNER JOIN categorias c ON p.categoria_id = c.id WHERE (p.nombre LIKE '%%' OR p.marca LIKE '%%' OR p.stock LIKE '%%' OR p.precio LIKE '%%' OR p.oferta LIKE '%%' OR c.categorias LIKE '%%');

SELECT p.id, p.nombre, p.marca, p.stock, p.precio, p.oferta, c.categorias from productos p
INNER JOIN categorias c ON p.categoria_id = c.id ORDER BY c.id DESC;

SELECT count(id) as 'registros_totales' FROM productos;

SELECT * FROM productos where categoria_id = 10;


   SELECT p.id, p.imagen, p.nombre, p.marca, p.stock, p.precio, p.oferta, p.categoria_id, c.categorias as nombreCategoria from productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.categoria_id  = 10 ORDER BY p.id DESC LIMIT 1,3;
  

