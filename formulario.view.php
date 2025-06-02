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
	<h4 class="error">
		<?= $mensaje ?>
	</h4>

	<div class="contenedor-formulario">
		<form action="" method="post" enctype="multipart/form-data" class="formulario">

			<h1 class="titulo-formulario">
				<?= $Operacion ?>
			</h1>
			<input type="hidden" name="Identificador" value="<?= $Id ?>">
			<div class="producto_administracion">
				<label>Nombre Producto</label>
				<input type="text" name="Nombre" id="Nombre" value="<?= $Nombre ?>" class="producto_input">
			</div>

			<div class="producto_administracion">
				<label>Categoria Producto</label>
				<select name="Categoria" class="producto_input">
					<?php
					foreach ($categorias as &$categoria) {
						?>
						<option value='<?= $categoria["Id_Categoria"] ?>'><?= $categoria["Descripción"] ?></option>

						<?php
					}
					?>
				</select>
			</div>

			<div class="producto_administracion">
				<label>Marca Producto</label>
				<input type="text" name="Marca" id="Marca" value="<?= $Marca ?>" class="producto_input">
			</div>

			<div class="producto_administracion">
				<label for="Peso">Peso Producto</label>
				<input type="text" name="Peso" id="Peso" value="<?= $Peso ?>" class="producto_input">
			</div>


			<div class="producto_administracion">
				<label>Precio Producto</label>
				<input type="number" name="Precio" id="Precio" value="<?= $Precio ?>" class="producto_input">
			</div>


			<div class="producto_administracion">
				<label>Imagen Producto</label>
				<input type="file" name="Imagen" id="Imagen" class="imagen_producto" accept=".png,.jpg">
			</div>

			<div class="producto_administracion">
				<input type="submit" class="btn btn-primary" value="Guardar">
				<input type="reset" class="btn btn-default" onclick="resetear()" value="Borrar">
				<a href="buscar.php" class="btn btn-info">Volver</a>
			</div>
		</form>
	</div>


	<script>
		function resetear() {
			/* Esta funcion resetea los valores introducidos por el usuario una vez se haya enviado el formulario.*/
			document.getElementById("Nombre").value = "";
			document.getElementById("Categoria").value = "";
			document.getElementById("Marca").value = "";
			document.getElementById("Peso").value = "";
			document.getElementById("Precio").value = "";
			document.getElementById("Imagen").value = "";
		}

	</script>
</body>

</html>