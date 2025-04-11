<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    
</head>
<body>
    
    <div class="login-container">
        <div class="user-icon"><img src="Media/logo.png" alt="Logo" style="width: 55px; height: auto;"></div>
        <form action="PHP/loginFUNTION.php" method="POST">
            <div class="form-group">
                <input type="text" name="usuario" placeholder="Usuario">
            </div>
            <div class="form-group">
                <input type="password" name="contraseña" placeholder="Contraseña">
            </div>
            <input type="submit" class="login-button" name="ingresar" value="Ingresar">
        </form>
    </div>
</body>
</html>