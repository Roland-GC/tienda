<?php
require("abrirConexion.php");
require("Modelos/Producto.php");

    $categoria = $_GET["categoria"];

    $productos = Producto::ObtenerProductosCategoria($conexion, $categoria);
    
    mysqli_close($conexion);

require('buscar.view.php');

?>