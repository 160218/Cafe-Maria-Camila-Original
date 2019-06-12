<?php
	session_start();//sesiones
	require 'conexion.php';
	$resultado=$conexion->prepare('SELECT * FROM clientes');
	$resultado->execute();

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
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>CRUD</title>
	<script type="text/javascript">
		function linkar(link){
			location.href=link;
		}
	</script>
	<!--Llamar css de las tablas-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css">
	<link href ="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
	<link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
</head>
<body>
	<?php
if (!empty($user)) {
	echo 'Bienvenido' .$user['user'];
	?>
	<h1>CRUD</h1>
	<input type="button" value="cerrar sesion" onclick="linkar('logout.php')"><p><br>
	<input type="button" name="" value="Ingresar" onclick="linkar('insertar.php')"><p>
	 <input type="button" name="" value="Index" onclick="linkar('index.php')">
	 <h2>Mostrar clientes</h2>
	<div id="page-wrapper">
	<div class="row">
	<div class="col-lg-12">
	<div class="panel panel-default">
	<div class="panel-body">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr>
			<th>Cedula</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>telefono</th>
			<th>direccion</th>
			<th>email</th>
			<th>imagen</th>
			<th>actualizar</th>
			<th>eliminar</th>
		</tr>
	</thead>
<?php
while ($view=$resultado->fetch(PDO::FETCH_ASSOC)) {
?>
<tr><!--da la linea 35 a la linea 40 se imprime el retorno de los datos del campo-->
<td><?php echo $view['cedula'];?></td>
<td><?php echo $view['nombre'];?></td>
<td><?php echo $view['apellido'];?></td>
<td><?php echo $view['telefono'];?></td>
<td><?php echo $view['direccion'];?></td>
<td><?php echo $view['email'];?></td>
<td><img src="<?php echo $view['imagen'];?>" height="100"></td>
<td><a href="actualizar.php?cedula=<?php echo $view['cedula'];?>">Actualizar</a></td>
<td><a href="eliminar.php?cedula=<?php echo $view['cedula'];?>">Eliminar</a></td>
</tr>
<?php } ?>
</table>
	</div>
	</div>
	</div>
	</div>

<!--jquery y boostrap js-->
<script src="vendor/bootstrap/js/bootstrap.js"></script>
<script src="vendor/jquery/jquery.js"></script>
<!--dataTables JavaScript traducir-->
<script src="vendor/datatables/js/jquery.dataTables.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script> 
<!--page level Demo script - tables - use for reference-->
<script>
	$(document).ready(function(){
		$('#dataTables-example').DataTable({
			responsive:true

			});
		
	});
</script>

</body>
</html>
<?php
	}else{
		header('location: index.php');
	}
	?>