<!DOCTYPE html>
<html>

<head>
    <meta name="author" content="Roland Gal">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
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
    <?php
    if ($esAdmin) {
        echo '<a href="./nuevo.php" class="btn btn-success">Añadir producto</a> &nbsp; &nbsp; &nbsp;';

        echo '<a href="./administrarCategorias.php" class="btn btn-dark"> Editar categorías</a>'; 
    }
    ?>
    <div class="contenedor-productos">

        <?php
        if(count($productos) > 0){
        foreach ($productos as &$producto) {
            ?>
            <div class='producto'>
                <div class="img-producto">
                    <?php
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($producto['Imagen']) . '"/>';
                    ?>
                </div>
                <div class="des-producto">
                    <h4>
                        <?php
                        echo $producto["Nombre"];
                        ?>
                    </h4>
                </div>
                <div class="precio">
                    <?php
                    echo $producto["Precio"] . "€";
                    ?>
                </div>
                <div>
                    <?php
                    if (!$esAdmin) {
                        ?>

                        <a href="./añadirCarrito.php?Id=<?= $producto["Identificador"] ?>" class="btn btn-danger">Agregar</a>

                        <?php
                    }
                    ?>
                </div>
                <div class="contenedor-boton-aniadir">
                    <?php
                    if ($esAdmin) {
                        ?>
                        <a href="./editar.php?Id=<?= $producto["Identificador"] ?>" class="btn btn-primary">Editar</a>
                        <a href="javascript:preguntaBorrar(<?= $producto["Identificador"] ?>)" class="btn btn-danger">Borrar</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No hay productos en esta categoría";
    }
        ?>

    </div>

    <div class="bg-1">

<h1 class="t-stroke t-shadow">INFORMACIÓN</h1>

</div>


    <div class="slide">
            <div class="slide-inner">
                <input class="slide-open" type="radio" id="slide-1" 
                      name="slide" aria-hidden="true" hidden="" checked="checked">
                <div class="slide-item">
                    <img src="img/presentacion_akari.jpg">
                </div>
                <input class="slide-open" type="radio" id="slide-2" 
                      name="slide" aria-hidden="true" hidden="">
                <div class="slide-item">
                    <img src="img/proximo_evento_akaridesign.jpg">
                </div>
                <input class="slide-open" type="radio" id="slide-3" 
                      name="slide" aria-hidden="true" hidden="">
                <div class="slide-item">
                    <img src="img/nuevo_producto_akari_design.jpg">
                </div>

                <label for="slide-3" class="slide-control prev control-1">‹</label>
                <label for="slide-2" class="slide-control next control-1">›</label>
                <label for="slide-1" class="slide-control prev control-2">‹</label>
                <label for="slide-3" class="slide-control next control-2">›</label>
                <label for="slide-2" class="slide-control prev control-3">‹</label>
                <label for="slide-1" class="slide-control next control-3">›</label>
                <ol class="slide-indicador">
                    <li>
                        <label for="slide-1" class="slide-circulo">•</label>
                    </li>
                    <li>
                        <label for="slide-2" class="slide-circulo">•</label>
                    </li>
                    <li>
                        <label for="slide-3" class="slide-circulo">•</label>
                    </li>
                </ol>
            </div>
        </div>

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

</body>
<script>
    function preguntaBorrar(Id) {
        if (confirm("Estas seguro de borrar este producto !!")) {
            window.location.assign("borrar.php?Id=" + Id);
        }

    }

</script>

</html>