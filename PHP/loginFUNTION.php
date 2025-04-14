<?php
include ("conexionFUNTION.php");

session_start();

if (!empty($_POST["ingresar"])) {

    if (empty($_POST["usuario"]) || empty($_POST["contraseña"])) {
        echo '<script>
            alert("Campos vacíos");
            window.location = "../login.php";
            </script>';
        exit;
    } 
    else {
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contraseña"];
        $rolAD = "Administrador";
        $rolUS = "Usuario";

        // Consultas con id_usuario incluido
        $validar_loginAD = mysqli_query($enlace, "SELECT id_usuario FROM usuario JOIN rol ON usuario.id_rol = rol.id_rol WHERE nombre_usuario = '$usuario' and contrasena_usuario = '$contrasena' and nombreRol = '$rolAD'");
        $validar_loginUS = mysqli_query($enlace, "SELECT id_usuario FROM usuario JOIN rol ON usuario.id_rol = rol.id_rol WHERE nombre_usuario = '$usuario' and contrasena_usuario = '$contrasena' and nombreRol = '$rolUS'");

        if (mysqli_num_rows($validar_loginAD) > 0) {
            $fila = mysqli_fetch_assoc($validar_loginAD);
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id_usuario'] = $fila['id_usuario']; 

            date_default_timezone_set('America/Bogota');
            $fecha = date('Y-m-d H:i:s');
            $estado = "Inició sesión";
            $query = "INSERT INTO sesionh (usuario_sesion, fecha_sesion, estado) VALUE ('$usuario','$fecha','$estado')";
            mysqli_query($enlace, $query);

            header("location: ../coleccion-general-ad.php");
            exit;
        } 
        elseif (mysqli_num_rows($validar_loginUS) > 0) {
            $fila = mysqli_fetch_assoc($validar_loginUS);
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id_usuario'] = $fila['id_usuario']; 

            date_default_timezone_set('America/Bogota');
            $fecha = date('Y-m-d H:i:s');
            $estado = "Inició sesión";
            $query = "INSERT INTO sesionh (usuario_sesion, fecha_sesion, estado) VALUE ('$usuario','$fecha','$estado')";
            mysqli_query($enlace, $query);

            header("location: ../coleccion-general-us.php");
            exit;
        } 
        else {
            echo '<script>
                alert("Usuario no existe, por favor verifica los datos introducidos");
                window.location = "../login.php";
                </script>';
            exit;
        }
    }
}
?>
