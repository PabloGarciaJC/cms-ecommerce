SELECT * FROM pedidos;

  INSERT INTO pedidos (id, usuario_id, pais, ciudad, direccion, codigoPostal, coste, estado, fecha, hora) VALUES (null, 2, 'Armenia', 'Yerevan', 'La victoria', '20082', 331.8, 'confirm', CURDATE(), CURTIME());