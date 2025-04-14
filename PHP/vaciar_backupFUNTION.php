<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Por favor debes iniciar sesión'); window.location = '../login.php';</script>";
    exit;
}

require "conexionFUNTION.php"; 

if (isset($_POST['vaciar'])) {
    $backupDir = "../backups/"; 
    $archivos = glob($backupDir . "*.sql"); 

    // Eliminar cada archivo físico
    foreach ($archivos as $archivo) {
        if (file_exists($archivo)) {
            unlink($archivo);
        }
    }

    // Vaciar la tabla en la base de datos
    $sql = "DELETE FROM backups";
    if (mysqli_query($enlace, $sql)) {
        echo "<script>alert('✅ Todas las copias de seguridad han sido eliminadas.'); window.location='../copia-seguridad-ad.php';</script>";
    } else {
        echo "<script>alert('⚠️ Error al eliminar registros de la base de datos.'); window.location='../copia-seguridad-ad.php';</script>";
    }
}
?>
