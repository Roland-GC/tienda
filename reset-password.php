<?php
// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "abrirConexion.php";
require "Modelos/Usuario.php";

// Define variables and initialize with empty values
$new_password = "";
$confirm_password = "";
$new_password_err = "";
$confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Por favor, introduzca la nueva contraseña.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "La contraseña al menos debe tener 6 caracteres.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Por favor confirme la contraseña.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    $param_id = $_SESSION["Id"];

    if (empty($new_password_err) && empty($confirm_password_err)) {
        $res = Usuario::ActualizarContraseña($conexion, $new_password, $param_id);

        if ($res) {
            // Password updated successfully. Destroy the session, and redirect to login page
            session_destroy();
            header("location: buscar.php");
            exit();
        } else {
            echo "Algo salió mal, por favor vuelva a intentarlo.";
        }
    }
}


// Close connection
mysqli_close($conexion);

require('reset-password.view.php');
?>