<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo "<script>
            alert('Por favor debes iniciar sesión');
            window.location = 'login.php';
          </script>";
    session_destroy();
    die();
}


include("PHP/conexionFUNTION.php");

// Variables para la búsqueda
$where = "";
$busqueda_id = isset($_POST['id_ejemplar']) ? trim($_POST['id_ejemplar']) : "";
$busqueda_nombre = isset($_POST['scientificName']) ? trim($_POST['scientificName']) : "";
$busqueda_municipio = isset($_POST['county']) ? trim($_POST['county']) : "";
$busqueda_recolector = isset($_POST['recordedby']) ? trim($_POST['recordedby']) : "";

// Construcción de la consulta SQL con filtros
if ($busqueda_id || $busqueda_nombre || $busqueda_municipio || $busqueda_recolector) {
    $where = "WHERE 1=1";  // Base para evitar errores si no hay filtros

    if (!empty($busqueda_id)) {
        $where .= " AND id_ejemplar LIKE '%$busqueda_id%'";
    }
    if (!empty($busqueda_nombre)) {
        $where .= " AND scientificName LIKE '%$busqueda_nombre%'";
    }
    if (!empty($busqueda_municipio)) {
        $where .= " AND county LIKE '%$busqueda_municipio%'";
    }
    if (!empty($busqueda_recolector)) {
        $where .= " AND recordedby LIKE '%$busqueda_recolector%'";
    }
}

// Aplicar la consulta con los filtros
$sqlEjemplar = "SELECT id_ejemplar, scientificName, county, recordedby FROM ejemplar $where";
$sql = $enlace->query($sqlEjemplar);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colección General</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="css/coleccion-general.css">
</head>
<body>
<!-- Navegación -->
<nav>
    <div id="inicio">
        <img src="Media/logo.png" alt="Logo" style="width: 35px; height: auto;">
    </div>

        <a href="coleccion-general-us.php">
            <button id="btn-coleccion-general">Coleccion General</button>
        </a>
        
        <a href="ingreso-ejemplar-us.php">
            <button id="btn-ingreso-datos">Ingreso de Datos</button>
        </a>
        
        <div id="fin">
            
            <a href="PHP/boton_cerrarSesionFUNTION.php">
                <button id="btn-salir">Salir</button>
            </a>
        </div>
    </div>

    <!-- El script de activación del "active" -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const currentUrl = window.location.href;

            const buttons = document.querySelectorAll('nav a button');
        
            buttons.forEach(button => {
                const buttonUrl = button.parentElement.getAttribute('href');
                
                if (currentUrl.includes(buttonUrl)) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
        });
    </script>
</nav>

<header>
    <!-- Buscador -->
    <form action="" method="POST" class="buscador" id="form-filtro">
        <div class="input-group">
            <input type="number" id="id_ejemplar" name="id_ejemplar" placeholder="Número de catálogo" value="<?= htmlspecialchars($busqueda_id) ?>">
            <input type="text" id="scientificName" name="scientificName" placeholder="Nombre científico" value="<?= htmlspecialchars($busqueda_nombre) ?>">
        </div>
        <div class="input-group">
            <input type="text" id="county" name="county" placeholder="Municipio" value="<?= htmlspecialchars($busqueda_municipio) ?>">
            <input type="text" id="recordedby" name="recordedby" placeholder="Recolector" value="<?= htmlspecialchars($busqueda_recolector) ?>">
            <button type="submit" name="enviar">🔍 Buscar</button>
        </div>
    </form>

    <div class="botones-exportar">
        <!-- Botón para generar Excel -->
        <a class="btn btn-primary" href="#" onclick="generarExcel()"><button>Generar CVS</button> 
        <i class="fa fa-file-excel" aria-hidden="true"></i>
        </a>

        <!-- Script para capturar los filtros y enviarlos a excel.php -->
        <script>
            function generarExcel() {
                var form = document.getElementById('form-filtro');
                var formData = new FormData(form);
                var params = new URLSearchParams(formData).toString();
                
                window.location.href = "PHP/excel.php?" + params;
            }
        </script>

        <!-- Botón para generar PDF -->
        <a class="btn btn-danger" href="#" onclick="generarPDF()"><button>Generar PDF</button>
        <i class="fa fa-file-pdf" aria-hidden="true"></i>
        </a>

        <script>
            function generarPDF() {
                var id_ejemplar = document.getElementById('id_ejemplar').value;
                var scientificName = document.getElementById('scientificName').value;
                var county = document.getElementById('county').value;
                var recordedby = document.getElementById('recordedby').value;

                var url = "PHP/pdf.php?id_ejemplar=" + encodeURIComponent(id_ejemplar) +
                        "&scientificName=" + encodeURIComponent(scientificName) +
                        "&county=" + encodeURIComponent(county) +
                        "&recordedby=" + encodeURIComponent(recordedby);

                window.open(url, '_blank'); // 🚀 Abre el PDF en una nueva pestaña
            }
        </script>
    </div>
</header>

<!-- Tabla de colección -->
<main>
    <table>
        <thead>
            <tr>
                <th>Número de catálogo</th>
                <th>Nombre científico</th>
                <th>Municipio</th>
                <th>Recolector</th>
                <th class="fin_tabla">Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($sql && $sql->num_rows > 0): ?>
                <?php while ($row = $sql->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_ejemplar']); ?></td>
                        <td><?= htmlspecialchars($row['scientificName']); ?></td>
                        <td><?= htmlspecialchars($row['county']); ?></td>
                        <td><?= htmlspecialchars($row['recordedby']); ?></td>
                        <td>
                            <a href="detalles-ejemplar-us.php?id=<?= htmlspecialchars($row['id_ejemplar']); ?>">
                                <button>📋 Detalles</button>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No se encontraron resultados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>
