<?php
class Carrito
{

    public static function BorrarProducto($conexion, $usuario, $producto)
    {

        $sql = "DELETE FROM carrito WHERE Id_Productos =" . $producto . " AND Id_Cliente = " . $usuario;

        if (mysqli_query($conexion, $sql)) {
            return ""; // Borrado
        } else {
            return "Error al borrar el artículo: " . mysqli_error($conexion);
        }
    }

    public static function ObtenerCarrito($conexion, $cliente)
    {
        $sql = "SELECT p.Identificador, p.Nombre, p.Categoria, p.Marca, p.Peso, p.Precio, p.Imagen, c.Cantidad_Productos FROM carrito c INNER JOIN productos p ON c.Id_Productos = p.Identificador WHERE c.Id_Cliente = " . $cliente;
        $result = $conexion->query($sql);
        $ListaCompra = array();
        $total = 0;
        while ($obj = $result->fetch_object()) {

            array_push($ListaCompra, $obj);
            $total = $total + ($obj->Precio * $obj->Cantidad_Productos);
        }
        $resultado = new stdClass();
        $resultado->total = $total;
        $resultado->lista = $ListaCompra;
        return $resultado;
    }

    public static function AñadirProducto($conexion, $usuario, $producto)
    {
        // Comprueba si el producto ya está en el carrito
        $sql = "SELECT Id_Entrada_Carrito FROM carrito WHERE Id_Cliente =" . $usuario . " AND Id_Productos =" . $producto;
        $result = $conexion->query($sql);

        if ($result->num_rows == 0) {
            // No está en el carrito
            $sql = "INSERT INTO carrito (Id_Entrada_Carrito, Id_Cliente, Id_Productos, Cantidad_Productos) VALUES (?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($conexion, $sql)) {
                mysqli_stmt_bind_param($stmt, "iisi", $param_Id_Carrito, $param_Id_Cliente, $param_Productos, $param_Cantidad_Productos);

                $param_Id_Carrito = "";
                $param_Id_Cliente = $usuario;
                $param_Productos = $producto;
                $param_Cantidad_Productos = 1;

                if (mysqli_stmt_execute($stmt)) {
                    return true;
                }
            }
        } else {
            $sql = "UPDATE carrito SET Cantidad_Productos = Cantidad_Productos + 1 WHERE Id_Cliente = ? AND Id_Productos = ?";
            if ($stmt = mysqli_prepare($conexion, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ii', $usuario, $producto);

                if (mysqli_stmt_execute($stmt)) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function ModificaCantidadProducto($conexion, $usuario, $producto, $cantidad)
    {
        $sql = "UPDATE carrito SET Cantidad_Productos = Cantidad_Productos + " . $cantidad . " WHERE Id_Productos =? AND Id_Cliente =?";

        if ($stmt = mysqli_prepare($conexion, $sql)) {

            mysqli_stmt_bind_param($stmt, "ii", $Id_Productos_param, $Id_cliente_param);

            $Id_Productos_param = $producto;
            $Id_cliente_param = $usuario;

            if (mysqli_stmt_execute($stmt)) {
                return "";
            } else {
                return "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }
    }
    public static function VaciarCarrito($conexion, $usuario)
{
    $sql = "DELETE FROM carrito WHERE Id_Cliente = ?";

    if ($stmt = mysqli_prepare($conexion, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $Id_cliente_param);

        $Id_cliente_param = $usuario;

        if (mysqli_stmt_execute($stmt)) {
            return "";  // Éxito
        } else {
            return "Algo salió mal al vaciar el carrito, por favor vuelve a intentarlo.";
        }
    } else {
        return "Error al preparar la consulta.";
    }
}

public static function EstaVacio($conexion, $usuario) {
    $sql = "SELECT COUNT(*) FROM carrito WHERE Id_Cliente = ?";
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $usuario);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $count == 0;
    }
    return true; // en caso de error, considerar vacío para seguridad
}


}