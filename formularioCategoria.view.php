<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Edita Categoria</title>
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
	<h4 class="error"><?= $mensaje ?></h4>

	<div class="contenedor-formulario">
		<form action="" method="post" enctype="multipart/form-data" class="formulario">

			<h1 class="titulo-formulario"><?= $Operacion ?></h1>
			<div class="producto_administracion">
				<label>Id Categoria</label>
				<?php if ($Operacion === "Editar Categoria"){ ?>	
				<input type="number" name="Id" class="id-categoria" id="Id" value="<?= $id ?>">
				<?php } else {?>	
				<input type="number" name="Id" class="id-categoria" id="Id">
				<?php }?>	
			</div>

			<div class="producto_administracion">
				<label>Descripción</label>
				<?php if ($Operacion === "Editar Categoria"){ ?>	
					<input type="text" name="Descripcion" class="descripcion-categoria" id="Descripcion" value="<?= $descripcion ?>" class="producto_input">
				<?php } else {?>	
					<input type="text" name="Descripcion" class="descripcion-categoria" id="Descripcion" class="producto_input">
				<?php }?>	
			</div>

			<div class="producto_administracion">
				<input type="submit" class="btn btn-primary" value="<?= $Operacion ?>">
				<input type="reset" class="btn btn-default" onclick="resetear()" value="Borrar">
				<a href="administrarCategorias.php" class="btn btn-info">Volver</a>
			</div>
		</form>
	</div>


	<script>
		function resetear() {
			/* Esta funcion resetea los valores introducidos por el usuario una vez se haya enviado el formulario.*/
			document.getElementById("Id").value = "";
			document.getElementById("Descripcion").value = "";
		}

	</script>
</body>

</html>