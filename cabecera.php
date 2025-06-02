<?php
    
    require_once("Modelos/Categoria.php");

    $categorias = Categoria::ObtenerCategorias($conexion);
    
    
    if(!isset($_SESSION["Id"])){
        $carrito_Cantidad = 0;
        return;
    }
    

    $IdCliente = $_SESSION["Id"];

    $sql1 = "SELECT SUM(Cantidad_Productos) AS Cantidad_Total FROM carrito WHERE Id_Cliente =" . $IdCliente;

    $result = $conexion->query($sql1);

    $obj = $result->fetch_object();

     $carrito_Cantidad = $obj -> Cantidad_Total;
   

    $result->close();

    unset($obj);

    unset($sql1);



?>