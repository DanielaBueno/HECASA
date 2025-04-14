<?php
    include("conexionFUNTION.php");


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_usuario = $_POST['id_usuario'];
        $nombreUsuario = $_POST['nombre_usuario'];
        $password = $_POST['contrasena_usuario']; // Tomamos la contraseña tal como es (en texto claro)
        $rol = $_POST['id_rol'];

        // Si el botón "Eliminar" fue presionado
        if (isset($_POST['eliminar'])) {
            $sql = "DELETE FROM usuario WHERE id_usuario = ?";
            $stmt = $enlace->prepare($sql);
            $stmt->bind_param("i", $id_usuario);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Usuario eliminado correctamente');
                        window.location = '../admi-usuarios-ad.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Error al eliminar usuario');
                        window.history.back();
                    </script>";
            }
            exit();
        }

        // Verificar si el rol existe
        $sql_check_rol = "SELECT COUNT(*) FROM rol WHERE id_rol = ?";
        $stmt_check_rol = $enlace->prepare($sql_check_rol);
        $stmt_check_rol->bind_param("i", $rol);
        $stmt_check_rol->execute();
        $result_check_rol = $stmt_check_rol->get_result();
        $rol_exists = $result_check_rol->fetch_row()[0];
        $stmt_check_rol->close();

        if ($rol_exists == 0) {
            echo "<script>
                    alert('El rol seleccionado no existe en la base de datos');
                    window.history.back();
                </script>";
            exit();
        }

        // Si el botón "Guardar Cambios" fue presionado
        if (isset($_POST['guardar'])) {
            // Si se cambia la contraseña, la dejamos tal cual es en el formulario (sin cifrado)
            if (!empty($password)) {
            
                $sql = "UPDATE usuario SET nombre_usuario = ?, contrasena_usuario = ?, id_rol = ? WHERE id_usuario = ?";
                $stmt = $enlace->prepare($sql);
                $stmt->bind_param("ssii", $nombreUsuario, $password, $rol, $id_usuario);
            } else {
                // Si no se cambia la contraseña
                $sql = "UPDATE usuario SET nombre_usuario = ?, id_rol = ? WHERE id_usuario = ?";
                $stmt = $enlace->prepare($sql);
                $stmt->bind_param("ssi", $nombreUsuario, $rol, $id_usuario);
            }

            // Ejecutar la consulta de actualización
            if ($stmt->execute()) {
                echo "<script>
                        alert('Usuario actualizado correctamente');
                        window.location = '../admi-usuarios-ad.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Error al actualizar usuario');
                        window.history.back();
                    </script>";
            }
            $stmt->close(); // Cerrar la sentencia después de usarla
            exit();
        }
    }
?>
