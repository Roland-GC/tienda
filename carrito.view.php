<!DOCTYPE html>
<html>

<head>
    <meta name="author" content="Roland Gal">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script scr="https://maxdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    require('cabecera.view.php');
    $esAdmin = false;
    if (isset($_SESSION["Administrador"]) && $_SESSION["Administrador"] == 1) {
        $esAdmin = true;
    }
    ?>
    <div class="carrito-contenedor-productos">

        <?php
        foreach ($ListaCompra as &$producto) {
            ?>
            <div class='card carrito-producto'>
                <div class="carrito-img-producto">
                    <?php
                    echo '<img class="carrito-img" src="data:image/jpeg;base64,' . base64_encode($producto->Imagen) . '"/>';
                    ?>
                </div>
                <div class="carrito-derecha">
                    <div class="carrito-des-producto">
                        <h4>
                            <?php
                            echo $producto->Nombre;
                            ?>
                        </h4>
                    </div>
                    <div class="carrito-marca">
                        <h4>
                            <?php
                            echo $producto->Marca;
                            ?>
                        </h4>
                    </div>
                    <div class="carrito-peso">
                        <h4>
                            <?php
                            echo $producto->Peso;
                            ?>
                        </h4>
                    </div>
                    <div class="carrito-linea-precio">
                        <div class="carrito-precio">
                            <?php
                            echo $producto->Precio . "€";
                            ?>
                        </div>
                        <div class="bloque-cantidad">
                            <div>
                                <a class=" btn btn-danger boton-mm"
                                    href="incrementaProducto.php?Id=<?= $producto->Identificador ?>">+</a>
                            </div>
                            <div class="input-cantidad">
                                <?= $producto->Cantidad_Productos ?>
                            </div>
                            <div>
                                <a class=" btn btn-danger boton-mm"
                                    href="decrementaProducto.php?Id=<?= $producto->Identificador ?>">-</a>
                            </div>
                            <a href="javascript: preguntaBorrar(<?= $producto->Identificador ?>)"
                                class="btn btn-danger boton-borrar">&#128465;</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>


    </div>
    <hr/>
    

    <?php if (count($ListaCompra) == 0) { 
    
        echo "<center><h4> No hay productos en el carrito </h4></center>";

     } else { ?> 
        <h2 class="text-center" >Total: <?= $total ?> €</h2>
    <?php } ?>

    <hr/>
    <div class="text-center">
    <a class="btn btn-info" href="buscar.php">Volver</a>

    <?php if (!count($ListaCompra) == 0) { ?>
    
    <a class="btn btn-danger" href="tramiteDeLaCompra.view.php?$total">Pagar: <?= number_format($total, 2) ?> €</a>

    <?php }?>

    </div>
</body>
<script>
    function preguntaBorrar(Id) {
        if (confirm("Estas seguro de borrar este producto !!")) {
            window.location.assign("borrarProductoCarrito.php?Id=" + Id);
        }

    }
</script>

</html>