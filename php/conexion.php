<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyecto";
try {
    $conexion = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " .$e->getMessage();
    }
?>