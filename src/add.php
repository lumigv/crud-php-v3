<?php
//Incluye fichero con parámetros de conexión a la base de datos
include_once("config.php");

echo "Bloque1\n";



if(isset($_POST['inserta'])) 
{
//Obtiene los datos (name, price y code) a partir del formulario de alta por el método POST (Se envía a través del body del HTTP Request. No aparece en la URL)
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$price = mysqli_real_escape_string($mysqli, $_POST['price']);
	$code = mysqli_real_escape_string($mysqli, $_POST['code']);

	echo "Bloque2\n";	
	if(empty($name) || empty($code) || empty($price)) 
	{
		if(empty($name)) {
			echo "<div>Campo nombre vacío.</div>";
		}

		if(empty($price)) {
			echo "<div>Campo apellido vacío</div>";
		}

		if(empty($code)) {
			echo "<div>Campo Fabricante vacío.</div>";
		}
//Enlace a la página anterior
		echo "<a href='javascript:self.history.back();'>Volver atras</a>";
	} //fin si
	else 
	{
//Prepara una sentencia SQL para su ejecución. En este caso el alta de un registro de la BD.	
		$result = mysqli_query($mysqli, "INSERT INTO producto (nombre, precio, id_fabricante) VALUES ('$name', '$price', '$code')");	
	
		echo "Bloque3\n";
		echo "<div>Datos añadidos correctamente</div>";
		echo "<a href='index.php'>Ver resultado</a>";
	}//fin sino
	mysqli_close($mysqli);
	header("Location: index.php");
	//Cierra la conexión
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta producto</title>
<!--
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
-->	
</head>
    
<body>
<!--
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
-->	
<div>
	<header>
		<h1>Panel de control</h1>
	</header>
	<main>				
	<ul>
		<li><a href="index.php">Inicio</a></li>
		<li><a href="add.html">Alta</a></li>
	</ul>
	<h2>Alta producto</h2>
<!--Formulario de alta. 
Al hacer click en el botón Agregar, llama a la página: add.php-->
	<form action="add.php" method="post">
		<div>
			<label for="name">Nombrecito</label>
			<!--placeholder es como una pista del valor a introducir-->
			<input type="text" name="name" id="name" placeholder="nombre" required>
		</div>

		<div>
			<label for="price">Precio</label>
			<input type="number" name="price" step="0.01" id="price" placeholder="precio" required>
		</div>

		<div>
			<label for="code">Fabricante</label>
			<!--<input type="number" name="code" id="code" placeholder="fabricante" required>-->
			<?php 
			$result = mysqli_query($mysqli, "select id, nombre from fabricante ORDER BY id DESC");
			?>
			<select name="code" id="code" placeholder="fabricante" required>
        	<option value="">Fabricante</option>
             <?php //Cargar los niveles en el combo
        		while($row = mysqli_fetch_array($result)) {
               	   printf("<option value=%s>%s</option>",$row['id'],$row['nombre']);
          		}?>
       		</select>
		</div>
		<div>
			<input type="submit" name="inserta" value="Agregar">
			<input type="button" value="Cancelar" onclick="location.href='index.php'">
		</div>
	</form>
	</main>	
	<footer>
	Created by the IES Miguel Herrero team &copy; 2024
  	</footer>
</div>
</body>
</html>