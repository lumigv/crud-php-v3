CREATE TABLE fabricante (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

CREATE TABLE producto (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  precio DOUBLE NOT NULL,
  tipo VARCHAR(100) NOT NULL,
  id_fabricante INT UNSIGNED NOT NULL,
  FOREIGN KEY (id_fabricante) REFERENCES fabricante(id)
);

INSERT INTO fabricante VALUES(1, 'Asus');
INSERT INTO fabricante VALUES(2, 'Lenovo');
INSERT INTO fabricante VALUES(3, 'Hewlett-Packard');
INSERT INTO fabricante VALUES(4, 'Samsung');
INSERT INTO fabricante VALUES(5, 'Seagate');
INSERT INTO fabricante VALUES(6, 'Crucial');
INSERT INTO fabricante VALUES(7, 'Gigabyte');
INSERT INTO fabricante VALUES(8, 'Huawei');
INSERT INTO fabricante VALUES(9, 'Xiaomi');
INSERT INTO fabricante VALUES(10, 'Logitech');

INSERT INTO producto VALUES(1, 'Disco duro SATA3 1TB', 86.99, 'Almacenamiento', 5);
INSERT INTO producto VALUES(2, 'Memoria RAM DDR4 8GB', 120, 'Almacenamiento', 6);
INSERT INTO producto VALUES(3, 'Disco SSD 1 TB', 150.99, 'Almacenamiento', 4);
INSERT INTO producto VALUES(4, 'GeForce GTX 1050Ti', 185, 'Procesamiento', 7);
INSERT INTO producto VALUES(5, 'GeForce GTX 1080 Xtreme', 755, 'Procesamiento', 6);
INSERT INTO producto VALUES(6, 'Monitor 24 LED Full HD', 202, 'Salida', 1);
INSERT INTO producto VALUES(7, 'Monitor 27 LED Full HD', 245.99, 'Salida', 1);
INSERT INTO producto VALUES(8, 'Portátil Yoga 520', 559, 'Equipo', 2);
INSERT INTO producto VALUES(9, 'Portátil Ideapd 320', 444, 'Equipo', 2);
INSERT INTO producto VALUES(10, 'Impresora HP Deskjet 3720', 59.99, 'Salida', 3);
INSERT INTO producto VALUES(11, 'Impresora HP Laserjet Pro M26nw', 180, 'Salida', 3);
INSERT INTO producto VALUES(12, 'Teclado para gaming G413 SE', 94.99, 'Entrada', 10);
INSERT INTO producto VALUES(13, 'Raton inalambrico', 16.99, 'Entrada', 10);
INSERT INTO producto VALUES(14, 'Placa base B650M S2H', 136.27, 'Procesamiento', 7);
INSERT INTO producto VALUES(15, 'Tarjeta de Memoria 512MB', 12 , 'E/S', 4);


