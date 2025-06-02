<?php
    require("abrirConexion.php");
    require("Modelos/Usuario.php");

    session_start();

    if(!isset($_SESSION["Id"])){
        header("Location: login.php");
         return;
     }

     $IdCliente = $_SESSION["Id"];

     $res = Usuario::BorrarUsuario($conexion, $IdCliente);
     if ($res)
     {
        session_destroy();
        header("Location: login.php");
     }
     else
     {
        echo "Error al borrar el usuario: " . mysqli_error($conexion);
     }
        
?>