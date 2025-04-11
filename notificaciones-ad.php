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
    <title>Notificaciones de Actividad</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="css/notificaciones.css">
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


    <!-- Resgistro de actividad (Titulo) -->
    <header>
        <h2>Notificaciones</h2>
        <Form action = "PHP/limpiarNotiFUNTION.php" method="POST">
            <button type = "submit" name = "limpiar" class="btn_clear">🧹 Limpiar Notificaciones</button>
        </Form>
    </header>


    <!-- Contenedor de las notificaciones -->
    <main>
        <table class="table_notificaciones">
            <thead>
                <tr>
                    <th class="inicio_tabla">Usuario</th>
                    <th class="medio_tabla">Fecha</th>
                    <th class="fin_tabla">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "PHP/notificacionesFUNTION.php";
                ?>
            </tbody>
        </table>
    </main>
    



    <!-- Pie de página -->
    <footer>
        <p>&copy; 2025 Herbario Catatumbo Sarare - HECASA. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
