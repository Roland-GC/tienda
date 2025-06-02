<?php
require("abrirConexion.php");
require("Modelos/Carrito.php");

session_start();

if (!isset($_SESSION["Id"])) {
    header("Location: login.php");
    return;
}

$Id = intval($_GET["Id"]);
$IdCliente = $_SESSION["Id"];

$res = Carrito::ModificaCantidadProducto($conexion, $IdCliente, $Id, -1);

$mensaje = "";
if ($res != "")
    $mensaje = "Algo salió mal, por favor vuelve a intentarlo.";


header("location: carrito.php");

?>