<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="author" content="Roland Gal" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script scr="https://maxdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body class="body-container">
    <div class="body-index"></div>
    <div class="login-container">
        
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Login AKARI LUNA</h2>
        <p>Por favor, complete sus credenciales para iniciar sesión.</p>
            <div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="Email" class="form-control" value="<?php echo $Email; ?>">
                <span class="help-block"><?php echo $Email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($Contraseña_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="Contraseña" class="form-control">
                <span class="help-block"><?php echo $Contraseña_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
            </div>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>.</p>
        </form>
    </div>    
   

 <input type="button" onclick="window.location='index.php'"
    class= "btn btn-primary botones-sup-izq" value="Volver a la pagina principal"/> 

</body>
</html>