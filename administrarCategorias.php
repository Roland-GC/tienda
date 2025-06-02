<?php
require("abrirConexion.php");
require("Modelos/Categoria.php");
require("cabecera.php");

session_start();

if (isset($_SESSION["Administrador"]) && $_SESSION["Administrador"] == 1) {
    $esAdmin = true;
}

$categorias = Categoria::ObtenerCategorias($conexion);



// Close connection
mysqli_close($conexion);

require('administrarCategorias.view.php');

?>