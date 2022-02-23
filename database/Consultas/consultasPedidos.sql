SELECT * FROM pedidos;

  INSERT INTO pedidos (id, usuario_id, pais, ciudad, direccion, codigoPostal, coste, estado, fecha, hora) VALUES (null, 2, 'Armenia', 'Yerevan', 'La victoria', '20082', 331.8, 'confirm', CURDATE(), CURTIME());


  SELECT p.usuario_id FROM pedidos p INNER JOIN lineas_pedidos lp ON p.id = lp.pedido_id WHERE lp.pedido_id = 32;


  SELECT u.* FROM usuarios u 
  INNER JOIN pedidos p 
  ON u.Id = p.usuario_id WHERE p.id = 34;


  SELECT pr.*, lp.unidades, c.categorias as nombreCategoria FROM productos pr 
  INNER JOIN lineas_pedidos lp 
  ON pr.id = lp.producto_id 
  INNER JOIN categorias c 
  ON pr.categoria_id = c.id 
   WHERE lp.pedido_id=34;