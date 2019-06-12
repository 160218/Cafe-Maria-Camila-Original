<?php
    require 'conexion.php';
    if (!empty($_POST['cedula'])) {
    	$temp=$conn->prepare('INSERT INTO usser(nombres,apellidos,cedula,direccion,usser,pass) VALUES(:nombres,:apellidos,:cedula,:direccion,:usser,:pass)');
    	$temp->bindParam(':nombres',$_POST['nombres']);
    	$temp->bindParam(':apellidos',$_POST['apellidos']);
    	$temp->bindParam(':cedula',$_POST['cedula']);
    	$temp->bindParam(':direccion',$_POST['direccion']);
    	$temp->bindParam(':usser',$_POST['usser']);
        $password=password_hash($_POST['pass'], PASSWORD_BCRYPT);//incripta contraseña
        $temp->bindParam(':pass',$password);

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
<form action="insertadm.php" method="POST" enctype="multipart/form-data">
Nombre:<br>
<input type="text" name="nombres" value="" required="">
<br>
Apellido:<br>
<input type="text" name="apellidos" value="" required="">
<br>
Cedula:<br>
<input type="number" name="cedula" value="" required="">
<br>
Celular:<br>
<input type="text" name="celular" value="" required="">
<br>
Direccion:<br>
<input type="text" name="direccion" value="" required="">
<br>
Usuario:<br>
<input type="text" name="usser" value="" required="">
<br>
Contraseña:<br>
<input type="password" name="pass" value="" required="">
<br>
<br><br>
<input type="submit" name="" value="Guardar">
<input type="button" onclick="linkar('index.php')" value="Regresar">
<br>
</form>
</body>
</html>