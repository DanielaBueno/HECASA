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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ingreso de Ejemplares</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="css/ingreso-ejemplar.css">
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
        <h2>Formulario de Ingreso de Ejemplares</h2>
    </header>

    <main>

    <form id="formulario" method = "POST">

            <?php
                include "PHP/ingreso-ejemplar-ad-FUNTION.php";
            ?>

            <label for="catalogNumber">Número de catálogo
                <span class="espanol">Catalog Number</span>
                <details>
                    <summary>+info</summary>
                    <p>"Un identificador (preferiblemente único) asignado al espécimen, muestra o lote en la colección biológica. Puede repetirse en caso de que los especímenes están agrupados en la colección (Lote, Frasco, Caja, etc). Debe documentarse de la misma forma que está en la etiqueta."</p>
                </details>
            </label>
            <input type="number" id="catalogNumber" name="catalogNumber">
    
            <label for="institutionCode">Código de institución
                <span class="espanol">Institution Code</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre completo de la institución que custodia el espécimen o la información del registro; seguido por su acrónimo en paréntesis, si tiene.</p>
                </details>
            </label>
            <input type="text" id="institutionCode" name="institutionCode">
    
            <label for="collectionCode">Código de colección
                <span class="espanol">Collection Code</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre, acrónimo, código alfanumérico, o iniciales que identifican la colección o conjunto de datos del que procede el organismo. </p>
                </details>
            </label>
            <input type="text" id="collectionCode" name="collectionCode">
    
            <label for="recordNumber">Número de registro
                <span class="espanol">Record Number</span>
                <details>
                    <summary>+info</summary>
                    <p>Un identificador dado al registro biológico en el momento en que fue registrado, sirve como un vínculo entre las anotaciones de campo y el registro biológico. No es el mismo catalogNumber, el cual es usualmente asignado una vez el espécimen ingresa a la colección.</p>
                </details>
            </label>
            <input type="number" id="recordNumber" name="recordNumber">
    
            <label for="recordedBy">Recolector
                <span class="espanol">Recorded By</span>
                <details>
                    <summary>+info</summary>
                    <p>"Una lista (en una fila continua y separada por una barra vertical "" | "") de los nombres de las personas (observadores o recolectores) responsables de realizar el registro.
                    El colector u observador principal, especialmente si está asociado al recordNumber tomado en campo, se debe listar en primer lugar. Se debe mantener el mismo formato del nombre a lo largo de todos los registros y se recomienda evitar el uso de solo iniciales ya que esto genera ambigüedades para reconocer a las personas que realizaron el registro, de ser posible siempre escriba nombres completos. Documente el nombre de las personas y evite documentar nombres de grupos u organizaciones."</p>
                </details>
            </label>
            <input type="text" id="recordedBy" name="recordedby">
    
            <label for="eventDate">Fecha del evento
                <span class="espanol">Event Date</span>
                <details>
                    <summary>+info</summary>
                    <p>La fecha o el intervalo durante el cual se produjo el evento de observación o colecta de un organismo o muestra.</p>
                </details>
            </label>
            <input type="date" id="eventDate" name="eventDate">
    
            <label for="habitat">Hábitat
                <span class="espanol">Habitat</span>
                <details>
                    <summary>+info</summary>
                    <p>Una categoría estandarizada o la descripción del hábitat en el que ocurrió el evento.</p>
                </details>
            </label>
            <input type="text" id="habitat" name="habitat">
    
            <label for="country">País
                <span class="espanol">Country</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre del país o unidad administrativa de mayor jerarquía de la ubicación."</p>
                </details>
            </label>
            <input type="text" id="country" name="country">
    
            <label for="stateProvince">Departamento
                <span class="espanol">State/Province</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que País de la ubicación (Departamento). Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola).</p>
                </details>
            </label>
            <input type="text" id="stateProvince" name="stateProvince">
    
            <label for="county">Municipio
                <span class="espanol">County</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que Departamento de la ubicación (Municipio). Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola)."</p>
                </details>
            </label>
            <input type="text" id="county" name="county">
    
            <label for="municipality">Corregimiento
                <span class="espanol">Municipality</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que Municipio de la ubicación. Puede ser un centro poblado, cabecera municipal, corregimiento o inspección de policía. No utilice este elemento para el nombre de un lugar cercano que no contiene la ubicación real. Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola)."</p>
                </details>
            </label>
            <input type="text" id="municipality" name="municipality">
    
            <label for="locality">Localidad
                <span class="espanol">Locality</span>
                <details>
                    <summary>+info</summary>
                    <p>La información geográfica más específica de la ubicación. Información geográfica de menor especificidad puede ser provista en otros elementos geográficos (higherGeography, continent, country, stateProvince, county, municipality, waterBody, island, islandGroup). Este elemento puede contener información modificada de la original para corregir errores o estandarizar la descripción.</p>
                </details>
            </label>
            <input type="text" id="locality" name="locality">
    
            <label for="minimumElevationInMeters">Elevación mínima en metros
                <span class="espanol">Minimum Elevation in Meters</span>
                <details>
                    <summary>+info</summary>
                    <p>El límite inferior del rango de elevación (altitud, generalmente por encima del nivel del mar), no utilice ningún indicador de unidad (metros, m, msnm) ya que el elemento especifica que los valores anotados son en metros.</p>
                </details>
            </label>
            <input type="number" id="minimumElevationInMeters" name="minimumElevationInMeters">
    
            <label for="maximumElevationInMeters">Elevación máxima en metros
                <span class="espanol">Maximum Elevation in Meters</span>
                <details>
                    <summary>+info</summary>
                    <p>El límite superior del rango de elevación (altitud, generalmente por encima del nivel del mar), no utilice ningún indicador de unidad (metros, m, msnm) ya que el elemento especifica que los valores anotados son en metros.</p>
                </details>
            </label>
            <input type="number" id="maximumElevationInMeters" name="maximumElevationInMeters">
                
            <label for="verbatimLatitude">Latitud exacta
                <span class="espanol">Verbatim Latitude</span>
                <details>
                    <summary>+info</summary>
                    <p>La latitud original de la ubicación. El elipsoide de coordenadas, el datum geodésico o el sistema de referencia espacial completo (SRS) para estas coordenadas debe ser documentado en el elemento verbatimSRS, y el sistema de coordenadas en el elemento verbatimCoordinateSystem.</p>
                </details>
            </label>
            <input type="text" id="verbatimLatitude" name="verbatimLatitude">
    
            <label for="verbatimLongitude">Longitud exacta
                <span class="espanol">Verbatim Longitude</span>
                <details>
                    <summary>+info</summary>
                    <p>La longitud original de la ubicación. El elipsoide de coordenadas, datum geodésico o el sistema de referencia espacial completo (SRS) para estas coordenadas, debe ser documentado en el elemento verbatimSRS y el sistema de coordenadas en el elemento verbatimCoordinateSystem.</p>
                </details>
            </label>
            <input type="text" id="verbatimLongitude" name="verbatimLongitude">
    
            <label for="decimalLatitude">Latitud decimal
                <span class="espanol">Decimal Latitude</span>
                <details>
                    <summary>+info</summary>
                    <p>La latitud geográfica (en grados decimales, utilizando el sistema de referencia espacial provisto en geodeticDatum) del centro geográfico de una ubicación. Los valores positivos se encuentran al norte del ecuador, los valores negativos están al sur del mismo. Los valores admitidos se encuentran entre -90 y 90.</p>
                </details>
            </label>
            <input type="text" id="decimalLatitude" name="decimalLatitude">
    
            <label for="decimalLongitude">Longitud decimal
                <span class="espanol">Decimal Longitude</span>
                <details>
                    <summary>+info</summary>
                    <p>La longitud geográfica (en grados decimales, mediante el sistema de referencia espacial provisto en geodeticDatum) del centro geográfico de una ubicación. Los valores positivos se encuentran al este del meridiano de Greenwich, los valores negativos se encuentran al oeste de la misma. Los valores admitidos se encuentran entre -180 y 180.</p>
                </details>
            </label>
            <input type="text" id="decimalLongitude" name="decimalLongitude">
    
            <label for="geodeticDatum">Datum geodésico
                <span class="espanol">Geodetic Datum</span>
                <details>
                    <summary>+info</summary>
                    <p>"El elipsoide, datum geodésico, o sistema de referencia espacial (SRS) en el que se basan las coordenadas geográficas provistas en decimalLatitude y decimalLongitude. Se recomienda usar el código EPSG, si se conoce. Caso contrario, utilice un lenguaje controlado para el nombre o código del datum geodésico, o utilice un lenguaje controlado para el nombre o código del elipsoide, si se conoce. Si ninguno de estos se conoce, utilice el valor ""Desconocido"".
                    Aunque el estándar no es restrictivo en el datum a usar, desde el SiB Colombia se recomienda documentar las coordenadas decimales usando el datum WGS84 dado que facilita la espacialización de los datos publicados por diferentes organizaciones bajo un mismo sistema de referencia espacial, lo que minimiza el riesgo de desplazamiento de las coordenadas."</p>
                </details>
            </label>
            <input type="text" id="geodeticDatum" name="geodeticDatum">
    
            <label for="identifiedBy">Identificado por
                <span class="espanol">Identified By</span>
                <details>
                    <summary>+info</summary>
                    <p>"Una lista (en una fila continua y separada por una barra vertical "" | "") de los nombres de las personas responsables de identificar el organismo. </p>
                </details>
            </label>
            <input type="text" id="identifiedBy" name="identifiedBy">
    
            <label for="dateIdentified">Fecha de identificación
                <span class="espanol">Date Identified</span>
                <details>
                    <summary>+info</summary>
                    <p>La fecha o el intervalo durante el cual  fue identificado taxonómicamente la observación, colecta o muestra.</p>
                </details>
            </label>
            <input type="date" id="dateIdentified" name="dateIdentified">

            <label for="scientificName">Nombre Cientifico
                <span class="espanol">Scientific Name</span>
                <details>
                    <summary>+info</summary>
                    <p>Este es el contenido adicional que se muestra cuando el usuario expande el bloque.</p>
                </details>
            </label>
            <input type="text" id="scientificName" name="scientificName">

            <label for="identificationQualifier">Identificación Calificador
                <span class="espanol">Identification Qualifier</span>
                <details>
                    <summary>+info</summary>
                    <p>"El grado de incertidumbre de la identificación puede indicarse agregando varios términos, como aff. y cf. al nombre científico. El calificador se aplica a la parte del nombre que sigue inmediatamente al calificador y se pueden colocar delante de cualquier elemento del nombre.
                    cf.  del latín confer significa comparado con. Su uso indica que no hay certeza de la identidad de la especie (o rango taxonómico superior) hasta que se pueda hacer una comparación más detallada, por ejemplo, con algún tipo o material de referencia. 
                    aff. del latín affinis significa similar o limítrofe. Su uso indica que el material o la evidencia disponible sugiere que la especie propuesta está relacionada, tiene afinidad, pero no es idéntica, a la especie o taxón que le sigue.
                    Documente este elemento de acuerdo a las siguientes explicaciones:
                    cf. agrifolia  (Para Quercus cf. agrifolia, con valores acompañantes scientificName: Quercus , genus: Quercus, taxonRank: Género.) 
                    aff. Sparassidae (Para aff. Sparassidae, con valores acompañantes  scientificName: Araneae, order: Araneae, taxonRank: Orden.)"</p>
                </details>
            </label>
            <input type="text" id="identificationQualifier" name="identificationQualifier">

            <label for="reproductiveCondition">Condición Reproductiva
                <span class="espanol">Reproductive Condition</span>
                <details>
                    <summary>+info</summary>
                    <p>Condición reproductiva de el(los) organismo(s) en el momento del registro. Se recomienda el uso de un vocabulario controlado.</p>
                </details>
            </label>
            <input type="text" id="reproductiveCondition" name="reproductiveCondition">

            <label for="ocurrenceRemarks">Observaciones de ocurrencia
                <span class="espanol">Occurrence Remarks</span>
                <details>
                    <summary>+info</summary>
                    <p>Comentarios o anotaciones sobre el registro biológico. Se recomienda que la longitud de la descripción no supere 20 palabras.</p>
                </details>
            </label>
            <input type="text" id="ocurrenceRemarks" name="ocurrenceRemarks">

            <label for="kingdom">Reino
                <span class="espanol">Kingdom</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo del reino al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" id="kingdom" name="kingdom">

            <label for="class">Clase
                <span class="espanol">Class</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo de la clase al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" id="class" name="class">

            <label for="order">Orden
                <span class="espanol">Order</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo del orden al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" id="order" name="orderr">

            <label for="family">Familia
                <span class="espanol">Family</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo de la familia al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" id="family" name="family">

            <label for="genus">Género
                <span class="espanol">Genus</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo del género al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" id="genus" name="genus">

            <label for="specificEpithet">Epíteto específico
                <span class="espanol">Specific Epithet</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre del epíteto específico presente en el scientificName cuando la determinación se hizo hasta especie u otra categoría menor.</p>
                </details>
            </label>
            <input type="text" id="specificEpithet" name="specificEpithet">


            <label for="taxonRank">Peligro de extinción
                <span class="espanol">Taxon Rank</span>
                <details>
                    <summary>+info</summary>
                    <p>La categoría taxonómica del nombre más específico presente en el scientificName. Se recomienda el uso del vocabulario sugerido disponible para este elemento.</p>
                </details>
            </label>
            <input type="text" id="taxonRank" name="taxonRank">    

            <label for="scientificNameAuthorship">Autoría del Nombre Científico
                <span class="espanol">Scientific Name Authorship</span>
                <details>
                    <summary>+info</summary>
                    <p>La información de autoría correspondiente al scientificName, usando el formato acorde a las convenciones del Código Nomenclatural aplicable.</p>
                </details>
            </label>
            <input type="text" id="scientificNameAuthorship" name="scientificNameAuthorship">

            <label for="id_usuario ">ID usuario
                <span class="espanol">codigo de usuario</span>
                <details>
                    <summary>+info</summary>
                    <p>Ingresa el numero de ID de usuario asignado</p>
                </details>
            </label>
            <input type="number" id="id_usuario " name="id_usuario">
    
            <!-- Botón de envío -->
            <input type="submit" name="enviarEjemplar" value = "💾 Enviar"></input>
        </form>

    <?php
        include "PHP/ingreso-ejemplar-ad-FUNTION.php";
    ?>

        <label for="catalogNumber">Número de catálogo
            <span class="espanol">Catalog Number</span>
            <details>
                <summary>+info</summary>
                <p>"Un identificador (preferiblemente único) asignado al espécimen, muestra o lote en la colección biológica. Puede repetirse en caso de que los especímenes están agrupados en la colección (Lote, Frasco, Caja, etc). Debe documentarse de la misma forma que está en la etiqueta."</p>
            </details>
        </label>
        <input type="number" id="catalogNumber" name="catalogNumber">

        <label for="institutionCode">Código de institución
            <span class="espanol">Institution Code</span>
            <details>
                <summary>+info</summary>
                <p>El nombre completo de la institución que custodia el espécimen o la información del registro; seguido por su acrónimo en paréntesis, si tiene.</p>
            </details>
        </label>
        <input type="text" id="institutionCode" name="institutionCode">

        <label for="collectionCode">Código de colección
            <span class="espanol">Collection Code</span>
            <details>
                <summary>+info</summary>
                <p>"El nombre, acrónimo, código alfanumérico, o iniciales que identifican la colección o conjunto de datos del que procede el organismo. </p>
            </details>
        </label>
        <input type="text" id="collectionCode" name="collectionCode">

        <label for="recordNumber">Número de registro
            <span class="espanol">Record Number</span>
            <details>
                <summary>+info</summary>
                <p>Un identificador dado al registro biológico en el momento en que fue registrado, sirve como un vínculo entre las anotaciones de campo y el registro biológico. No es el mismo catalogNumber, el cual es usualmente asignado una vez el espécimen ingresa a la colección.</p>
            </details>
        </label>
        <input type="number" id="recordNumber" name="recordNumber">

        <label for="recordedBy">Recolector
            <span class="espanol">Recorded By</span>
            <details>
                <summary>+info</summary>
                <p>"Una lista (en una fila continua y separada por una barra vertical "" | "") de los nombres de las personas (observadores o recolectores) responsables de realizar el registro.
                El colector u observador principal, especialmente si está asociado al recordNumber tomado en campo, se debe listar en primer lugar. Se debe mantener el mismo formato del nombre a lo largo de todos los registros y se recomienda evitar el uso de solo iniciales ya que esto genera ambigüedades para reconocer a las personas que realizaron el registro, de ser posible siempre escriba nombres completos. Documente el nombre de las personas y evite documentar nombres de grupos u organizaciones."</p>
            </details>
        </label>
        <input type="text" id="recordedBy" name="recordedby">

        <label for="eventDate">Fecha del evento
            <span class="espanol">Event Date</span>
            <details>
                <summary>+info</summary>
                <p>La fecha o el intervalo durante el cual se produjo el evento de observación o colecta de un organismo o muestra.</p>
            </details>
        </label>
        <input type="date" id="eventDate" name="eventDate">

        <label for="habitat">Hábitat
            <span class="espanol">Habitat</span>
            <details>
                <summary>+info</summary>
                <p>Una categoría estandarizada o la descripción del hábitat en el que ocurrió el evento.</p>
            </details>
        </label>
        <input type="text" id="habitat" name="habitat">

        <label for="country">País
            <span class="espanol">Country</span>
            <details>
                <summary>+info</summary>
                <p>"El nombre del país o unidad administrativa de mayor jerarquía de la ubicación."</p>
            </details>
        </label>
        <input type="text" id="country" name="country">

        <label for="stateProvince">Departamento
            <span class="espanol">State/Province</span>
            <details>
                <summary>+info</summary>
                <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que País de la ubicación (Departamento). Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola).</p>
            </details>
        </label>
        <input type="text" id="stateProvince" name="stateProvince">

        <label for="county">Municipio
            <span class="espanol">County</span>
            <details>
                <summary>+info</summary>
                <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que Departamento de la ubicación (Municipio). Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola)."</p>
            </details>
        </label>
        <input type="text" id="county" name="county">

        <label for="municipality">Corregimiento
            <span class="espanol">Municipality</span>
            <details>
                <summary>+info</summary>
                <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que Municipio de la ubicación. Puede ser un centro poblado, cabecera municipal, corregimiento o inspección de policía. No utilice este elemento para el nombre de un lugar cercano que no contiene la ubicación real. Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola)."</p>
            </details>
        </label>
        <input type="text" id="municipality" name="municipality">

        <label for="locality">Localidad
            <span class="espanol">Locality</span>
            <details>
                <summary>+info</summary>
                <p>La información geográfica más específica de la ubicación. Información geográfica de menor especificidad puede ser provista en otros elementos geográficos (higherGeography, continent, country, stateProvince, county, municipality, waterBody, island, islandGroup). Este elemento puede contener información modificada de la original para corregir errores o estandarizar la descripción.</p>
            </details>
        </label>
        <input type="text" id="locality" name="locality">

        <label for="minimumElevationInMeters">Elevación mínima en metros
            <span class="espanol">Minimum Elevation in Meters</span>
            <details>
                <summary>+info</summary>
                <p>El límite inferior del rango de elevación (altitud, generalmente por encima del nivel del mar), no utilice ningún indicador de unidad (metros, m, msnm) ya que el elemento especifica que los valores anotados son en metros.</p>
            </details>
        </label>
        <input type="number" id="minimumElevationInMeters" name="minimumElevationInMeters">

        <label for="maximumElevationInMeters">Elevación máxima en metros
            <span class="espanol">Maximum Elevation in Meters</span>
            <details>
                <summary>+info</summary>
                <p>El límite superior del rango de elevación (altitud, generalmente por encima del nivel del mar), no utilice ningún indicador de unidad (metros, m, msnm) ya que el elemento especifica que los valores anotados son en metros.</p>
            </details>
        </label>
        <input type="number" id="maximumElevationInMeters" name="maximumElevationInMeters">
            
        <label for="verbatimLatitude">Latitud exacta
            <span class="espanol">Verbatim Latitude</span>
            <details>
                <summary>+info</summary>
                <p>La latitud original de la ubicación. El elipsoide de coordenadas, el datum geodésico o el sistema de referencia espacial completo (SRS) para estas coordenadas debe ser documentado en el elemento verbatimSRS, y el sistema de coordenadas en el elemento verbatimCoordinateSystem.</p>
            </details>
        </label>
        <input type="text" id="verbatimLatitude" name="verbatimLatitude">

        <label for="verbatimLongitude">Longitud exacta
            <span class="espanol">Verbatim Longitude</span>
            <details>
                <summary>+info</summary>
                <p>La longitud original de la ubicación. El elipsoide de coordenadas, datum geodésico o el sistema de referencia espacial completo (SRS) para estas coordenadas, debe ser documentado en el elemento verbatimSRS y el sistema de coordenadas en el elemento verbatimCoordinateSystem.</p>
            </details>
        </label>
        <input type="text" id="verbatimLongitude" name="verbatimLongitude">

        <label for="decimalLatitude">Latitud decimal
            <span class="espanol">Decimal Latitude</span>
            <details>
                <summary>+info</summary>
                <p>La latitud geográfica (en grados decimales, utilizando el sistema de referencia espacial provisto en geodeticDatum) del centro geográfico de una ubicación. Los valores positivos se encuentran al norte del ecuador, los valores negativos están al sur del mismo. Los valores admitidos se encuentran entre -90 y 90.</p>
            </details>
        </label>
        <input type="text" id="decimalLatitude" name="decimalLatitude">

        <label for="decimalLongitude">Longitud decimal
            <span class="espanol">Decimal Longitude</span>
            <details>
                <summary>+info</summary>
                <p>La longitud geográfica (en grados decimales, mediante el sistema de referencia espacial provisto en geodeticDatum) del centro geográfico de una ubicación. Los valores positivos se encuentran al este del meridiano de Greenwich, los valores negativos se encuentran al oeste de la misma. Los valores admitidos se encuentran entre -180 y 180.</p>
            </details>
        </label>
        <input type="text" id="decimalLongitude" name="decimalLongitude">

        <label for="geodeticDatum">Datum geodésico
            <span class="espanol">Geodetic Datum</span>
            <details>
                <summary>+info</summary>
                <p>"El elipsoide, datum geodésico, o sistema de referencia espacial (SRS) en el que se basan las coordenadas geográficas provistas en decimalLatitude y decimalLongitude. Se recomienda usar el código EPSG, si se conoce. Caso contrario, utilice un lenguaje controlado para el nombre o código del datum geodésico, o utilice un lenguaje controlado para el nombre o código del elipsoide, si se conoce. Si ninguno de estos se conoce, utilice el valor ""Desconocido"".
                Aunque el estándar no es restrictivo en el datum a usar, desde el SiB Colombia se recomienda documentar las coordenadas decimales usando el datum WGS84 dado que facilita la espacialización de los datos publicados por diferentes organizaciones bajo un mismo sistema de referencia espacial, lo que minimiza el riesgo de desplazamiento de las coordenadas."</p>
            </details>
        </label>
        <input type="text" id="geodeticDatum" name="geodeticDatum">

        <label for="identifiedBy">Identificado por
            <span class="espanol">Identified By</span>
            <details>
                <summary>+info</summary>
                <p>"Una lista (en una fila continua y separada por una barra vertical "" | "") de los nombres de las personas responsables de identificar el organismo. </p>
            </details>
        </label>
        <input type="text" id="identifiedBy" name="identifiedBy">

        <label for="dateIdentified">Fecha de identificación
            <span class="espanol">Date Identified</span>
            <details>
                <summary>+info</summary>
                <p>La fecha o el intervalo durante el cual  fue identificado taxonómicamente la observación, colecta o muestra.</p>
            </details>
        </label>
        <input type="date" id="dateIdentified" name="dateIdentified">

        <label for="scientificName">Nombre Cientifico
            <span class="espanol">Scientific Name</span>
            <details>
                <summary>+info</summary>
                <p>"El nombre científico canónico (sin la autoría) correspondiente a la categoría taxonómica a la que se logró la determinación del organismo observado o colectado."</p>
            </details>
        </label>
        <input type="text" id="scientificName" name="scientificName">

        <label for="identificationQualifier">identificación Calificador
            <span class="espanol">identificationQualifier</span>
            <details>
                <summary>+info</summary>
                <p>"El grado de incertidumbre de la identificación puede indicarse agregando varios términos, como aff. y cf. al nombre científico. El calificador se aplica a la parte del nombre que sigue inmediatamente al calificador y se pueden colocar delante de cualquier elemento del nombre.

                cf.  del latín confer significa comparado con. Su uso indica que no hay certeza de la identidad de la especie (o rango taxonómico superior) hasta que se pueda hacer una comparación más detallada, por ejemplo, con algún tipo o material de referencia. 

                aff. del latín affinis significa similar o limítrofe. Su uso indica que el material o la evidencia disponible sugiere que la especie propuesta está relacionada, tiene afinidad, pero no es idéntica, a la especie o taxón que le sigue.

                Documente este elemento de acuerdo a las siguientes explicaciones:

                cf. agrifolia  (Para Quercus cf. agrifolia, con valores acompañantes scientificName: Quercus , genus: Quercus, taxonRank: Género.) 

                aff. Sparassidae (Para aff. Sparassidae, con valores acompañantes  scientificName: Araneae, order: Araneae, taxonRank: Orden.)"</p>
            </details>
        </label>
        <input type="text" id="identificationQualifier" name="identificationQualifier">

        <label for="reproductiveCondition">condición reproductiva
            <span class="espanol">Reproductive Condition</span>
            <details>
                <summary>+info</summary>
                <p>Condición reproductiva de el(los) organismo(s) en el momento del registro. Se recomienda el uso de un vocabulario controlado.</p>
            </details>
        </label>
        <input type="text" id="reproductiveCondition" name="reproductiveCondition">

        <label for="ocurrenceRemarks">Observaciones de ocurrencia
            <span class="espanol">Occurrence Remarks</span>
            <details>
                <summary>+info</summary>
                <p>Comentarios o anotaciones sobre el registro biológico. Se recomienda que la longitud de la descripción no supere 20 palabras.</p>
            </details>
        </label>
        <input type="text" id="ocurrenceRemarks" name="ocurrenceRemarks">

        <label for="kingdom">Reino
            <span class="espanol">Kingdom</span>
            <details>
                <summary>+info</summary>
                <p>El nombre científico completo del reino al que pertenece el taxón.</p>
            </details>
        </label>
        <input type="text" id="kingdom" name="kingdom">

        <label for="class">Clase
            <span class="espanol">Class</span>
            <details>
                <summary>+info</summary>
                <p>El nombre científico completo de la clase al que pertenece el taxón.</p>
            </details>
        </label>
        <input type="text" id="class" name="class">

        <label for="order">Orden
            <span class="espanol">Order</span>
            <details>
                <summary>+info</summary>
                <p>El nombre científico completo del orden al que pertenece el taxón.</p>
            </details>
        </label>
        <input type="text" id="order" name="orderr">

        <label for="family">Familia
            <span class="espanol">Family</span>
            <details>
                <summary>+info</summary>
                <p>El nombre científico completo de la familia al que pertenece el taxón.</p>
            </details>
        </label>
        <input type="text" id="family" name="family">

        <label for="genus">Género
            <span class="espanol">Genus</span>
            <details>
                <summary>+info</summary>
                <p>El nombre científico completo del género al que pertenece el taxón.</p>
            </details>
        </label>
        <input type="text" id="genus" name="genus">

        <label for="specificEpithet">Epíteto específico
            <span class="espanol">Specific Epithet</span>
            <details>
                <summary>+info</summary>
                <p>El nombre del epíteto específico presente en el scientificName cuando la determinación se hizo hasta especie u otra categoría menor.</p>
            </details>
        </label>
        <input type="text" id="specificEpithet" name="specificEpithet">


        <label for="taxonRank">Peligro de extinción
            <span class="espanol">Taxon Rank</span>
            <details>
                <summary>+info</summary>
                <p>La categoría taxonómica del nombre más específico presente en el scientificName. Se recomienda el uso del vocabulario sugerido disponible para este elemento.</p>
            </details>
        </label>
        <input type="text" id="taxonRank" name="taxonRank">    

        <label for="scientificNameAuthorship">Autoría del nombre científico
            <span class="espanol">Scientific Name Authorship</span>
            <details>
                <summary>+info</summary>
                <p>La información de autoría correspondiente al scientificName, usando el formato acorde a las convenciones del Código Nomenclatural aplicable.</p>
            </details>
        </label>
        <input type="text" id="scientificNameAuthorship" name="scientificNameAuthorship">

        <label for="id_usuario ">id usuario
            <span class="espanol">codigo de usuario</span>
            <details>
                <summary>+info</summary>
                <p>Ingresa el numero de ID de usuario asignado</p>
            </details>
        </label>
        <input type="number" id="id_usuario " name="id_usuario">
    
            <!-- Botón de envío -->
            <input type="submit" name="enviarEjemplar" value = "💾 Enviar"></input>
        </form>
        
    </main>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2025 Herbario Catatumbo Sarare - HECASA. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
