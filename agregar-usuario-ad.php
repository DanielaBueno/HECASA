<?php
    session_start();

    if(!isset($_SESSION['usuario'])) {
        echo "<script>
                alert('Por favor debes iniciar sesión');
                window.location = 'login.php';
             </script>";

        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">

    <link rel="stylesheet" href="css/agregar-usuario.css">
</head>


<body>
<!-- Navegación -->
<nav>
    <div id="inicio">
        <img src="Media/logo.png" alt="Logo" style="width: 35px; height: auto;">
    </div>

        <a href="coleccion-general-ad.php">
            <button id="btn-coleccion-general">Coleccion General</button>
        </a>
        
        <a href="ingreso-ejemplar-ad.php">
            <button id="btn-ingreso-datos">Ingreso de Datos</button>
        </a>
        
        <a href="admi-usuarios-ad.php">
            <button id="btn-usuarios">Usuarios</button>
        </a>
        
        <a href="copia-seguridad-ad.php">
            <button id="btn-copia-seguridad">Copia de Seguridad</button>
        </a>
        
        <div id="fin">
            <a href="notificaciones-ad.php">
                <button id="btn-notificaciones">🔔</button>
            </a>
            
            <a href="PHP/boton_cerrarSesionFUNTION.php">
                <button id="btn-salir">Salir</button>
            </a>
        </div>
    </div>

    <!-- El script de activación del "active" -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const currentUrl = window.location.href;

            const buttons = document.querySelectorAll('nav a button');
        
            buttons.forEach(button => {
                const buttonUrl = button.parentElement.getAttribute('href');
                
                if (currentUrl.includes(buttonUrl)) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
        });
    </script>
</nav>

    <!-- Contenido -->
    <header>
        <h2>Agregar Usuario</h2>
        <a href="admi-usuarios-ad.php">
            <button class="btn_volver">↩️ Volver</button>
        </a>
    </header>

    <main>    
        <form action="" method="POST">

            <?php
                include ("PHP/agregar-usuario-adFUNTION.php");
            ?>
            
            <label for="username">Codigo de usuario</label>
            <input type="number" name ="codigoUs" id="username" placeholder="Ingresa el codigo del usuario">

            <label for="username">Nombre de usuario</label>
            <input type="text" name ="nombre" id="username" placeholder="Ingresa tu nombre de usuario">
            
            <label for="password">Contraseña</label>
            <input type="password" name ="clave" id="password" placeholder="Ingresa tu contraseña">
            
            <label for="rol">Rol:</label>
                <select id="rol" name="rol">
                    <option value="user">Usuario</option>
                    <option value="admin">Administrador</option>
                </select><br><br>
            

            <input type="submit" value="💾 Guardar" name ="registro">

            <input type="reset" value="Cancelar">

        </form>        
    </main>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2025 Herbario Catatumbo Sarare - HECASA. Todos los derechos reservados.</p>
    </footer>

</body>
</html>





