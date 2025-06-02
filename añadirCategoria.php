<?php
session_start();

if (!isset($_SESSION["Administrador"]) || $_SESSION["Administrador"] !== 1) {
    header("location: index.php");
    exit;
}

require("abrirConexion.php");
require("cabecera.php");

$mensaje = "";
$Id = "";
$Operacion = "Añadir categoria";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id = $_POST["Id"];
    $Descripcion = $_POST["Descripcion"];

    $categoria = Categoria::AñadeCategoria($Id, $Descripcion, $conexion);

    header('location: administrarCategorias.php');
   
} 




mysqli_close($conexion);

require('formularioCategoria.view.php');
?>