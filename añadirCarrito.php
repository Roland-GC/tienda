<?php

session_start();
if(!isset($_SESSION["Id"])){
    header("Location: login.php?returnUrl=carrito.php?Id=".$_GET["Id"]);
    return;
}
require("abrirConexion.php");
require("Modelos/Carrito.php");

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    $Id = $_GET["Id"];
    $IdCliente = $_SESSION["Id"];

    $res = Carrito::AñadirProducto($conexion, $IdCliente, $Id);

    if ($res)
    {
        header("location: buscar.php");
    }
    
}

// Close statement
mysqli_stmt_close($stmt);

mysqli_close($conexion);

?>