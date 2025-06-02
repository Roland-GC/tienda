<?php
session_start();
require("abrirConexion.php"); 

function limpiarEntrada($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // evita XSS
    return $data;
}

$mensajeExito = "";
$mensajeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y sanitizar entradas
    $nombre = limpiarEntrada($_POST['nombre'] ?? '');
    $apellidos = limpiarEntrada($_POST['apellidos'] ?? '');
    $telefono = limpiarEntrada($_POST['telefono'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $mensaje = limpiarEntrada($_POST['mensaje'] ?? '');

    // Validar datos mínimos
    if (empty($nombre) || empty($apellidos) || empty($email)) {
        $mensajeError = "Nombre, apellidos y email son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensajeError = "Formato de email inválido.";
    } else {
        $sql = "INSERT INTO contacto_formulario (nombre, apellidos, telefono, email, descripcion) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("sssss", $nombre, $apellidos, $telefono, $email, $mensaje);
            if ($stmt->execute()) {
                $mensajeExito = "Su formulario se ha enviado correctamente.";
                // Limpiar variables para evitar volver a mostrar datos
                $nombre = $apellidos = $telefono = $email = $mensaje = "";
            } else {
                $mensajeError = "Error al guardar los datos.";
            }
            $stmt->close();
        } else {
            $mensajeError = "Error en la consulta.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Roland Gal">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
    p {
        margin: 0 auto;
        padding: 0 20px;
        max-width: 800px;
        font-size: 1.2rem;
        font-family: 'Nunito', sans-serif;
    }

    .formulario1 {
        margin: 0 auto;
        padding: 20px;
        max-width: 600px;
        background-color: #f2f2f2;
        border-radius: 8px;
    }

    .form-container {
        margin: 0 auto;
        padding: 30px;
        max-width: 500px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="tel"],
    .form-group input[type="email"],
    .form-group textarea {
        width: 100%;
        padding: 8px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .mensaje-exito,
    .mensaje-error {
        padding: 15px;
        margin: 20px auto;
        border-radius: 5px;
        max-width: 600px;
        font-weight: bold;
        text-align: center;
    }

    .mensaje-exito {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .mensaje-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Media queries para pantallas pequeñas */
    @media (max-width: 768px) {
        p {
            font-size: 1rem;
        }

        .formulario1,
        .mensaje-exito,
        .mensaje-error,
        .form-container {
            padding: 15px;
            width: 90%;
        }

        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="email"],
        .form-group textarea {
            font-size: 0.9rem;
        }
    }
</style>

</head>

<body>

    <div class="cabecera">
        <div class="Title">TEXTOS LEGALES</div>
    </div>

    <div class="logo">
        <img id="logo-image" src="img/logo_akaridesign.png">
    </div>

    <h1>FORMULARIO DE CONTACTO</h1>
    <hr>
    <p>Si tienes alguna duda no dudes en ponerte en contacto conmigo a través del formulario de abajo</p>
    <p><strong>ENCARGOS</strong></p>
    <p>Si quieres un encargo personalizado también puedes ponerte en contacto conmigo a través del formulário de contacto.</p>

    <?php if ($mensajeExito): ?>
        <div class="mensaje-exito"><?= $mensajeExito ?></div>
    <?php endif; ?>

    <?php if ($mensajeError): ?>
        <div class="mensaje-error"><?= $mensajeError ?></div>
    <?php endif; ?>

    <div class="formulario1">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($apellidos ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($telefono ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Descripción de la solicitud:</label>
                <textarea id="mensaje" name="mensaje" rows="5" required><?= htmlspecialchars($mensaje ?? '') ?></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Enviar">
        </form>
    </div>

    <div class="volver">
        <button class="Volver" onclick="window.location='buscar.php'" value="Volver">❀ VOLVER AL LA TIENDA</button>
    </div>

</body>

<footer>
    <nav>
        <ul>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="Aviso_legal.php">Aviso legal</a></li>
            <li><a href="Aviso_de_privacidad.php">Aviso de privacidad</a></li>
            <li><a href="Politica_de_cookies.php">Política de cookies</a></li>
        </ul>
    </nav>
</footer>

</html>
