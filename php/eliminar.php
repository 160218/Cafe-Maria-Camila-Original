<?php
	require 'conexion.php';
	$resultado=$conexion->prepare('DELETE FROM clientes WHERE cedula=:cedula');
	$resultado->bindParam(':cedula',$_GET['cedula']);
	$resultado->execute();
if($resultado){
	header('location:mostrar.php');
}
else{
	echo "error no se elimino";
}
?>