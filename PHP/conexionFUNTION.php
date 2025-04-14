
<?php
    
    // Conexion con la base de datos
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $bd = "herbario_hecasa";

    $enlace = mysqli_connect($servidor,$usuario,$contrasena,$bd);
    $enlace->set_charset("utf8");

    ?>
