<?php
    include ("conexionFUNTION.php");
    $consulta = "SELECT * FROM sesionh  ";
    $resultado = mysqli_query($enlace, $consulta);
    if (mysqli_num_rows($resultado) > 0) {

        while ($fila = mysqli_fetch_assoc($resultado)) {
    ?>
        <tr>
        <td><?php echo $fila["usuario_sesion"] ?></td>
        <td><?php echo $fila["fecha_sesion"] ?></td>
        <td><?php echo $fila["estado"] ?></td>
        </tr>
        <?php
        
        }
    }
    else {
        ?>
            <td colspan="5"><?php echo "No hay registros por el momento"; ?></td>
        <?php
    }
                     
?>