<?php
require "conexionFUNTION.php"; 

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Obtener el nombre del archivo antes de eliminarlo
    $sql = "SELECT filename FROM backups WHERE id = $id";
    $result = mysqli_query($enlace, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $archivo = "../backups/" . $row['filename'];
        
        // Eliminar el archivo físico
        if (file_exists($archivo)) {
            unlink($archivo);
        }

        // Eliminar el registro en la base de datos
        $sql = "DELETE FROM backups WHERE id = $id";
        if (mysqli_query($enlace, $sql)) {
            echo "<script>alert('✅ Copia eliminada correctamente'); window.location='../copia-seguridad-ad.php';</script>";
        } else {
            echo "<script>alert('⚠️ Error al eliminar de la base de datos'); window.location='../copia-seguridad-ad.php';</script>";
        }
    } else {
        echo "<script>alert('❌ El archivo no existe en la base de datos'); window.location='../copia-seguridad-ad.php';</script>";
    }
}
?>
