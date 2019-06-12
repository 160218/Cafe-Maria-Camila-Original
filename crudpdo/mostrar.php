<?php
session_start();//sesiones
require 'conexion.php';
$result=$conn->prepare('SELECT * FROM cliente');
$result->execute(); //funcion para recibir

if (isset($_SESSION['user_id'])) {//sesiones
	 $search=$conn->prepare('SELECT id, usser,pass FROM users WHERE id=:id');
        $search->bindParam(':id',$_SESSION['user_id']);
        $search->execute();
        $results=$search->fetch(PDO::FETCH_ASSOC);
	    $user = null;

	    if(count($results) > 0){
	    	$user=$results;
	    }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<script type="text/javascript">
		function linkar(link) {
			location.href=link;
		}
	</script>

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="vendor/datatables-plugins/dataTables.bootstrap.css">
	<link rel="stylesheet" type="text/css" href="vendor/datatables-responsive/dataTables.responsive.css">
</head>
<body>
	<?php
	if (!empty($user)) {
		echo 'Bienvenido'.$user['usser'];
	?>
	<P><input type="button" onclick="linkar('logout.php')" value="CERRAR SESION">
	<h1>CRUD</h1>
	<!--para imprimir la tabla-->
<input type="button" onclick="linkar('insertar.php')" value="Ingresar">
<h2>MOSTRAR CLIENTES</h2>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
		    <div class="panel panel-default">
			    <div class="panel-body">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
						    <tr>
								<th>Cédula</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Edad</th>
								<th>Direccion</th>
								<th>Celular</th>
								<th>Imagen</th>
								<th>Telefono</th>
								<th>Actualizar</th>
								<th>Eliminar</th>
						    </tr>
						</thead>
					<?php
						while ($view=$result->fetch(PDO::FETCH_ASSOC)) {
						?>
						<tr>
							<td><?php echo $view['cedula']; ?></td>
							<td><?php echo $view['nombre']; ?></td>
							<td><?php echo $view['apellido']; ?></td>
							<td><?php echo $view['edad']; ?></td>
							<td><?php echo $view['direccion']; ?></td>
							<td><?php echo $view['imagen']; ?></td>
							<td><?php echo $view['telefono']; ?></td>
							<td><img src="<?php echo $view['imagen']; ?>"height="100"></td>
							<td><a href="actualizar.php?cedula=<?php echo $view['cedula']; ?>">Actualizar</a></td>
							<td><a href="eliminar.php?cedula=<?php echo $view['cedula']; ?>">Eliminar</a></td>
						</tr>
					<?php } ?>
					</table>
			    </div>
		    </div>
		</div>
	</div>
</div>
<script src="vendor/bootstrap/js/bootstrap.js"></script>
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/datatables/js/jquery.dataTables.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
<script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
			responsive: true
		});
	});
</script>
</body>
</html>
<?php
}else{
	header('Location: error.html');
}
?>