<?php
session_start();

if (!isset($_SESSION["Administrador"]) || $_SESSION["Administrador"] !== 1) {
    header("location: index.php");
    exit;
}

require("abrirConexion.php");
/*require("Modelos/Categoria.php");*/
require("cabecera.php");

$mensaje = "";
$Operacion = "Editar Categoria";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id = $_POST["Id"];
    $id = $_GET["Id"];

    $Descripcion = $_POST["Descripcion"];

    $categoria = Categoria::ActualizaCategoria($Id, $Descripcion, $conexion, $id);

    header('location: administrarCategorias.php');
   
} else {
    $id = $_GET["Id"];

    $row = Categoria::ObtenerCategorias($conexion, $id);

    $id = $row[0]["Id_Categoria"];
    $descripcion = $row[0]["Descripción"];

}


mysqli_close($conexion);

require('formularioCategoria.view.php');
?>