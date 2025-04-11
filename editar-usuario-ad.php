<?php
    session_start();
    include("PHP/conexionFUNTION.php"); // Asegúrate de incluir la conexión a la BD

    if (!isset($_SESSION['usuario'])) {
        echo "<script>
                alert('Por favor debes iniciar sesión');
                window.location = 'login.php';
              </script>";
        session_destroy();
        die();
    }

    // Verificar si se recibió el ID del usuario a editar
    if (!isset($_GET['id'])) {
        echo "<script>
                alert('No se recibió el ID del usuario');
                window.location = 'admi-usuarios-ad.php';
              </script>";
        exit();
    }

    $id_usuario = $_GET['id'];

    // Obtener los datos del usuario actual
    $sql = "SELECT nombre_usuario, nombreRol FROM usuario join rol on usuario.id_rol = rol.id_rol WHERE id_usuario = ?";
    $stmt = $enlace->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows == 0) {
        echo "<script>
                alert('Usuario no encontrado');
                window.location = 'admi-usuarios-ad.php';
              </script>";
        exit();
    }

    $usuario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditarUsuario</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="css/editar-usuario.css">
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
        <h2>Editar usuario</h2>
        <a href="admi-usuarios-ad.php">
            <button class="btn_volver">↩️ Volver</button>
        </a>
    </header>

    <main>
        <form action="PHP/editar-eliminar-usFUNTION.php" method="POST">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

            <label for="nombreUsuario">Nombre de usuario</label>
            <input type="text" name="nombre_usuario" value="<?php echo $usuario['nombre_usuario']; ?>" required>

            <label for="password">Contraseña (dejar en blanco si no deseas cambiarla)</label>
            <input type="password" name="contrasena_usuario" placeholder="Nueva contraseña">

            <label for="rol">Rol:</label>
            <select name="id_rol">
                <option value="2">Usuario</option>
                <option value="1">Administrador</option>
            </select><br><br>

            <input type="submit" name="guardar" value="💾 Guardar Cambios">

            <button type="submit" name="eliminar" class="btn_eliminar_usuario" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">🗑️ Eliminar</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Herbario Catatumbo Sarare - HECASA. Todos los derechos reservados.</p>
    </footer>
</body>
</html>