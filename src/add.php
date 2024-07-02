<?php
echo "principio\n";
//Incluye fichero con parámetros de conexión a la base de datos

echo "Antes include once\n";

include_once("config.php");

echo "Despues include once\n";

echo "Bloque1\n";

echo $_POST['inserta']."\n";

	/*$name = mysqli_real_escape_string($mysqli, $_REQUEST['name']);
	$price = mysqli_real_escape_string($mysqli, $_REQUEST['price']);
	$code = mysqli_real_escape_string($mysqli, $_REQUEST['code']);
	$type = mysqli_real_escape_string($mysqli, $_REQUEST['type']);*/

	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$price = mysqli_real_escape_string($mysqli, $_POST['price']);
	$code = mysqli_real_escape_string($mysqli, $_POST['code']);
	$type = mysqli_real_escape_string($mysqli, $_POST['type']);

	echo $name."\n";
	echo $price."\n";
	echo $code."\n";
	echo $type."\n";

if(isset($_POST['inserta'])) 
//if(isset($_REQUEST['inserta'])) 
{
//Obtiene los datos (name, price y code) a partir del formulario de alta por el método POST (Se envía a través del body del HTTP Request. No aparece en la URL)
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$price = mysqli_real_escape_string($mysqli, $_POST['price']);
	$code = mysqli_real_escape_string($mysqli, $_POST['code']);
	$type = mysqli_real_escape_string($mysqli, $_POST['type']);

	/*$name = mysqli_real_escape_string($mysqli, $_REQUEST['name']);
	$price = mysqli_real_escape_string($mysqli, $_REQUEST['price']);
	$code = mysqli_real_escape_string($mysqli, $_REQUEST['code']);
	$type = mysqli_real_escape_string($mysqli, $_REQUEST['type']);*/

	echo $name."\n";
	echo $price."\n";
	echo $code."\n";
	echo $type."\n";

	echo "Bloque2\n";	
	if(empty($name) || empty($code) || empty($price) || empty($type)) 
	{
		if(empty($name)) {
			echo "<div>Campo nombre vacío.</div>";
		}

		if(empty($price)) {
			echo "<div>Campo precio vacío</div>";
		}

		if(empty($code)) {
			echo "<div>Campo Fabricante vacío.</div>";
		}

		if(empty($type)) {
			echo "<div>Campo tipo vacío.</div>";
		}
//Enlace a la página anterior
		echo "<a href='javascript:self.history.back();'>Volver atras</a>";
	} //fin si
	else 
	{
//Prepara una sentencia SQL para su ejecución. En este caso el alta de un registro de la BD.	
		$result = mysqli_query($mysqli, "INSERT INTO producto (nombre, precio, tipo, id_fabricante) VALUES ('$name', $price, '$type','$code')");	
	
		echo "Bloque3\n";
		echo "<div>Datos añadidos correctamente</div>";
		echo "<a href='index.php'>Ver resultado</a>";
	}//fin sino
	mysqli_close($mysqli);
	header("Location: index.php");
	//Cierra la conexión
}
?>

<!-- Recuerda que lo que viene a continuación tiene que ir en un sino-->

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
	<!--<form action="add.php" method="get">	-->
		<div>
			<label for="name">Nombre</label>
			<!--placeholder es como una pista del valor a introducir-->
			<input type="text" name="name" id="name" placeholder="nombre" required>
		</div>

		<div>
			<label for="price">Precio</label>
			<input type="number" name="price" step="0.01" id="price" placeholder="precio" required>
		<div>

		<div>
			<label for="code">Fabricante</label>
			<!--<input type="number" name="code" id="code" placeholder="fabricante" required>-->
			<?php 
			$result = mysqli_query($mysqli, "select id, nombre from fabricante ORDER BY nombre");
			?>
			<select name="code" id="code" placeholder="fabricante" required>
        	<!--<option value="">Fabricante</option>-->
			<option value=""></option>
             <?php //Cargar los niveles en el combo
        		while($row = mysqli_fetch_array($result)) {
               	   printf("<option value=%s>%s</option>",$row['id'],$row['nombre']);
          		}?>
       		</select>
		</div>
		<div>
			<?php 
			
			$tipos = [	"ALM"=>"Almacenamiento",
			"ENT"=>"Entrada",
			"EQU"=>"Equipo",
			"E/S"=>"Entrada/Salida",
			"PRO"=>"Procesamiento",
			"SAL"=>"Salida"
			];
			//Seleccionamos el tipo de hardware a través de un botón de opción
			/*foreach ($tipos as $key=>$value)
			{*/
				//echo("<input type='radio' name='boton' value='$value'>");
				//printf("<input type=\"radio\" name=\"type\" value=\"%s\" id=\"%s\">",$key, $key);
				//printf("<label for=\"%s\">%s</label>",$key,$value);
				//printf("<input type=\"radio\" name=\"type\" value=\"%s\">",$key);
				//printf("%s", $value);
			//}
			//Seleccionamos el tipo de hardware a través de una lista desplegable
			?>
			<label for="type">Tipo</label>
			<select name="type" id="type" placeholder="tipo" required>
        	<!--<option value="">Tipo</option>-->
			<option value=""></option>
             <?php //Cargar los niveles en el combo
	       		foreach ($tipos as $key=>$value) {
               	   printf("<option value=%s>%s</option>",$key,$value);
          		}?>
       		</select>


			

		
		</div>
		<div>
			<input type="submit" name="inserta" value="Agregar">
			<!--<input type="button" value="Cancelar" onclick="location.href='index.php'">-->
		</div>
	</form>
	</main>	
	<footer>
	<!--Created by the IES Miguel Herrero team &copy; 2024-->
  	</footer>
</div>
</body>
</html>