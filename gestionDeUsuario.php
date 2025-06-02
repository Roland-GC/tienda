<?php
session_start();

if (!isset($_SESSION["Id"])) {
    header("Location: login.php");
    return;
}

require("abrirConexion.php");
require("Modelos/Usuario.php");

$IdCliente = $_SESSION["Id"];

$mensaje = "";
$Operacion = "Editar usuario";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NombreU = $_POST["Nombre"];
    $Apellido1U = $_POST["Apellido1"];
    $Apellido2U = $_POST["Apellido2"];
    $EmailU = $_POST["Email"];
    $DireccionU = $_POST["Direccion"];
    $Codigo_PostalU = $_POST["Codigo_Postal"];

    $usuario = new Usuario($NombreU, $Apellido1U, $Apellido2U, $EmailU, $DireccionU, $Codigo_PostalU);
    $res = $usuario->ActualizarUsuario($conexion, $IdCliente);

    if ($res == "") {
        header("location: gestionDeUsuario.php");
    } else {
        $mensaje = $res;
    }

} else {
    $obj = Usuario::ObtenerUsuario($conexion, $IdCliente);

    $Id = $obj->Id;
    $Nombre = $obj->Nombre;
    $Apellido1 = $obj->Apellido1;
    $Apellido2 = $obj->Apellido2;
    $Email = $obj->Email;
    $Direccion = $obj->Direccion;
    $Codigo_Postal = $obj->Codigo_Postal;
}


require("cabecera.php");

mysqli_close($conexion);

require('gestionDeUsuario.view.php');
?>