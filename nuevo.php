<?php
session_start();

if (!isset($_SESSION["Administrador"]) || $_SESSION["Administrador"] !== 1) {
    header("location: index.php");
    exit;
}

require("abrirConexion.php");
require("Modelos/Producto.php");

$mensaje = "";
$Id = "";
$Operacion = "Nuevo producto";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $NombreP = $_POST["Nombre"];
    $CategoriaP = intval($_POST["Categoria"]);
    $MarcaP = $_POST["Marca"];
    $PesoP = $_POST["Peso"];
    $PrecioP = floatval($_POST["Precio"]);
    $ImagenP = $_FILES["Imagen"];

    $producto = new Producto($NombreP,$CategoriaP,$MarcaP,$PesoP,$PrecioP,$ImagenP);
    $res = $producto->AñadeProducto($conexion);
    if ($res == "")
    {
        $mensaje = "Se ha insertado correctamente.";
        header("location: buscar.php");
    }
    else 
    {
        $mensaje = $res;
    }
    
} else {
    $Nombre = "";
    $Marca = "";
    $Peso = "";
    $Precio = "";
}

require("cabecera.php");

mysqli_close($conexion);

require('formulario.view.php');
?>