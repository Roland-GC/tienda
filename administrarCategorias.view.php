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

    echo '<a href="./añadirCategoria.php" class="btn btn-success ">Añadir Categoria</a> </br>';
    ?>
    <div class="carrito-contenedor-productos">
   
        <?php
        foreach ($categorias as &$categoria) {
            ?>
            <div class='card carrito-producto'>
                <div class="carrito-derecha">
                    <div class="carrito-des-producto">
                        <h4>
                            <?php
                            echo "&nbsp";
                            echo "&nbsp";
                            echo $categoria['Id_Categoria'];
                            echo "&nbsp";
                            echo "&nbsp";
                            echo $categoria['Descripción'];
                           
                            ?>
                            <a href="javascript: preguntaBorrar(<?= $categoria['Id_Categoria'] ?>)"
                                class="btn btn-danger eliminar-categoria">Eliminar</a>

                            <a href="javascript: preguntaEditar(<?= $categoria['Id_Categoria'] ?>)"
                                class="btn btn-info editar-categoria">Editar</a>
                        </h4>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
     </div>
    <hr />
    <hr />
    <div class="text-center">
        <a class="btn btn-info" href="buscar.php">Volver</a>
    </div>
</body>
<script>
    function preguntaBorrar(Id) {
        if (confirm("Estas seguro de borrar esta categoria !!")) {
            window.location.assign("borrarCategoria.php?Id=" + Id);
        }
    }

    function preguntaEditar(Id) {
            window.location.assign("editarCategoria.php?Id=" + Id);
    }

</script>

</html>