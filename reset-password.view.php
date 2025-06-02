<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cambia tu contraseña acá</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <meta name="author" content="Roland Gal" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script scr="https://maxdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body class="body-container">
<div class="body-index"></div>
    <div class="reset-password-container">
        <h2>Cambia tu contraseña </h2> 
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Nueva contraseña</label>
                <input type="password" name="new_password" class="form-control">
                <span class="help-block"><?php echo $new_password_err ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar contraseña</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?=$confirm_password_err ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enviar">
                <a class="btn btn-info" style="padding: 3px 8px;" href="buscar.php">Cancelar</a>
            </div>
        </form> 
    </div>
</body>
</html>