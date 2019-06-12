<?php
    require 'conexion.php';
    if (!empty($_POST['cedula'])) {
    	$temp=$conn->prepare('INSERT INTO clientes(cedula,nombres,apellidos,edad,direccion,telefono,imagen) VALUES(:cedula,:nombres,:apellidos,:edad,:direccion,:telefono,:imagen)');
    	$temp->bindParam(':cedula',$_POST['cedula']);
    	$temp->bindParam(':nombre',$_POST['nombre']);
    	$temp->bindParam(':apellido',$_POST['apellido']);
    	$temp->bindParam(':edad',$_POST['edad']);
    	$temp->bindParam(':direccion',$_POST['direccion']);
    	$temp->bindParam(':telefono',$_POST['telefono']);
        /*--------------subir imagen----------------------*/
        $temp->bindParam(':imagen',$ruta);
        $nombreimg=$_FILES['imagen']['name'];
        $archivo=$_FILES['imagen']['tmp_name'];
        $ruta='img/'.$nombreimg;
        move_uploaded_file($archivo, $ruta); 
        /*---------------------------------------------------*/

    	if($temp->execute()){
          echo "creado";
    	}else{
    		echo "No creado";
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
<form action="insertar.php" method="POST" enctype="multipart/form-data">
Cedula:<br>
<input type="number" name="cedula" value="" required="camp">
<br>
Nombre:<br>
<input type="text" name="nombre" value="" required="">
<br>
Apellido:<br>
<input type="text" name="apellido" value="" required="">
<br>
Edad:<br>
<input type="number" name="edad" value="" required="">
<br>
Direccion:<br>
<input type="text" name="direccion" value="" required="">
<br>
Telefono:<br>
<input type="number" name="telefono" value="" required="">
<br>
Imagen:<br>
<input type="file" name="imagen" value="" required="">
<br>
<br><br>
<input type="submit" name="" value="Guardar">
<input type="button" onclick="linkar('mostrar.php')" value="Regresar">
<br>
</form>
</body>
</html>