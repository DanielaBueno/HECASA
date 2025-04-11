
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Ejemplar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-responsive.css">
    <link rel="stylesheet" href="css/editar-ejemplar.css">
</head>
<body>
<!-- Navegación -->
<nav>
    <div id="inicio">
        <img src="Media/logo.png" alt="Logo" style="width: 35px; height: auto;">
    </div>

    <a href="coleccion-general-ad.php">
        <button id="btn-coleccion-general">Coleccion General</button>
    </a>
    
    <a href="ingreso-ejemplar-ad.php">
        <button id="btn-ingreso-datos">Ingreso de Datos</button>
    </a>
    
    <a href="admi-usuarios-ad.php">
        <button id="btn-usuarios">Usuarios</button>
    </a>
    
    <a href="copia-seguridad-ad.php">
        <button id="btn-copia-seguridad">Copia de Seguridad</button>
    </a>
    
    <div id="fin">
        <a href="notificaciones-ad.php">
            <button id="btn-notificaciones">🔔</button>
        </a>
        
        <a href="PHP/boton_cerrarSesionFUNTION.php">
            <button id="btn-salir">Salir</button>
        </a>
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
    <?php
        include ("PHP/editar-eliminar-ejemplarFUNTION.php");
    ?>

    <header>
        <h2 >Detalles del Ejemplar del Herbario</h2>
        <a href="detalles-ejemplar-ad.php?id=<?= htmlspecialchars($ejemplar['id_ejemplar']); ?>">
            <button class="btn_detalles">↩️ Volver a Ejemplar</button>
        </a>
    </header>


    <main>
        <form method="post">
            <input type="hidden" name="id" value="<?= $ejemplar['id_ejemplar'] ?? ''; ?>">
            
            <label for="institutionCode">Código de institución
                <span class="espanol">Institution Code</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre completo de la institución que custodia el espécimen o la información del registro; seguido por su acrónimo en paréntesis, si tiene.</p>
                </details>
            </label>
            <input type="text" name="institutionCode" value="<?= $ejemplar['institutionCode'] ?? ''; ?>"><br>
            
            <label for="collectionCode">Código de colección
                <span class="espanol">Collection Code</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre, acrónimo, código alfanumérico, o iniciales que identifican la colección o conjunto de datos del que procede el organismo. </p>
                </details>
            </label>
            <input type="text" name="collectionCode" value="<?= $ejemplar['collectionCode'] ?? ''; ?>"><br>
            
            <label for="recordNumber">Número de registro
                <span class="espanol">Record Number</span>
                <details>
                    <summary>+info</summary>
                    <p>Un identificador dado al registro biológico en el momento en que fue registrado, sirve como un vínculo entre las anotaciones de campo y el registro biológico. No es el mismo catalogNumber, el cual es usualmente asignado una vez el espécimen ingresa a la colección.</p>
                </details>
            </label>
            <input type="text" name="recordNumber" value="<?= $ejemplar['recordNumber'] ?? ''; ?>"><br>
            
            <label for="recordedBy">Recolector
                <span class="espanol">Recorded By</span>
                <details>
                    <summary>+info</summary>
                    <p>"Una lista (en una fila continua y separada por una barra vertical "" | "") de los nombres de las personas (observadores o recolectores) responsables de realizar el registro.
                    El colector u observador principal, especialmente si está asociado al recordNumber tomado en campo, se debe listar en primer lugar. Se debe mantener el mismo formato del nombre a lo largo de todos los registros y se recomienda evitar el uso de solo iniciales ya que esto genera ambigüedades para reconocer a las personas que realizaron el registro, de ser posible siempre escriba nombres completos. Documente el nombre de las personas y evite documentar nombres de grupos u organizaciones."</p>
                </details>
            </label>
            <input type="text" name="recordedby" value="<?= $ejemplar['recordedby'] ?? ''; ?>"><br>
            
            <label for="eventDate">Fecha del evento
                <span class="espanol">Event Date</span>
                <details>
                    <summary>+info</summary>
                    <p>La fecha o el intervalo durante el cual se produjo el evento de observación o colecta de un organismo o muestra.</p>
                </details>
            </label>
            <input type="date" name="eventDate" value="<?= $ejemplar['eventDate'] ?? ''; ?>"><br>
            
            <label for="habitat">Hábitat
                <span class="espanol">Habitat</span>
                <details>
                    <summary>+info</summary>
                    <p>Una categoría estandarizada o la descripción del hábitat en el que ocurrió el evento.</p>
                </details>
            </label>
            <input type="text" name="habitat" value="<?= $ejemplar['habitat'] ?? ''; ?>"><br>
            
            <label for="country">País
                <span class="espanol">Country</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre del país o unidad administrativa de mayor jerarquía de la ubicación."</p>
                </details>
            </label>
            <input type="text" name="country" value="<?= $ejemplar['country'] ?? ''; ?>"><br>
            
            <label for="stateProvince">Departamento
                <span class="espanol">State/Province</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que País de la ubicación (Departamento). Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola).</p>
                </details>
            </label>
            <input type="text" name="stateProvince" value="<?= $ejemplar['stateProvince'] ?? ''; ?>"><br>

            <label for="county">Municipio
                <span class="espanol">County</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que Departamento de la ubicación (Municipio). Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola)."</p>
                </details>
            </label>
            <input type="text" name="county" value="<?= $ejemplar['county'] ?? ''; ?>"><br>
            
            <label for="municipality">Corregimiento
                <span class="espanol">Municipality</span>
                <details>
                    <summary>+info</summary>
                    <p>"El nombre completo y sin abreviar de la siguiente región administrativa de menor jerarquía que Municipio de la ubicación. Puede ser un centro poblado, cabecera municipal, corregimiento o inspección de policía. No utilice este elemento para el nombre de un lugar cercano que no contiene la ubicación real. Se recomienda usar los nombres asignados en la División Política Administrativa de Colombia - DANE, (http://www.dane.gov.co/Divipola)."</p>
                </details>
            </label>
            <input type="text" name="municipality" value="<?= $ejemplar['municipality'] ?? ''; ?>"><br>
            
            <label for="locality">Localidad
                <span class="espanol">Locality</span>
                <details>
                    <summary>+info</summary>
                    <p>La información geográfica más específica de la ubicación. Información geográfica de menor especificidad puede ser provista en otros elementos geográficos (higherGeography, continent, country, stateProvince, county, municipality, waterBody, island, islandGroup). Este elemento puede contener información modificada de la original para corregir errores o estandarizar la descripción.</p>
                </details>
            </label>
            <input type="text" name="locality" value="<?= $ejemplar['locality'] ?? ''; ?>"><br>
            
            <label for="minimumElevationInMeters">Elevación mínima en metros
                <span class="espanol">Minimum Elevation in Meters</span>
                <details>
                    <summary>+info</summary>
                    <p>El límite inferior del rango de elevación (altitud, generalmente por encima del nivel del mar), no utilice ningún indicador de unidad (metros, m, msnm) ya que el elemento especifica que los valores anotados son en metros.</p>
                </details>
            </label>
            <input type="number" name="minimumElevationInMeters" value="<?= $ejemplar['minimumElevationInMeters'] ?? ''; ?>"><br>
            
            <label for="maximumElevationInMeters">Elevación máxima en metros
                <span class="espanol">Maximum Elevation in Meters</span>
                <details>
                    <summary>+info</summary>
                    <p>El límite superior del rango de elevación (altitud, generalmente por encima del nivel del mar), no utilice ningún indicador de unidad (metros, m, msnm) ya que el elemento especifica que los valores anotados son en metros.</p>
                </details>
            </label>
            <input type="number" name="maximumElevationInMeters" value="<?= $ejemplar['maximumElevationInMeters'] ?? ''; ?>"><br>
            
            <label for="verbatimLatitude">Latitud exacta
                <span class="espanol">Verbatim Latitude</span>
                <details>
                    <summary>+info</summary>
                    <p>La latitud original de la ubicación. El elipsoide de coordenadas, el datum geodésico o el sistema de referencia espacial completo (SRS) para estas coordenadas debe ser documentado en el elemento verbatimSRS, y el sistema de coordenadas en el elemento verbatimCoordinateSystem.</p>
                </details>
            </label>
            <input type="text" name="verbatimLatitude" value="<?= $ejemplar['verbatimLatitude'] ?? ''; ?>"><br>
            
            <label for="verbatimLongitude">Longitud exacta
                <span class="espanol">Verbatim Longitude</span>
                <details>
                    <summary>+info</summary>
                    <p>La longitud original de la ubicación. El elipsoide de coordenadas, datum geodésico o el sistema de referencia espacial completo (SRS) para estas coordenadas, debe ser documentado en el elemento verbatimSRS y el sistema de coordenadas en el elemento verbatimCoordinateSystem.</p>
                </details>
            </label>
            <input type="text" name="verbatimLongitude" value="<?= $ejemplar['verbatimLongitude'] ?? ''; ?>"><br>
            
            <label for="decimalLatitude">Latitud decimal
                <span class="espanol">Decimal Latitude</span>
                <details>
                    <summary>+info</summary>
                    <p>La latitud geográfica (en grados decimales, utilizando el sistema de referencia espacial provisto en geodeticDatum) del centro geográfico de una ubicación. Los valores positivos se encuentran al norte del ecuador, los valores negativos están al sur del mismo. Los valores admitidos se encuentran entre -90 y 90.</p>
                </details>
            </label>
            <input type="number" step="any" name="decimalLatitude" value="<?= $ejemplar['decimalLatitude'] ?? ''; ?>"><br>
            
            <label for="decimalLongitude">Longitud decimal
                <span class="espanol">Decimal Longitude</span>
                <details>
                    <summary>+info</summary>
                    <p>La longitud geográfica (en grados decimales, mediante el sistema de referencia espacial provisto en geodeticDatum) del centro geográfico de una ubicación. Los valores positivos se encuentran al este del meridiano de Greenwich, los valores negativos se encuentran al oeste de la misma. Los valores admitidos se encuentran entre -180 y 180.</p>
                </details>
            </label>
            <input type="number" step="any" name="decimalLongitude" value="<?= $ejemplar['decimalLongitude'] ?? ''; ?>"><br>
            
            <label for="geodeticDatum">Datum geodésico
                <span class="espanol">Geodetic Datum</span>
                <details>
                    <summary>+info</summary>
                    <p>"El elipsoide, datum geodésico, o sistema de referencia espacial (SRS) en el que se basan las coordenadas geográficas provistas en decimalLatitude y decimalLongitude. Se recomienda usar el código EPSG, si se conoce. Caso contrario, utilice un lenguaje controlado para el nombre o código del datum geodésico, o utilice un lenguaje controlado para el nombre o código del elipsoide, si se conoce. Si ninguno de estos se conoce, utilice el valor ""Desconocido"".
                    Aunque el estándar no es restrictivo en el datum a usar, desde el SiB Colombia se recomienda documentar las coordenadas decimales usando el datum WGS84 dado que facilita la espacialización de los datos publicados por diferentes organizaciones bajo un mismo sistema de referencia espacial, lo que minimiza el riesgo de desplazamiento de las coordenadas."</p>
                </details>
            </label>
            <input type="text" name="geodeticDatum" value="<?= $ejemplar['geodeticDatum'] ?? ''; ?>"><br>
            
            <label for="identifiedBy">Identificado por
                <span class="espanol">Identified By</span>
                <details>
                    <summary>+info</summary>
                    <p>"Una lista (en una fila continua y separada por una barra vertical "" | "") de los nombres de las personas responsables de identificar el organismo. </p>
                </details>
            </label>
            <input type="text" name="identifiedBy" value="<?= $ejemplar['identifiedBy'] ?? ''; ?>"><br>
            
            <label for="dateIdentified">Fecha de identificación
                <span class="espanol">Date Identified</span>
                <details>
                    <summary>+info</summary>
                    <p>La fecha o el intervalo durante el cual  fue identificado taxonómicamente la observación, colecta o muestra.</p>
                </details>
            </label>
            <input type="date" name="dateIdentified" value="<?= $ejemplar['dateIdentified'] ?? ''; ?>"><br>
            
            <label for="scientificName">Nombre Cientifico
                <span class="espanol">Scientific Name</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico canónico (sin la autoría) correspondiente a la categoría taxonómica a la que se logró la determinación del organismo observado o colectado.</p>
                </details>
            </label>
            <input type="text" name="scientificName" value="<?= $ejemplar['scientificName'] ?? ''; ?>"><br>
            
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
            <input type="text" name="identificationQualifier" value="<?= $ejemplar['identificationQualifier'] ?? ''; ?>"><br>
            
            <label for="reproductiveCondition">Condición Reproductiva
                <span class="espanol">Reproductive Condition</span>
                <details>
                    <summary>+info</summary>
                    <p>Condición reproductiva de el(los) organismo(s) en el momento del registro. Se recomienda el uso de un vocabulario controlado.</p>
                </details>
            </label>
            <input type="text" name="reproductiveCondition" value="<?= $ejemplar['reproductiveCondition'] ?? ''; ?>"><br>
            
            <label for="ocurrenceRemarks">Observaciones de ocurrencia
                <span class="espanol">Occurrence Remarks</span>
                <details>
                    <summary>+info</summary>
                    <p>Comentarios o anotaciones sobre el registro biológico. Se recomienda que la longitud de la descripción no supere 20 palabras.</p>
                </details>
            </label>
            <input type="text" name="ocurrenceRemarks" value="<?= $ejemplar['ocurrenceRemarks'] ?? ''; ?>"><br>
            
            <label for="kingdom">Reino
                <span class="espanol">Kingdom</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo del reino al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" name="kingdom" value="<?= $ejemplar['kingdom'] ?? ''; ?>"><br>
            
            <label for="class">Clase
                <span class="espanol">Class</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo de la clase al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" name="class" value="<?= $ejemplar['class'] ?? ''; ?>"><br>
            
            <label for="order">Orden
                <span class="espanol">Order</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo del orden al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" name="orderr" value="<?= $ejemplar['orderr'] ?? ''; ?>"><br>
            
            <label for="family">Familia
                <span class="espanol">Family</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo de la familia al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" name="family" value="<?= $ejemplar['family'] ?? ''; ?>"><br>
            
            <label for="genus">Género
                <span class="espanol">Genus</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre científico completo del género al que pertenece el taxón.</p>
                </details>
            </label>
            <input type="text" name="genus" value="<?= $ejemplar['genus'] ?? ''; ?>"><br>
            
            <label for="specificEpithet">Epíteto específico
                <span class="espanol">Specific Epithet</span>
                <details>
                    <summary>+info</summary>
                    <p>El nombre del epíteto específico presente en el scientificName cuando la determinación se hizo hasta especie u otra categoría menor.</p>
                </details>
            </label>
            <input type="text" name="specificEpithet" value="<?= $ejemplar['specificEpithet'] ?? ''; ?>"><br>
            
            <label for="taxonRank">Peligro de extinción
                <span class="espanol">Taxon Rank</span>
                <details>
                    <summary>+info</summary>
                    <p>La categoría taxonómica del nombre más específico presente en el scientificName. Se recomienda el uso del vocabulario sugerido disponible para este elemento.</p>
                </details>
            </label>
            <input type="text" name="taxonRank" value="<?= $ejemplar['taxonRank'] ?? ''; ?>"><br>
            
            <label for="scientificNameAuthorship">Autoría del Nombre Científico
                <span class="espanol">Scientific Name Authorship</span>
                <details>
                    <summary>+info</summary>
                    <p>La información de autoría correspondiente al scientificName, usando el formato acorde a las convenciones del Código Nomenclatural aplicable.</p>
                </details>
            </label>
            <input type="text" name="scientificNameAuthorship" value="<?= $ejemplar['scientificNameAuthorship'] ?? ''; ?>"><br>
        
            
            <input type="submit" name="editar" value="💾 Guardar Cambios">
        </form>
    </main>


</html>