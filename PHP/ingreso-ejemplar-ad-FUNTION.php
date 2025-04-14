<?php

    include("conexionFUNTION.php");

    if (isset($_POST["enviarEjemplar"])) {
        // Validar que los campos obligatorios no estén vacíos
        if (strlen($_POST['catalogNumber']) && 
            strlen($_POST['institutionCode']) && 
            strlen($_POST['collectionCode']) && 
            strlen($_POST['recordNumber']) && 
            strlen($_POST['recordedby']) &&
            strlen($_POST['eventDate']) && 
            strlen($_POST['habitat']) &&
            strlen($_POST['country']) &&
            strlen($_POST['stateProvince']) &&
            strlen($_POST['county']) &&
            strlen($_POST['municipality']) &&
            strlen($_POST['locality']) &&
            strlen($_POST['minimumElevationInMeters']) &&
            strlen($_POST['maximumElevationInMeters']) &&
            strlen($_POST['verbatimLatitude']) &&
            strlen($_POST['verbatimLongitude']) &&
            strlen($_POST['decimalLatitude']) &&
            strlen($_POST['decimalLongitude']) &&
            strlen($_POST['geodeticDatum']) &&
            strlen($_POST['identifiedBy']) &&
            strlen($_POST['dateIdentified']) &&
            strlen($_POST['scientificName']) &&
            strlen($_POST['identificationQualifier']) &&
            strlen($_POST['reproductiveCondition']) &&
            strlen($_POST['ocurrenceRemarks']) &&
            strlen($_POST['kingdom']) &&
            strlen($_POST['class']) &&
            strlen($_POST['orderr']) &&
            strlen($_POST['family']) &&
            strlen($_POST['genus']) &&
            strlen($_POST['specificEpithet']) &&
            strlen($_POST['taxonRank']) &&
            strlen($_POST['scientificNameAuthorship']) &&
            strlen($_POST['id_usuario'])) {

            // Guardar los datos en variables
                $catalogNumber = $_POST["catalogNumber"];
                $institutionCode = $_POST["institutionCode"];
                $collectionCode = $_POST["collectionCode"];
                $recordNumber = $_POST["recordNumber"];
                $recordedby = $_POST["recordedby"];
                $eventDate = $_POST["eventDate"];
                $habitat = $_POST["habitat"];
                $country = $_POST["country"];
                $stateProvince = $_POST["stateProvince"];
                $county = $_POST["county"];
                $municipality = $_POST["municipality"];
                $locality = $_POST["locality"];
                $minimumElevationInMeters = $_POST["minimumElevationInMeters"];
                $maximumElevationInMeters = $_POST["maximumElevationInMeters"];
                $verbatimLatitude = $_POST["verbatimLatitude"];
                $verbatimLongitude = $_POST["verbatimLongitude"];
                $decimalLatitude = $_POST["decimalLatitude"];
                $decimalLongitude = $_POST["decimalLongitude"];
                $geodeticDatum = $_POST["geodeticDatum"];
                $identifiedBy = $_POST["identifiedBy"];
                $dateIdentified = $_POST["dateIdentified"];
                $scientificName = $_POST["scientificName"];
                $identificationQualifier = $_POST["identificationQualifier"];
                $reproductiveCondition = $_POST["reproductiveCondition"];
                $ocurrenceRemarks = $_POST["ocurrenceRemarks"];
                $kingdom = $_POST["kingdom"];
                $class = $_POST["class"];
                $orderr = $_POST["orderr"];
                $family = $_POST["family"];
                $genus = $_POST["genus"];
                $specificEpithet = $_POST["specificEpithet"];
                $taxonRank = $_POST["taxonRank"];
                $scientificNameAuthorship = $_POST["scientificNameAuthorship"];
                $id_usuario = $_POST["id_usuario"];


                $verificarEjemplar = mysqli_query($enlace, "SELECT * FROM ejemplar WHERE id_ejemplar = '$catalogNumber'");
                
                if (mysqli_num_rows($verificarEjemplar) > 0) {
                    echo "<h3 class='error'>Error: El código de usuario ya existe.</h3>";
                }
                else {
                    // Insertar datos en la base de datos
                    $registro = "INSERT INTO ejemplar (
                        id_ejemplar, institutionCode, collectionCode, recordNumber, recordedby, 
                        eventDate, habitat, country, stateProvince, county, municipality, locality, 
                        minimumElevationInMeters, maximumElevationInMeters, verbatimLatitude, verbatimLongitude, 
                        decimalLatitude, decimalLongitude, geodeticDatum, identifiedBy, dateIdentified, 
                        scientificName, identificationQualifier, reproductiveCondition, ocurrenceRemarks, 
                        kingdom, class, orderr, family, genus, specificEpithet, taxonRank, scientificNameAuthorship, id_usuario
                    ) VALUES ( 
                        '$catalogNumber', '$institutionCode', '$collectionCode', '$recordNumber', '$recordedby', 
                        '$eventDate', '$habitat', '$country', '$stateProvince', '$county', '$municipality', '$locality', 
                        '$minimumElevationInMeters', '$maximumElevationInMeters', '$verbatimLatitude', '$verbatimLongitude', 
                        '$decimalLatitude', '$decimalLongitude', '$geodeticDatum', '$identifiedBy', '$dateIdentified', 
                        '$scientificName', '$identificationQualifier', '$reproductiveCondition', '$ocurrenceRemarks',
                        '$kingdom', '$class', '$orderr', '$family', '$genus', '$specificEpithet', '$taxonRank', 
                        '$scientificNameAuthorship', '$id_usuario'
                    )";
    
                    $resultado = mysqli_query($enlace, $registro);
    
                    // Verificar si se guardó correctamente
                    if ($resultado) {
    
                        echo "<h3 class='bien'>Registro exitoso.</h3>";
                    } else {
    
                        echo "<h3 class='error'>Error: No se pudo lograr el registro.</h3>";
                    }
                }
        } 
        else {
            
            echo "<h3 class='error'>Error: Campos vacíos.</h3>";

        }
    }
?>

<script>
    // Evita que el formulario se reenvíe al recargar la página
    history.replaceState(null, null, location.pathname);
</script>
