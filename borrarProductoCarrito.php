<?php
    require("abrirConexion.php");
    require("Modelos/Carrito.php");

    session_start();

    if(!isset($_SESSION["Id"])){
       header("Location: login.php");
        return;
    }

    $Id = intval($_GET["Id"]);
    $IdCliente = $_SESSION["Id"];
                   
    $res = Carrito::BorrarProducto($conexion, $IdCliente, $Id);

   
    
    if (!$res="")
    {
        
        // Si la consulta ha tenido éxito, redirigir al usuario a la página de inicio
        
         header("Location: carrito.php");
        
    }
    else
    {
        // Si ha habido un error, mostrarlo
        echo $res;
    }
?>