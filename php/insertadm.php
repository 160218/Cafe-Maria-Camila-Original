<?php
require 'conexion.php';
if (!empty($_POST['cedula'])) {
	$temp=$conexion->prepare('INSERT INTO user(nombres,apellidos,cedula,celular,direccion,user,pass) VALUES (:nombres,:apellidos,:cedula,:celular,:direccion,:user,:pass)');
	$temp->bindParam(':nombres', $_POST['nombres']);
	$temp->bindParam(':apellidos', $_POST['apellidos']);
	$temp->bindParam(':cedula', $_POST['cedula']);
	$temp->bindParam(':celular', $_POST['celular']);
	$temp->bindParam(':direccion', $_POST['direccion']);
	$temp->bindParam(':user', $_POST['user']);
	$password=password_hash($_POST['pass'], PASSWORD_BCRYPT);
	$temp->bindParam(':pass',$password);

	if ($temp->execute()) {
		echo "Creado";
	}else{
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
	<h1>Registro de cliente</h1>
	 <form method="POST" action="insertadm.php" enctype="multipart/form-data">
          
           <label>Nombre <br><input type="text" name="nombres" required=""></label><p>
           <label>Apellido <br> <input type="text" name="apellidos" required=""></label><p>
            <label> Cedula <br><input type="number" name="cedula" required=""></label><p>
           <label>Celular <br> <input type="number" name="celular" required=""></label><p>
           <label>Direccion <br> <input type="text" name="direccion" required=""></label><p>
           <label> User <br><input type="text" name="user" required=""></label><p>
           	<label> Contraseña <br><input type="password" name="pass" required=""></label><p>
			<input type="submit" value="guardar">
			<input type="button" onclick="linkar('index.php')" value=regresar>
</body>
</html>