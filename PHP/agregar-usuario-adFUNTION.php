<?php
    include ("conexionFUNTION.php");

    if (!empty($_POST["registro"])) {
        if (empty($_POST["nombre"]) or empty($_POST["clave"])) {
            
            echo "<h3 class='error'>Error: Campos vacíos.</h3>";

        } else {
            // Limpiar y obtener los datos
            $codigoUs = mysqli_real_escape_string($enlace, $_POST["codigoUs"]);
            $nombre = mysqli_real_escape_string($enlace, $_POST["nombre"]);
            $clave = mysqli_real_escape_string($enlace, $_POST["clave"]);
            $rol = $_POST["rol"];
            $id_rol = ($rol === "admin") ? 1 : 2;
    
            // Verificar si el código de usuario ya existe
            $verificarCodigo = mysqli_query($enlace, "SELECT * FROM usuario WHERE id_usuario = '$codigoUs'");
    
            if (mysqli_num_rows($verificarCodigo) > 0) {
                echo "<h3 class='error'>Error: El código de usuario ya existe.</h3>";
            } else {
                // Insertar nuevo usuario si el código no está repetido
                $sql = "INSERT INTO usuario (id_usuario, nombre_usuario, contrasena_usuario, id_rol) 
                        VALUES ('$codigoUs', '$nombre', '$clave', '$id_rol')";
    
                if (mysqli_query($enlace, $sql)) {
                    echo "<h3 class='bien'>Usuario registrado correctamente.</h3>";
                } else {
                    echo "<h3 class='error'>Error al registrar usuario.</h3>";
                }
            }
        }
    }
?>
    
<script>
    // Evita que el formulario se reenvíe al recargar la página
    history.replaceState(null, null, location.pathname);
</script>