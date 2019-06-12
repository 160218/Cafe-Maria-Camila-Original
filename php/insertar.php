<?php
require 'conexion.php';
if (!empty($_POST['cedula'])) {
	$temp=$conexion->prepare('INSERT INTO pedidos(cedula,nombre,apellido,tipocafe,cantidad) VALUES (:cedula,:nombre,:apellido,:tipocafe,:cantidad)');

	$temp->bindParam(':cedula', $_POST['cedula']);
	$temp->bindParam(':nombre', $_POST['nombre']);
	$temp->bindParam(':apellido', $_POST['apellido']);
	$temp->bindParam(':tipocafe', $_POST['tipocafe']);
	$temp->bindParam(':cantidad', $_POST['cantidad']);

	if ($temp->execute()) {
		echo "Creado";
	}
	else{
		echo "No Creado";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
</head>
<body>
<script type="text/javascript">
		function linkar(link){
			location.href=link;
		}
	</script>
	<h1>Pedidos</h1>
	 <form method="POST" action="insertar.php" enctype="multipart/form-data">
           <label> Cedula <br><input type="number" name="cedula" required=""></label><p>
           <label>Nombre <br><input type="text" name="nombre" required=""></label><p>
           <label>Apellido <br> <input type="text" name="apellido" required=""></label><p>
           <label>Tipocafe <br> <input type="number" name="tipocafe" required=""></label><p>
           <label>cantidad <br> <input type="text" name="cantidad" required=""></label><p>
</body>
</html>