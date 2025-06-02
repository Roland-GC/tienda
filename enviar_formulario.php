<?php
session_start();
require("abrirConexion.php"); 

function limpiarEntrada($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // evita XSS
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y sanitizar entradas
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $apellidos = limpiarEntrada($_POST['apellidos'] ?? '');
    $telefono = limpiarEntrada($_POST['telefono'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $descripcion = limpiarEntrada($_POST['descripcion'] ?? '');

    // Validar datos mínimos
    if (empty($nombre) || empty($apellidos) || empty($email)) {
        die("Nombre, apellidos y email son obligatorios.");
    }

    // Validar formato email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Formato de email inválido.");
    }

    $sql = "INSERT INTO contacto_formulario (nombre, apellidos, telefono, email, descripcion) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sssss", $nombre, $apellidos, $telefono, $email, $descripcion);
        if ($stmt->execute()) {
            exit;
        } else {
            echo "Error al guardar los datos.";
        }
        $stmt->close();
    } else {
        echo "Error en la consulta.";
    }
} else {
    echo "Método no permitido.";
}
?>
