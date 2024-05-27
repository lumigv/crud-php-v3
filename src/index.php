<?php
/*Incluye parámetros de conexión a la base de datos: 
DB_HOST: Nombre o dirección del gestor de BD MariaDB
DB_NAME: Nombre de la BD
DB_USER: Usuario de la BD
DB_PASSWORD: Contraseña del usuario e la BD
*/

include_once("config.php");

//Consulta de selección. Selecciona todos los usuarios ordenados de manera descendente por el campo id


//$result = mysqli_query($mysqli, "SELECT * FROM producto ORDER BY id DESC");
$result = mysqli_query($mysqli, "select a.id id, a.nombre nombre, a.precio precio, a.tipo tipo, b.nombre fabricante
from producto a, fabricante b where a.id_fabricante=b.id ORDER BY nombre ASC");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Panel de control</title>
	<!--bootstrap-->
	<!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
	<!--
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	-->	
</head>
<body>
<!--Bootstrap-->	
<!--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
-->
<div>
	<header>
		<h1>Panel de Control</h1>
	</header>

	<main>
	<ul>
		<li><a href="index.php">Inicio</a></li>
		<li><a href="add.php">Alta</a></li>
	</ul>
	<h2>Listado de productos</h2>
	<table border="1">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Fabricante</th>
			<th>Tipo</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbdody>
<?php
/*mysqli_fetch_array- Busca una fila de una consulta y devuelve un array asociativo
ARRAYS CON ÍNDICE
$productos = array();
$productos[0] = "Disco SSD";
$productos[1] = "Memoria RAM";
$productos[2] = "Monitor";
ARRAYS ASOCIATIVO:
$res["id"] = "7";
$res["name"] = "Pedro";
$res["price"] = "Zapata";
$res["code"] = "23";
*/
//Genera la tabla de la página inicial
	while($res = mysqli_fetch_array($result)) {
		echo "<tr>\n";
		echo "<td>".$res['nombre']."</td>\n";
		echo "<td>".$res['precio']."</td>\n";
		echo "<td>".$res['fabricante']."</td>\n";
		echo "<td>".$res['tipo']."</td>\n";
		echo "<td>";
//En la última columna se añader dos enlaces para editar y modificar el registro correspondiente. Se le pasa por el método GET el id del registro		
		echo "<a href=\"edit.php?id=$res[id]\">Editar</a>\n";
		echo "<a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('¿Está segur@ que desea eliminar el registro?')\" >Eliminar</a></td>\n";
		echo "</td>";
		echo "</tr>\n";
	}
//Cierra la conexión de BD previamente abierta
	mysqli_close($mysqli);
	?>
	</tbdody>
	</table>
	</main>
	<footer>
    Created by the IES Miguel Herrero team &copy; 2024
  	</footer>
</div>
</body>
</html>
