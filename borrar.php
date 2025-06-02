<?php

session_start();

if (!isset($_SESSION["Administrador"]) || $_SESSION["Administrador"] !== 1) {
    header("location: index.php");
    exit;
}


require("abrirConexion.php");
require("Modelos/Producto.php");

$Id = $_GET['Id'];

    $res = Producto::BorrarProducto($conexion, $Id);
    
    
    
    
    
    
    if (!$res="")
    {
        header("Location: buscar.php");
    }
    else
    {
        echo $res;
    }
    

// Cerrar la conexión
mysqli_close($conexion);


?>