<?php
    require 'conexion.php';
    if (!empty($_POST['cedula'])) {
    	$record=$conn->prepare('UPDATE cliente SET nombre=:nombre, apellido=:apellido, edad=:edad, direccion=:direccion, telefono=:telefono, imagen=:imagen WHERE cedula=:cedula');
    	$record->bindParam(':cedula',$_POST['cedula']);
    	$record->bindParam(':nombre',$_POST['nombre']);
    	$record->bindParam(':apellido',$_POST['apellido']);
    	$record->bindParam(':edad',$_POST['edad']);
    	$record->bindParam(':direccion',$_POST['direccion']);
    	$record->bindParam(':telefono',$_POST['telefono']);
           /*--------------subir imagen----------------------*/
        $record->bindParam(':imagen',$ruta);
        $nombreimg=$_FILES['imagen']['name'];
        $archivo=$_FILES['imagen']['tmp_name'];
        $ruta='img/'.$nombreimg;
        move_uploaded_file($archivo, $ruta);
        /*---------------------------------------------------*/

    	if($record->execute()){
          echo "Cliente actualizado";
    	}else{
    		echo "error";
    	}
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <script type="text/javascript">
        function linkar(link) {
            location.href=link;
        }
    </script>
</head>
<body>	
    <h1>ACTUALIZAR INFORMACION</h1>
    <?php
       if(isset($_GET['cedula'])){
        $record=$conn->prepare('SELECT * FROM cliente WHERE cedula = :cedula');
        $record->bindParam(':cedula',$_GET['cedula']);
        $record->execute();

        if ($record->rowCount()>=1) {
            $views=$record->fetch(PDO::FETCH_ASSOC);
        }
    }
    ?>
<form action="" method="POST" enctype="multipart/form-data>
Cedula:<br>
<input type="hidden" name="cedula" value="<?php echo $views['cedula']; ?>" required="">
<input type="number" name="cedula" value="<?php echo $views['cedula']; ?>" required="" disabled="">
<br>
Nombre:<br>
<input type="text" name="nombre" value="<?php echo $views['nombre']; ?>" required="">
<br>
Apellido:<br>
<input type="text" name="apellido" value="<?php echo $views['apellido']; ?>" required="">
<br>
Edad:<br>
<input type="number" name="edad" value="<?php echo $views['edad']; ?>" required="">
<br>
Direccion:<br>
<input type="text" name="direccion" value="<?php echo $views['direccion']; ?>" required="">
<br>
Telefono:<br>
<input type="number" name="telefono" value="<?php echo $views['telefono']; ?>" required="">
<br>
Imagen:<br>
<img src="<?php echo $views['imagen']; ?>" height="80"">
<input type="file" name="imagen" value="<?php echo $views['imagen']; ?>" required="">
<br>
<br><br>
<input type="submit" name="" value="Actualizar">
<input type="button" onclick="linkar('mostrar.php')" value="Regresar">
<br>
</form>
</body>
</html>