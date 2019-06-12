<?php
session_start();
if (isset($_SESSION['user_id'])){
	header('location:mostrar.php');
}
	require 'conexion.php';
	if(!empty($_POST['user']) && !empty($_POST['pass'])){
		$search=$conexion->prepare('SELECT id,user,pass FROM user WHERE user=:user');
		$search->bindParam(':user',$_POST['user']);
		$search->execute();
		$result=$search->fetch(PDO::FETCH_ASSOC);
		$message='Error en la consulta';

		//if (count($result)>0)
		if (count($result) > 0 && password_verify($_POST['pass'], $result['pass'])) {
			$_SESSION['user_id'] = $result['id'];
			header('location: mostrar.php');
		}else{
			$message='Sorry, usuario o contraseña incorrecta';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script type="text/javascript">
  function linkar (link){
  location.href=link;
}
</script>
</head>
<body>
<h1>Sistema de usuario</h1>
<?php if (!empty($message)): ?>
	<h2><?=$message?></h2>
<?php endif; ?>
   <form method="POST" action="index.php" enctype="multipart/form-data">
           <label> Usuario <br><input type="text" name="user" required=""></label><p>
           <label>Contraseña <br><input type="password" name="pass" required=""></label><p>
         
      <input type="submit" value="ingresar">
      <input type="button" onclick="linkar('mostrar .php')" value="mostrar">
</body>
</html>