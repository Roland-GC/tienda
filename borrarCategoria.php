<?php
    require("abrirConexion.php");
    require("Modelos/Categoria.php");

    session_start();

    if(!isset($_SESSION["Id"])){
       header("Location: login.php");
        return;
    }

    $Id = intval($_GET["Id"]);
    $IdCliente = $_SESSION["Id"];
                   
    $res = Categoria::BorrarCategoria($conexion, $Id);

   // echo "Este es el contenido de ".$res." L";
   // var_dump($res);
    
    if ($res==="")
    {
        // Si la consulta ha tenido éxito, redirigir al usuario a la página de inicio
        header("Location: administrarCategorias.php");
    }
    else
    {
        // Si ha habido un error, mostrarlo
        echo $res;
    }
?>