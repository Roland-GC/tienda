<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<meta name="author" content="Roland Gal" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script scr="https://maxdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="body-index"></div>
	<?php
	require('cabecera.view.php');
	?>
	<h4><?= $mensaje ?></h4>

	<div class="contenedor-formulario">
		<form action="" method="post" enctype="multipart/form-data" class="formulario">

			<h1 class="titulo-formulario"><?= $Operacion ?></h1>
			<input type="hidden" name="Id" value="<?= $Id ?>">
			<div class="producto_administracion">
				<label>Nombre Usuario</label>
				<input type="text" name="Nombre" id="Nombre" value="<?= $Nombre ?>" class="producto_input">
			</div>

			<div class="producto_administracion">
            <label>Primer Apellido Usuario</label>
				<input type="text" name="Apellido1" id="Apellido1" value="<?= $Apellido1 ?>" class="producto_input">
			</div>

			<div class="producto_administracion">
            <label>Segundo Apellido Usuario</label>
				<input type="text" name="Apellido2" id="Apellido2" value="<?= $Apellido2 ?>" class="producto_input">
			</div>

			<div class="producto_administracion">
            <label>Email Usuario</label>
				<input type="text" name="Email" id="Email" value="<?= $Email ?>" class="producto_input">
			</div>


			<div class="producto_administracion">
            <label>Dirección Usuario</label>
				<input type="text" name="Direccion" id="Direccion" value="<?= $Direccion ?>" class="producto_input">
			</div>


			<div class="producto_administracion">
            <label>Código Postal Usuario</label>
				<input type="text" name="Codigo_Postal" id="Codigo_postal" value="<?= $Codigo_Postal ?>" class="producto_input">
			</div>

			<div class="producto_administracion">
				<input type="submit" class="btn btn-primary" value="Añadir">
				<input type="reset" class="btn btn-default" onclick="resetear()" value="Borrar">
                <a class="btn btn-danger" href="javascript: preguntaBorrar(<?= $Id ?>)">Borrar Cuenta</a>
				<a href="buscar.php" class="btn btn-info">Volver</a>
			</div>
		</form>
	</div>


	<script>
		function resetear() {
			/* Esta funcion resetea los valores introducidos por el usuario una vez se haya enviado el formulario.*/
			document.getElementById("Nombre").value = "";
			document.getElementById("Apellido1").value = "";
			document.getElementById("Apellido2").value = "";
			document.getElementById("Email").value = "";
			document.getElementById("Direccion").value = "";
			document.getElementById("Codigo_Postal").value = "";
		}
     
    function preguntaBorrar(Id) {
        if (confirm("Estas seguro de borrar este usuario !!")) {
            window.location.assign("eliminarUsuario.php?Id=" + Id);
        }

    }
	</script>
</body>

</html>