<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: buscar.php");
  exit;
}
 
// Include config file
 require_once "abrirConexion.php";
 require "Modelos/Usuario.php";
 
// Define variables and initialize with empty values
$Email = $Contraseña = "";
$Email_err = $Contraseña_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if Email is empty
    if(empty(trim($_POST["Email"]))){
        $Email_err = "Por favor ingrese su usuario.";
    } else{
        $Email = trim($_POST["Email"]);
    }
    
    // Check if Contraseña is empty
    if(empty(trim($_POST["Contraseña"]))){
        $Contraseña_err = "Por favor ingrese su contraseña.";
    } else{
        $Contraseña = trim($_POST["Contraseña"]);
    }
    
    // Validate credentials
    if(empty($Email_err) && empty($Contraseña_err)){
        
        $usuario = Usuario::ObtenerUsuarioPorEmail($conexion, $Email);
        if ($usuario != null)
        {
            if(password_verify($Contraseña, $usuario->pwd)){
                $_SESSION["loggedin"] = true;
                $_SESSION["Id"] = $usuario->id;
                $_SESSION["Email"] = $Email;
                $_SESSION["Administrador"] = $usuario->admin;
                header("location: buscar.php");
            }
            else
            {
                $Contraseña_err = "La contraseña que has ingresado no es válida.";
            }
        }
        else
        {
            $Email_err = "No existe cuenta registrada con ese email de usuario.";
        }
    }
    
    // Close connection
    mysqli_close($conexion);
}
require('login.view.php');
?>




