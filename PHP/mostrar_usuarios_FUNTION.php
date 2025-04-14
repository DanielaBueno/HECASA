<?php
    include "conexionFUNTION.php";


    $sql = "SELECT * FROM usuario";
    $resultado = mysqli_query($enlace, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<h1>Los usuarios son:</h1>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "ID Usuario: " . $fila['id_usuario'] . " - Nombre: " . $fila['nombre_usuario'] . 
                " - Contraseña: " . $fila['contrasena_usuario'] . " - Rol: " . $fila['id_rol'] . "<br>";
        }
    } else {
        echo "<h1>No se han encontrado usuarios.</h1>";
    }

    mysqli_close($enlace);
?>