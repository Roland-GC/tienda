<?php

class Usuario
{
    private string $nombre;
    private string $apellido1;
    private string $apellido2;
    private string $email;
    private string $direccion;
    private string $codigoPostal;

    public function __construct(
        $nombre,
        $apellido1,
        $apellido2,
        $email,
        $direccion,
        $codigoPostal
    ) {
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->codigoPostal = $codigoPostal;
    }

    public function ActualizarUsuario($conexion, $id)
    {
        $sql = "UPDATE usuarios SET Nombre=?,Apellido1=?,Apellido2=?,Email=?,Direccion=?,Codigo_Postal=? WHERE Id=?";

        if ($stmt = mysqli_prepare($conexion, $sql)) {

            mysqli_stmt_bind_param(
                $stmt,
                "sssssii",
                $this->nombre,
                $this->apellido1,
                $this->apellido2,
                $this->email,
                $this->direccion,
                $this->codigoPostal,
                $id
            );

            if (mysqli_stmt_execute($stmt)) {
                return "";
            } else {
                return "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }
    }

    public function AltaUsuario($conexion, $pwd)
    {
        $sql = "INSERT INTO usuarios (Id, Nombre, Apellido1, Apellido2, Email, Direccion, Codigo_Postal, Contraseña, Administrador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $resultado = false;
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "isssssssi",$param_Id, $param_Nombre, $param_Apellido1, $param_Apellido2, $param_Email, $param_direccion, $param_codigo_postal, $param_Contraseña, $param_admin);

            // Set parameters
            
            $param_Id = "";
            $param_Nombre = $this->nombre;
            $param_Apellido1 = $this->apellido1;
            $param_Apellido2 = $this->apellido2;
            $param_Email = $this->email;
            $param_direccion = $this->direccion;
            $param_codigo_postal = $this->codigoPostal;
            $param_Contraseña = $pwd;
            $param_admin = 0;
            
            

            if (mysqli_stmt_execute($stmt)) {
                $resultado = true;
            } else {
                $resultado = false;
            }
        }
        mysqli_stmt_close($stmt);
        return $resultado;
    }

    public static function BorrarUsuario($conexion, $id)
    {
        $sql = "DELETE FROM usuarios WHERE Id =" . $id;
        if (mysqli_query($conexion, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function ObtenerUsuario($conexion, $id)
    {
        $sql = "SELECT Id, Nombre, Apellido1, Apellido2, Email, Direccion, Codigo_Postal FROM usuarios WHERE Id = " . $id;

        $result = $conexion->query($sql);

        return $result->fetch_object();
    }

    public static function ObtenerUsuarioPorEmail($conexion, $email)
    {
        $sql = "SELECT Id, Email, Contraseña, Administrador FROM usuarios WHERE Email = ?";

        if ($stmt = mysqli_prepare($conexion, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Email);

            // Set parameters
            $param_Email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if Email exists, if yes then verify Contraseña
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $Email, $hashed_Contraseña, $Administrador);
                    if (mysqli_stmt_fetch($stmt)) {
                        $resultado = new stdClass();
                        $resultado->id = $id;
                        $resultado->pwd = $hashed_Contraseña;
                        $resultado->admin = $Administrador;

                        return $resultado;
                    }
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        mysqli_stmt_close($stmt);
    }

    public static function ActualizarContraseña($conexion, $new_password, $usuario)
    {
        $res = false;
        $sql = "UPDATE usuarios SET Contraseña = ? WHERE Id = ?";
        if ($stmt = mysqli_prepare($conexion, $sql)) {

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);


            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $usuario);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $res = true;
            }

            mysqli_stmt_close($stmt);
        }
        return $res;
    }
}