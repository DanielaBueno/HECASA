<?php
    session_start();

    if(!isset($_SESSION['usuario'])) {
        echo "<script>
                alert('Por favor debes iniciar sesión');
                window.location = 'login.php';
             </script>";

        session_destroy();
        die();
    }
    require "PHP/conexionFUNTION.php";
// Obtener ID desde la URL
    if(isset($_GET['id'])) {
        $id_ejemplar = $_GET['id'];

        // Consulta SQL para obtener los datos del ejemplar
        $sql = "SELECT * FROM ejemplar WHERE id_ejemplar = $id_ejemplar";
        $resultado = mysqli_query($enlace, $sql);
        $ejemplar = mysqli_fetch_assoc($resultado);
    }else{
        echo "<script>window.location = 'coleccion-general-us.php';</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Ejemplar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="css/detalles-ejemplar.css">
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
    
    <!-- Contenido -->  
    
    <header>
        <h2>Detalles del Ejemplar del Herbario</h2>
        <div class="btn-contenedor">
            <a href="coleccion-general-us.php">
                <button class="btn_detalles">↩️ Volver a la Colección</button>
            </a>
            <a href="PHP/Etiqueta.php?id=<?= htmlspecialchars($ejemplar['id_ejemplar']); ?>">
                <button class="btn_detalles">🏷️ Generar Etiqueta</button>
            </a>
        </div>
    </header>
    
    <main>
        <!-- Sección de Datos Generales -->
        <section class="seccion">
            <h3>Datos Generales</h3>
            <article class="elemento">
                <span>ID Institución:</span> <p><?= $ejemplar['institutionCode']; ?></p>
            </article>
            <article class="elemento">
                <span>Código de Colección:</span> <p><?= $ejemplar['collectionCode']; ?></p>
            </article>
            <article class="elemento">
                <span>Número de Registro:</span> <p><?= $ejemplar['recordNumber']; ?></p>
            </article>
            <article class="elemento">
                <span>Recolector:</span> <p><?= $ejemplar['recordedby']; ?></p>
            </article>
            <article class="elemento">
                <span>Fecha del Evento:</span> <p><?= $ejemplar['eventDate']; ?></p>
            </article>
            <article class="elemento">
                <span>Hábitat:</span> <p><?= $ejemplar['habitat']; ?></p>
            </article>
        </section>

        <!-- Sección de Ubicación Geográfica -->
        <section class="seccion">
            <h3>Ubicación Geográfica</h3>
            <article class="elemento">
                <span>País:</span> <p><?= $ejemplar['country']; ?></p>
            </article>
            <article class="elemento">
                <span>Departamento:</span> <p><?= $ejemplar['stateProvince']; ?></p>
            </article>
            <article class="elemento">
                <span>Municipio:</span> <p><?= $ejemplar['county']; ?></p>
            </article>
            <article class="elemento">
                <span>Corregimiento:</span> <p><?= $ejemplar['municipality']; ?></p>
            </article>
            <article class="elemento">
                <span>Localidad:</span> <p><?= $ejemplar['locality']; ?></p>
            </article>
            <article class="elemento">
                <span>Latitud Verbatim:</span> <p><?= $ejemplar['verbatimLatitude']; ?></p>
            </article>
            <article class="elemento">
                <span>Longitud Verbatim:</span> <p><?= $ejemplar['verbatimLongitude']; ?></p>
            </article>
            <article class="elemento">
                <span>Latitud Decimal:</span> <p><?= $ejemplar['decimalLatitude']; ?></p>
            </article>
            <article class="elemento">
                <span>Longitud Decimal:</span> <p><?= $ejemplar['decimalLongitude']; ?></p>
            </article>
            <article class="elemento">
                <span>Datum Geodético:</span> <p><?= $ejemplar['geodeticDatum']; ?></p>
            </article>
        </section>

        <!-- Sección de Identificación y Clasificación -->
        <section class="seccion">
            <h3>Identificación</h3>
            <article class="elemento">
                <span>Identificado por:</span> <p><?= $ejemplar['identifiedBy']; ?></p>
            </article>
            <article class="elemento">
                <span>Fecha de Identificación:</span> <p><?= $ejemplar['dateIdentified']; ?></p>
            </article>
            <article class="elemento">
                <span>Nombre Científico:</span> <p><?= $ejemplar['scientificName']; ?></p>
            </article>
            <article class="elemento">
                <span>Calificador de Identificación:</span> <p><?= $ejemplar['identificationQualifier']; ?></p>
            </article>
            <article class="elemento">
                <span>Condición Reproductiva:</span> <p><?= $ejemplar['reproductiveCondition']; ?></p>
            </article>
            <article class="elemento">
                <span>Observaciones de Ocurrencia:</span> <p><?= $ejemplar['ocurrenceRemarks']; ?></p>
            </article>
        </section>

        <!-- Sección de Taxonomía -->
        <section class="seccion">
            <h3>Clasificación Taxonómica</h3>
            <article class="elemento">
                <span>Reino:</span> <p><?= $ejemplar['kingdom']; ?></p>
            </article>
            <article class="elemento">
                <span>Clase:</span> <p><?= $ejemplar['class']; ?></p>
            </article>
            <article class="elemento">
                <span>Orden:</span> <p><?= $ejemplar['orderr']; ?></p>
            </article>
            <article class="elemento">
                <span>Familia:</span> <p><?= $ejemplar['family']; ?></p>
            </article>
            <article class="elemento">
                <span>Género:</span> <p><?= $ejemplar['genus']; ?></p>
            </article>
            <article class="elemento">
                <span>Epíteto Específico:</span> <p><?= $ejemplar['specificEpithet']; ?></p>
            </article>
            <article class="elemento">
                <span>Rango Taxonómico:</span> <p><?= $ejemplar['taxonRank']; ?></p>
            </article>
            <article class="elemento">
                <span>Autoridad del Nombre Científico:</span> <p><?= $ejemplar['scientificNameAuthorship']; ?></p>
            </article>
        </section>

        <!-- Sección de Datos del Usuario -->
        <section class="seccion">
            <h3>Datos del Usuario</h3>
            <article class="elemento">
                <span>ID Usuario:</span> <p><?= $ejemplar['id_usuario']; ?></p>
            </article>
        </section>
    </main>

    
    <!-- Pie de página -->
    <footer>
        <p>&copy; 2025 Herbario Catatumbo Sarare - HECASA. Todos los derechos reservados.</p>
    </footer>
    
    </body>
</html>