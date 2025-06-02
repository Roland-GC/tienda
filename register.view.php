<!DOCTYPE html>
<html>

<head>
	<title>Registrarse</title>
	<meta charset="utf-8">
	<meta name="author" content="Roland Gal" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script scr="https://maxdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style type="text/css">
		body {
			font: 14px sans-serif;
		}

		.wrapper {
			width: 350px;
			padding: 20px;
		}
	</style>
</head>

<body class="body-container">
<div class="body-index"></div>
	<div class="register-container">
		<h2>Registro</h2>
		<p class="textos">Por favor complete este formulario para crear una cuenta.</p>
		<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group <?php echo (!empty($Nombre_err)) ? 'has-error' : ''; ?>">
				<label>Usuario</label>
				<input type="text" name="Nombre" id="Nombre" class="form-control" value="<?php echo $Nombre; ?>">
				<span class="help-block">
					<?php echo $Nombre_err; ?>
				</span>
			</div>

			<div class="form-group <?php echo (!empty($Apellido1_err)) ? 'has-error' : ''; ?>">
				<label>Apellido1</label>
				<input type="text" name="Apellido1" id="Apellido1" class="form-control" value="<?php echo $Apellido1; ?>">
				<span class="help-block">
					<?php echo $Apellido1_err; ?>
				</span>
			</div>

			<div class="form-group <?php echo (!empty($Apellido2_err)) ? 'has-error' : ''; ?>">
				<label>Apellido2</label>
				<input type="text" name="Apellido2" id="Apellido2" class="form-control" value="<?php echo $Apellido2; ?>">
				<span class="help-block">
					<?php echo $Apellido2_err; ?>
				</span>
			</div>

			<div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
				<label>Email</label>
				<input type="text" name="Email" id="Email" class="form-control" value="<?php echo $Email; ?>">
				<span class="help-block">
					<?php echo $Email_err; ?>
				</span>
			</div>


			<div class="form-group <?php echo (!empty($Direccion_err)) ? 'has-error' : ''; ?>">
				<label>Direccion</label>
				<input type="text" name="Direccion" id="Direccion" class="form-control" value="<?php echo $Direccion; ?>">
				<span class="help-block">
					<?php echo $Direccion_err; ?>
				</span>
			</div>


			<div class="form-group <?php echo (!empty($Codigo_Postal_err)) ? 'has-error' : ''; ?>">
				<label>Codigo Postal</label>
				<input type="text" name="Codigo_Postal" id="Codigo_Postal" class="form-control" value="<?php echo $Codigo_Postal; ?>">
				<span class="help-block">
					<?php echo $Codigo_Postal_err; ?>
				</span>
			</div>


			<div class="form-group <?php echo (!empty($Contraseña_err)) ? 'has-error' : ''; ?>">
				<label>Contraseña</label>
				<input type="password" name="Contraseña" id="Contraseña" class="form-control">
				<span class="help-block">
					<?php echo $Contraseña_err; ?>
				</span>
			</div>
			<div class="form-group <?php echo (!empty($confirm_Contraseña_err)) ? 'has-error' : ''; ?>">
				<label>Confirmar Contraseña</label>
				<input type="password" name="confirm_Contraseña" id="confirm_Contraseña" class="form-control">
				<span class="help-block">
					<?php echo $confirm_Contraseña_err; ?>
				</span>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Ingresar">
				<input type="reset" class="btn btn-default" onclick="resetear()" value="Borrar">
			</div>
			<p>¿Ya tienes una cuenta? <a href="login.php">Ingresa aquí</a>.</p>
		</form>
	</div>

	<input type="button" onclick="window.location='index.php'" class="btn btn-primary botones-sup-izq" value="Volver a la pagina principal" />


	<script>
    		function resetear() {
    			/* Esta funcion resetea los valores introducidos por el usuario una vez se haya enviado el formulario.*/
    			document.getElementById("Nombre").value = "";
    			document.getElementById("Apellido1").value = "";
    			document.getElementById("Apellido2").value = "";
    			document.getElementById("Email").value = "";
    			document.getElementById("Direccion").value = "";
				document.getElementById("Codigo_Postal").value = "";
    			document.getElementById("Contraseña").value = "";
    			document.getElementById("confirm_Contraseña").value = "";
    		}

    </script>
</body>

</html>