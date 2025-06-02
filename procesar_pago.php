<?php
session_start();
require 'vendor/autoload.php';
    require("abrirConexion.php");
    require("Modelos/Carrito.php");

\Stripe\Stripe::setApiKey('sk_test_51MyAMmBZ3HTg0855dp5igs5ZZWBAaeVQHH7QHq9ewQYfgcIAzaLqWlnnHrtXXvPcnZnyv2NJ2kszUkWCvvU7Sis500FFhJ8Y25'); // Tu clave secreta

// Validar sesión antes de usar
if (!isset($_SESSION["Id"])) {
    header("Location: login.php");
    exit;
}

$IdCliente = $_SESSION['Id'];
$total = $_SESSION['total'] ?? null;
if (Carrito::EstaVacio($conexion, $IdCliente)) {
    // Carrito vacío, redirige al inicio
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['stripeToken'] ?? null;
    $cardHolderName = $_POST['card-holder-name'] ?? 'No especificado';

    if (!$token || !$total) {
        die("Faltan datos necesarios para procesar el pago.");
    }

    $amountInCents = intval($total * 100); // Convertir a centavos

try {
    $charge = \Stripe\Charge::create([
        'amount' => $amountInCents,
        'currency' => 'eur',
        'description' => "Pago simulado para $cardHolderName",
        'source' => $token,
    ]);

    // Vaciar carrito usando la función
    $errorVaciar = Carrito::VaciarCarrito($conexion, $IdCliente);
    if ($errorVaciar !== "") {
        // Opcional: manejar error, pero igual continuar
        error_log("Error vaciando carrito: " . $errorVaciar);
    }

    // Limpiar sesión
    unset($_SESSION['total']);
    unset($_SESSION['carrito']);
        // Mostrar mensaje éxito
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Pago exitoso</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
            <link rel="stylesheet" href="style.css" />
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        </head>
        <div class="body-index"></div>
        <body class="body-container">
            <div class="reset-password-container">
            <div class="container mt-5 text-center">
                <h2 class="text-success">✅ ¡Pago exitoso para <?= htmlspecialchars($cardHolderName) ?>!</h2>
                <p>Total pagado: €<?= number_format($amountInCents / 100, 2) ?></p>
                <p>ID de transacción: <strong><?= htmlspecialchars($charge->id) ?></strong></p>
                <a href="index.php" class="btn btn-primary mt-3">Volver a la página principal</a>
            </div>
            </div>
        </body>
        </html>
        <?php

    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Mostrar error de pago
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Error en el pago</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
            <link rel="stylesheet" href="style.css" />
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
            <script src="https://js.stripe.com/v3/"></script>
        </head>
           <div class="body-index"></div>
        <body class="body-container">
            <div class="reset-password-container">
            <div class="container mt-5 text-center">
                <h2 class="text-danger">❌ Error en el pago</h2>
                <p><?= htmlspecialchars($e->getMessage()) ?></p>
                <a href="index.php" class="btn btn-secondary mt-3">Volver a la página principal</a>
            </div>
            </div>
        </body>
        </html>
        <?php
    }
} else {
    // Método no permitido
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Método no permitido</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://js.stripe.com/v3/"></script>
    </head>
       <div class="body-index"></div>
    <body class="body-container">
         <div class="reset-password-container">
        <div class="container mt-5 text-center">
            <h2 class="text-warning">⚠ Método no permitido</h2>
            <a href="index.php" class="btn btn-secondary mt-3">Volver a la página principal</a>
        </div>
        </div>
    </body>
    </html>
    <?php
}
?>
