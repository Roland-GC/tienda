<?php

class Categoria
{
    private int $Id;
    private string $Descripcion;
    public function __construct(int $Id,string $Descripcion)
    {
        $this->Id = $Id;

        $this->Descripcion = $Descripcion;
        
    }


    public static function AñadeCategoria($id_categoria, $descripcion, $conexion)
    {

        $sql = "INSERT INTO categorias (Id_Categoria, Descripción) VALUES (?,?)";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param(
                $stmt,
                "is",
                $id_categoria,
                $descripcion
            );

            if (mysqli_stmt_execute($stmt)) {
                return "";
            } else {
                return "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }
    }


    public static function ActualizaCategoria($id, $descripcion, $conexion, $Id)
    {

        $mensaje = "";

        $sql = "UPDATE categorias SET Id_Categoria=?, Descripción=? WHERE Id_Categoria=?";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param(
                $stmt,
                "isi",
                $id,
                $descripcion,
                $Id
            );

            if (!mysqli_stmt_execute($stmt)) {
                $mensaje = "Algo salió mal, por favor vuelve a intentarlo.";
            } 
        }
        return  $mensaje;
    }

    public static function ObtenerCategorias($conexion, $id = false)
    {

        if ($id != false) {

            $sql = "SELECT Id_Categoria, Descripción FROM categorias WHERE Id_Categoria = " . $id;
            $result = $conexion->query($sql);

            $categorias = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($categorias, $row);
                }
            }
            return $categorias;

        } else {
            $sql = "SELECT Id_Categoria, Descripción FROM categorias ORDER BY Descripción";
            $result = $conexion->query($sql);
            $categorias = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($categorias, $row);
                }
            }
            return $categorias;
        }
    }


    public static function BorrarCategoria($conexion, $Id)
    {
        $sql = "DELETE FROM categorias WHERE Id_Categoria = " . $Id;

        $isCorrect = "";

        if (!mysqli_query($conexion, $sql)) {

            $isCorrect = "Error al borrar la categoria: " . mysqli_error($conexion);
        }

        return $isCorrect;
    }

}