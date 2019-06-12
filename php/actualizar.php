<?php
session_start();//sesiones
require 'conexion.php';
if (!empty($_POST['cedula'])) {
	$actualizar=$conexion->prepare('UPDATE clientes SET nombres=:nombres,apellidos=:apellidos,telefono=:telefono,direccion=:direccion,email=:email,imagen=:imagen WHERE cedula=:cedula');
	$actualizar->bindParam(':cedula', $_POST['cedula']);
	$actualizar->bindParam(':nombres', $_POST['nombres']);
	$actualizar->bindParam(':apellidos', $_POST['apellidos']);
	$actualizar->bindParam(':telefono', $_POST['telefono']);
	$actualizar->bindParam(':direccion', $_POST['direccion']);
	$actualizar->bindParam(':email', $_POST['email']);
	/*------------------------subir imagen-------------------------*/
	$actualizar->bindParam(':imagen',$ruta);
	$nombreimg=$_FILES['imagen']['name'];
	$archivo=$_FILES['imagen']['tmp_name'];
	$ruta='img/'.$nombreimg;
	move_uploaded_file($archivo, $ruta);
	/*-------------------------------------------------------------*/
	if ($actualizar->execute()) {
		echo "Cliente actualizado";
	}
	else{
		echo "No se actualizo";
	}
}

	if (isset($_SESSION['user_id'])) {//sessiones
		$search=$conexion->prepare('SELECT * FROM user WHERE id=:id');
		$search->bindParam(':id',$_SESSION['user_id']);
		$search->execute();
		$results=$search->fetch(PDO::FETCH_ASSOC);
		$user = null;

		if (count($results)>0) {
			$user=$results;
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
	<h1>Actualizacion de cliente</h1>
	<?php
		if (isset($_GET['cedula'])) {
			$actualizar=$conexion->prepare('SELECT * FROM clientes WHERE cedula=:cedula');
			$actualizar->bindParam(':cedula',$_GET['cedula']);
			$actualizar->execute();

		if ($actualizar->rowCount()>=1) {
			$views=$actualizar->fetch(PDO::FETCH_ASSOC);
			}
		}
	?>
	 <form method="POST" action="" enctype="multipart/form-data">
	 		<label>Cedula <br><input type="hidden" name="cedula" value="<?php echo $views['cedula'];?>" required=""></label><p>
           <label> <br><input type="number" name="cedula" value="<?php echo $views['cedula'];?>" required="" disabled=""></label><p>
           <label>Nombre <br><input type="text" name="nombres" value="<?php echo $views['nombres'];?>" required=""></label><p>
           <label>Apellido <br> <input type="text" name="apellidos" value="<?php echo $views['apellidos'];?>" required=""></label><p>
           <label>Telefono <br> <input type="number" name="telefono" value="<?php echo $views['telefono'];?>" required=""></label><p>
           <label>Direccion <br> <input type="text" name="direccion" value="<?php echo $views['direccion'];?>" required=""></label><p>
           <label> Email <br><input type="email" name="email" value="<?php echo $views['email'];?>" required=""></label><br>
            <label> imagen <br><img src="<?php echo $views['imagen'];?>" height="50">
            <input type="file" name="imagen" value="<?php echo $views['imagen'];?>" reqquired=""></label><p>
			<input type="submit" value="actualizar">
			<input type="button" onclick="linkar('mostrar.php')" value=regresar>	
</body>
</html>
<?php
	}else{
		header('location: index.php');
	}
	?>