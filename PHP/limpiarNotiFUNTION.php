<?php
require "conexionFUNTION.php";


if (isset($_POST['limpiar'])) {
    $sql = "DELETE FROM sesionh";

    if ($enlace->query($sql) === TRUE) {
        echo "<script>
            alert('Notificaciones eliminadas correctamente');
            window.location.href = '../notificaciones-ad.php';
        </script>";

    } 

    $enlace->close();
}

?>
