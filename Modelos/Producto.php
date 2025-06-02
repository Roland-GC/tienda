<?php

class Producto
{
    private string $nombreProducto;
    private int $categoria;
    private string $marca;
    private string $peso;
    private float $precio;
    private $imagen;
    public function __construct(
        string $nombreProducto,
        int $categoria,
        string $marca,
        string $peso,
        float $precio,
        $imagen) 
    {
        $this->nombreProducto = $nombreProducto;
        $this->categoria = $categoria;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->peso = $peso;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    public function AñadeProducto($conexion)
    {
        $sql = "SELECT Identificador FROM productos WHERE Nombre = '" . $this->nombreProducto . "'";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            return "Ese producto ya existe";
        } else {
            if ($_FILES["Imagen"]["size"] > 0) {
                $sql = "INSERT INTO productos (Nombre,Categoria,Marca,Peso,Precio,Imagen) VALUES (?,?,?,?,?,?)";
                if ($stmt = mysqli_prepare($conexion, $sql)) {
                    mysqli_stmt_bind_param(
                        $stmt,
                        "sissdb",
                        $this->nombreProducto,
                        $this->categoria,
                        $this->marca,
                        $this->peso,
                        $this->precio,
                        $this->imagen
                    );

                    $data = file_get_contents($_FILES["Imagen"]["tmp_name"]);
                    mysqli_stmt_send_long_data($stmt, 5, $data);
                    if (mysqli_stmt_execute($stmt)) {
                        return "";
                    } else {
                        return "Algo salió mal, por favor vuelve a intentarlo.";
                    }
                }
            } else {
                $sql = "INSERT INTO productos (Nombre,Categoria,Marca,Peso,Precio) VALUES (?,?,?,?,?)";
                if ($stmt = mysqli_prepare($conexion, $sql)) {
                    mysqli_stmt_bind_param(
                        $stmt,
                        "sissd",
                        $this->nombreProducto,
                        $this->categoria,
                        $this->marca,
                        $this->peso,
                        $this->precio
                    );
                    if (mysqli_stmt_execute($stmt)) {
                        return "";
                    } else {
                        return "Algo salió mal, por favor vuelve a intentarlo.";
                    }
                }
            }
        }
    }

    public function ActualizaProducto($conexion, $Id)
    {
        if ($this->imagen["size"] > 0) {
            $sql = "UPDATE productos SET Nombre=?, Categoria=?, Marca=?, Peso=?, Precio=?, Imagen=? WHERE Identificador=?";
    
            if ($stmt = mysqli_prepare($conexion, $sql)) {
                $data = file_get_contents($this->imagen["tmp_name"]);
                mysqli_stmt_bind_param(
                    $stmt,
                    "sissdbsi",
                    $this->nombreProducto,
                    $this->categoria,
                    $this->marca,
                    $this->peso,
                    $this->precio,
                    $data,
                    $Id
                );
    
                if (mysqli_stmt_execute($stmt)) {
                    return "";
                } else {
                    return "Algo salió mal, por favor vuelve a intentarlo.";
                }
            }
        } else {
            $sql = "UPDATE productos SET Nombre=?, Categoria=?, Marca=?, Peso=?, Precio=? WHERE Identificador=?";
    
            if ($stmt = mysqli_prepare($conexion, $sql)) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "sissdi",
                    $this->nombreProducto,
                    $this->categoria,
                    $this->marca,
                    $this->peso,
                    $this->precio,
                    $Id
                );
    
                if (mysqli_stmt_execute($stmt)) {
                    return "";
                } else {
                    return "Algo salió mal, por favor vuelve a intentarlo.";
                }
            }
        }
    }

    public static function ObtenerProductosCategoria($conexion, $categoria)
    {
        $sql = "SELECT Identificador, Nombre, Marca, Precio, Imagen FROM productos WHERE Categoria =" . $categoria;
        $result = $conexion->query($sql);
        $productos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($productos, $row);
            }
        }
        return $productos;
    }

    public static function BorrarProducto($conexion, $producto)
    {
        $sql = "DELETE FROM productos WHERE Identificador = " . $producto;
        if (mysqli_query($conexion, $sql)) {
            return ""; // Borrado
        } else {
            return "Error al borrar el artículo: " . mysqli_error($conexion);
        }
    }

    public static function MostrarProductos($conexion, $productoBuscado)
    {
        if ($productoBuscado == null || $productoBuscado == "")
            $sql = "SELECT Identificador, Nombre, Marca, Precio, Imagen FROM productos";
        else
            $sql = "SELECT Identificador, Nombre, Marca, Precio, Imagen FROM productos WHERE Nombre LIKE '%" . $productoBuscado . "%' OR Marca LIKE '%" . $productoBuscado . "%'";

        $result = $conexion->query($sql);
        $resultado = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($resultado, $row);
            }
        }
        return $resultado;
    }

    public static function ObtenerProducto($conexion, $id)
    {
        $sql = "SELECT Identificador, Nombre, Categoria, Marca, Peso, Precio, Imagen FROM productos WHERE Identificador = " . $id;
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }

}