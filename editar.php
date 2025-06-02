<?php
session_start();

if (!isset($_SESSION["Administrador"]) || $_SESSION["Administrador"] !== 1) {
    header("location: index.php");
    exit;
}

require("abrirConexion.php");
require("Modelos/Producto.php");
require_once("Modelos/Categoria.php");

$mensaje = "";
$Operacion = "Editar producto";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id = $_POST["Identificador"];
    $NombreP = $_POST["Nombre"];
    $CategoriaP = intval($_POST["Categoria"]);
    $MarcaP = $_POST["Marca"];
    $PesoP = $_POST["Peso"];
    $PrecioP = floatval($_POST["Precio"]);
    $ImagenP = $_FILES["Imagen"];

    $producto = new Producto($NombreP, $CategoriaP, $MarcaP, $PesoP, $PrecioP, $ImagenP);
    $res = $producto->ActualizaProducto($conexion, $Id);
    if ($res == "") {
        header("location: buscar.php");
    } else {
        $mensaje = $res;
    }
} else {
    $Id = $_GET["Id"];

    $row = Producto::ObtenerProducto($conexion, $Id);

    $Nombre = $row["Nombre"];
    $Categoria = $row["Categoria"];
    $Marca = $row["Marca"];
    $Peso = $row["Peso"];
    $Precio = $row["Precio"];


}
require("cabecera.php");

mysqli_close($conexion);

require('formulario.view.php');
?>