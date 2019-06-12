<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header('Location:mostrar.php');
    }
    require 'conexion.php';
    if (!empty($_POST['usser']) && !empty($_POST['pass'])) {
        $search=$conn->prepare('SELECT id, usser,pass FROM users WHERE usser=:usser');
        $search->bindParam(':usser',$_POST['usser']);
        $search->execute();
        $result=$search->fetch(PDO::FETCH_ASSOC);
        $message='Error en la consulta';

        //if(count($result)>0){

        if(count($result) > 0 && password_verify($_POST['pass'], $result['pass'])){
        $_SESSION['user_id'] = $result['id'];
        header('Location: mostrar.php');
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
        function linkar(link) {
            location.href=link;
        }
    </script>
</head>
<body>	
    <h1>SISTEMA DE USUSARIOS</h1>
    <?php
    if (!empty($message)):?> 
    <h2><?=$message?></h2>
<?php endif; ?>
<form action="index.php" method="POST" enctype="multipart/form-data">
Usuario:<br>
<input type="text" name="usser" value="" required="">
<br>
Contraseña:<br>
<input type="password" name="pass" value="" required="">
<br><br>
<input type="submit" name="" value="Ingresar">
<input type="button" onclick="linkar('mostrar.php')" value="Mostrar">
<br>
</form>
</body>
</html>