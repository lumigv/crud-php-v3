<?php
//Incluye fichero con parámetros de conexión a la base de datos
include_once("config.php");

/*Comprueba si hemos llegado a esta página PHP a través del formulario de modificaciones. 
En este caso comprueba la información "modifica" procedente del botón Guardae del formulario de Modificaciones
Transacción de datos utilizando el método: POST
*/
if(isset($_POST['modifica'])) {
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$price = mysqli_real_escape_string($mysqli, $_POST['price']);
	$type = mysqli_real_escape_string($mysqli, $_POST['type']);
	$code = mysqli_real_escape_string($mysqli, $_POST['code']);

	echo "Bloque1\n";

	if(empty($name) || empty($price) || empty($type) || empty($code))	{
		if(empty($name)) {
			echo "<font color='red'>Campo nombre vacío.</font><br/>";
		}

		if(empty($price)) {
			echo "<font color='red'>Campo precio vacío.</font><br/>";
		}

		if(empty($type)) {
			echo "<font color='red'>Campo tipo vacío.</font><br/>";
		}

		if(empty($code)) {
			echo "<font color='red'>Campo Fabricante vacío.</font><br/>";
		}
	} //fin si
	else 
	{
//Prepara una sentencia SQL para su ejecución. En este caso una modificación de un registro de la BD.	

echo "Bloque2\n";

$result = mysqli_query($mysqli, "UPDATE producto SET nombre = '$name', precio = '$price',  tipo = '$type', id_fabricante = '$code' WHERE `id` = $id");
mysqli_close($mysqli);

echo "Bloque3\n";
		header("Location: index.php");
	}// fin sino
}//fin si
?>


<?php
/*Obtiene el id del dato a modificar a partir de la URL. Transacción de datos utilizando el método: GET*/
echo "Estamos en el Get\n";
$id = $_GET['id'];

$id = mysqli_real_escape_string($mysqli, $id);

$result = mysqli_query($mysqli, "SELECT nombre, precio, tipo, id_fabricante FROM producto WHERE id = '$id'");
$row1 = mysqli_fetch_assoc($result);
$name = $row1['nombre'];
echo $name."\n";
$price = $row1['precio'];
echo $price."\n";
$type = $row1['tipo'];
echo $type."\n";
$code = $row1['id_fabricante'];
echo $code."\n";


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Modificación producto</title>
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
		<h1>Panel de Control</h1>
	</header>
	
	<main>				
	<ul>
		<li><a href="index.php" >Inicio</a></li>
		<li><a href="add.php" >Alta</a></li>
	</ul>
	<h2>Modificación producto</h2>
<!--Formulario de edición. 
Al hacer click en el botón Guardar, llama a esta misma página: edit.php-->
	<form action="edit.php" method="post">
		<div><p>
			<label for="name">Nombre</label>
			<input type="text" name="name" id="name" value="<?php echo $name;?>" required>
		</p></div>

		<div><p>
			<label for="price">Precio</label>
			<input type="number" name="price" id="price" step="0.01" value="<?php echo $price;?>" required>
		</p></div>

		<div><p>
			<label for="code">Fabricante</label>
			<!--<input type="number" name="code" id="code" value="<?php echo $code;?>" required>-->
			<?php
	 			$result = mysqli_query($mysqli, "select id, nombre from fabricante ORDER BY id DESC");		
			?>	
      		<select name="code" id="code" placeholder="fabricante" required>
       		 	<?php   //Cargar los niveles en el combo
        		while($row = mysqli_fetch_array($result)) {
					echo $code."\n";
					echo $row['id'].$row['nombre']."\n";
					if ($code==$row['id'])
                    	printf("<option selected value=%s>%s</option>",$row['id'],$row['nombre']);
                        else
                     	printf("<option value=%s>%s</option>",$row['id'],$row['nombre']);
          		}?>
       		</select>
		</p></div>

		<div><p>
			<?php 
			
			$tipos = [	"ALM"=>"Almacenamiento",
			"ENT"=>"Entrada",
			"EQU"=>"Equipo",
			"E/S"=>"Entrada/Salida",
			"PRO"=>"Procesamiento",
			"SAL"=>"Salida"
			];
			//Seleccionamos el tipo de hardware a través de un botón de opción
			foreach ($tipos as $key=>$value)
			{
				if ($type==$key)
					printf("<input type=\"radio\" name=\"type\" value=\"%s\" id=\"%s\" checked>",$key, $key);
				else
					printf("<input type=\"radio\" name=\"type\" value=\"%s\" id=\"%s\">",$key, $key);
				printf("<label for=\"%s\">%s</label>",$key,$value);
			}
			//Seleccionamos el tipo de hardware a través de una lista desplegable
			?>
			<!--Seleccionamos el hardware a través de una lista desplegable-->
			<!--<label for="type">Tipo</label>
			<select name="type" id="type" placeholder="tipo" required>
        	<option value="">Tipo</option>-->
             <?php //Cargar los niveles en el combo
        		/*foreach ($tipos as $key=>$value) {
					if ($type==$key)
                    	printf("<option selected value=%s>%s</option>",$key,$value);
                        else
                     	printf("<option value=%s>%s</option>",$key,$value);
          		} */?>
       		<!--</select>-->
		<p></div>
		<div >
			<input type="hidden" name="id" value=<?php echo $id;?>>
			<input type="submit" name="modifica" value="Guardar">
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
