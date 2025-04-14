<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script> alert('Por favor debes iniciar sesión'); window.location = '../login.php'; </script>";
    session_destroy();
    die();
}

require "conexionFUNTION.php"; 

// Directorio de backups
$backupDir = "../backups/";
if (!is_dir($backupDir)) {
    mkdir($backupDir, 0777, true);
}

// Nombre del archivo de backup
$backupFile = $backupDir . "backup_" . date("Y-m-d_H-i-s") . ".sql";

// Obtener todas las tablas
$tablas = [];
$result = mysqli_query($enlace, "SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tablas[] = $row[0];
}

// Crear el contenido del backup
$contenido = "";
foreach ($tablas as $tabla) {
    $resultado = mysqli_query($enlace, "SHOW CREATE TABLE $tabla");
    $fila = mysqli_fetch_row($resultado);
    $contenido .= "\n\n" . $fila[1] . ";\n\n";

    $resultado = mysqli_query($enlace, "SELECT * FROM $tabla");
    while ($row = mysqli_fetch_assoc($resultado)) {
        $valores = array_map(fn($valor) => "'" . mysqli_real_escape_string($enlace, $valor) . "'", $row);
        $contenido .= "INSERT INTO $tabla VALUES (" . implode(", ", $valores) . ");\n";
    }
}

// Guardar en el archivo
if (file_put_contents($backupFile, $contenido)) {
    // Registrar en la base de datos
    $sql = "INSERT INTO backups (filename, created_at) VALUES ('" . basename($backupFile) . "', NOW())";
    mysqli_query($enlace, $sql);

    echo "<script>alert('✅ Copia de seguridad creada con éxito'); window.location='../copia-seguridad-ad.php';</script>";
} else {
    echo "<script>alert('❌ Error al crear la copia de seguridad'); window.location='../copia-seguridad-ad.php';</script>";
}
?>
