<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script> alert('Por favor debes iniciar sesión'); window.location = 'login.php'; </script>";
    session_destroy();
    die();
}

require "PHP/conexionFUNTION.php"; 

// Verificar la conexión
if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener las copias de seguridad desde la base de datos
$sql = "SELECT * FROM backups ORDER BY created_at DESC";
$resultado = mysqli_query($enlace, $sql);

// Verificar si hay registros
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($enlace));
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copia de Seguridad</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="css/copia-seguridad.css">
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
        <h2>Copias de Seguridad</h2>
        <div class="btn-container">
            <form action="PHP/generar_backupFUNTION.php" method="POST">
                <button class="btn_seguridad" type="submit">📄 Generar</button>
            </form>
            
            <form action = "PHP/vaciar_backupFUNTION.php" method="POST">
                <button type = "submit" name = "vaciar" class="btn_seguridad delete-all" onclick="confirmarEliminacion()">🧹 Vaciar historial</button>
            </form>

        </div>
    </header>
    
    <main>
        <table>
            <thead>
                <tr>
                    <th class="inicio_tabla">Título de informe</th>
                    <th class="medio_tabla">Fecha de creación</th>
                    <th class="medio_tabla">Descargar</th>
                    <th class="fin_tabla">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['filename']); ?></td>
                        <td><?= date("d/m/Y H:i:s", strtotime($row['created_at'])); ?></td>
                        <td>
                            <a href="backups/<?= htmlspecialchars($row['filename']); ?>" download><button>📥 Descargar</button></a>
                        </td>
                        <td>
                            <a href="PHP/eliminar_backupFUNTION.php?id=<?= intval($row['id']); ?>"><button>🗑️ Eliminar</button></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                
            </tbody>

        </table>
    </main>

    <!-- Pie de página -->
    <footer>
        <p>© 2025 Herbario Catatumbo Sarare - HECASA. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
