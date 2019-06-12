<?php
session_start();/**/
session_unset();/**/
session_destroy();/*destruir sesion*/
header('location:index.php');
?>