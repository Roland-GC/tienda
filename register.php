<?php
// Include config file
require("abrirConexion.php");
require("Modelos/Usuario.php");

// Define variables and initialize with empty values
$Nombre = $Apellido1 = $Apellido2 = $Email = $Direccion = $Codigo_Postal = $Contraseña = $confirm_Contraseña = "";
$Nombre_err = $Apellido1_err = $Apellido2_err = $Email_err = $Direccion_err = $Codigo_Postal_err = $Contraseña_err = $confirm_Contraseña_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$Nombre = trim($_POST["Nombre"]);
	$Apellido1 = trim($_POST["Apellido1"]);
	$Apellido2 = trim($_POST["Apellido2"]);
	$Email = trim($_POST["Email"]);
	$Direccion = trim($_POST["Direccion"]);
	$Codigo_Postal = trim($_POST["Codigo_Postal"]);

	// Validate Nombre
	if (empty(trim($_POST["Email"]))) {
		$Email_err = "Por favor ingrese un email.";
	} else {
		$usuario = Usuario::ObtenerUsuarioPorEmail($conexion, $Email);
		if ($usuario != null) {
			$Email_err = "Este email ya está registrado";
		}
	}

	// Validate Contraseña
	if (empty(trim($_POST["Contraseña"]))) {
		$Contraseña_err = "Por favor ingresa una contraseña.";
	} elseif (strlen(trim($_POST["Contraseña"])) < 6) {
		$Contraseña_err = "La contraseña al menos debe tener 6 caracteres.";
	} else {
		$Contraseña = trim($_POST["Contraseña"]);
	}

	// Validate confirm Contraseña
	if (empty(trim($_POST["confirm_Contraseña"]))) {
		$confirm_Contraseña_err = "Confirma tu contraseña.";
	} else {
		$confirm_Contraseña = trim($_POST["confirm_Contraseña"]);
		if (empty($Contraseña_err) && ($Contraseña != $confirm_Contraseña)) {
			$confirm_Contraseña_err = "No coincide la contraseña.";
		}
	}

	if (empty($Email_err) && empty($Contraseña_err) && empty($confirm_Contraseña_err) && empty($Apellido1_err) && empty($Apellido2_err) && empty($Email_err)) {

		$usuario = new Usuario(
			trim($_POST["Nombre"]),
			trim($_POST["Apellido1"]),
			trim($_POST["Apellido2"]),
			trim($_POST["Email"]),
			trim($_POST["Direccion"]),
			trim($_POST["Codigo_Postal"])
		);

		$param_Contraseña = password_hash($Contraseña, PASSWORD_DEFAULT); // Creates a Contraseña hash

		$res = $usuario->AltaUsuario($conexion, $param_Contraseña);
		if ($res) {
			header("location: login.php");
		} else {
			echo "Algo salió mal, por favor inténtalo de nuevo.";
		}


	}
}
require('register.view.php');
?>