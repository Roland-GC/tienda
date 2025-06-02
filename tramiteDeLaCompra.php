<?php
session_start();

// Recibir total desde carrito (si se envía)
if (isset($_POST['total'])) {
    $_SESSION['total'] = $_POST['total'];
}

// Cargar vista con formulario de Stripe
require("tramiteDeLaCompra.view.php");
