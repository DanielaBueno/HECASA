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
<?php

require "PHP/conexionFUNTION.php";

$sqlusuarios = "SELECT id_usuario,nombre_usuario, contrasena_usuario, nombreRol FROM usuario join rol on usuario.id_rol = rol.id_rol;";
$usuarios = $enlace->query($sqlusuarios)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="css/admi-usuarios.css">
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
        <h2>Administrar Usuarios</h2>
        <a href="agregar-usuario-ad.php">
            <button id="btn_agregar_usuario">➕👤 Agregar Usuario</button>
        </a>
    </header>
    
    <main>
        <!-- Tabla de usuarios -->
        <table id='tabla_usuarios'>
            <thead>
                <tr>
                    <th class="inicio_tabla">id de usuario</th>
                    <th class="medio_tabla">Nombre de Usuario</th>
                    <th class="medio_tabla">Contraseña</th>
                    <th class="medio_tabla">Rol</th>
                    <th class="fin_tabla">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php while($row_usuarios = $usuarios->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row_usuarios['id_usuario']; ?> </td>
                        <td><?= $row_usuarios['nombre_usuario']; ?> </td>
                        <td><?= $row_usuarios['contrasena_usuario']; ?> </td>
                        <td><?= $row_usuarios['nombreRol']; ?> </td>
                        <td>
                        <a href="editar-usuario-ad.php?id=<?= htmlspecialchars($row_usuarios['id_usuario']); ?>">
                            <button>✏️ Editar</button>
                        </a>
                        </td>
                    </tr>

                <?php
             } ?>
            </tbody>
        </table>

    </main>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2025 Herbario Catatumbo Sarare - HECASA. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
