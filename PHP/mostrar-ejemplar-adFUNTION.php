<?php

include "conexionFUNTION.php";
if ($enlace){
    echo "conexion correcta";
}else{
    echo "conexion incorrecta";
}

$sql = "SELECT * FROM ejemplar";
$resultado = mysqli_query($enlace, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "<h1>Los usuarios son:</h1>";
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "ID Ejemplar: " . $fila['id_ejemplar'] . " - institutionCode: " . $fila['institutionCode'] . 
            " - recordNumber: " . $fila['recordNumber'] . " - recordedby: " . $fila['recordedby'] . " - stateProvince: " . $fila['stateProvince'] . " - eventDate: " . $fila['eventDate'] . " - habitat: " . $fila['habitat'] . " - country: " . $fila['country'] . " - county: " . $fila['county'] . " - municipality: " . $fila['municipality'] . " - locality: " . $fila['locality'] . " - minimumElevationInMeters: " . $fila['minimumElevationInMeters'] . " - maximumElevationInMeters: " . $fila['maximumElevationInMeters'] . " - verbatimLatitude: " . $fila['verbatimLatitude'] . " - decimalLatitude: " . $fila['decimalLatitude'] . " - decimalLongitude: " . $fila['decimalLongitude'] . " - decimalLatitude: " . $fila['decimalLatitude'] . " - decimalLongitude: " . $fila['decimalLongitude'] . " - geodeticDatum: " . $fila['geodeticDatum'] . " - identifiedBy: " . $fila['identifiedBy'] . " - dateIdentified: " . $fila['dateIdentified'] . " - scientificName: " . $fila['scientificName'] . " - identificationQualifier: " . $fila['identificationQualifier'] . " - reproductiveCondition: " . $fila['reproductiveCondition'] . " - ocurrenceRemarks: " . $fila['ocurrenceRemarks'] . " - kingdom: " . $fila['kingdom'] . " - class: " . $fila['class'] . " - orderr: " . $fila['orderr'] . " - family: " . $fila['family'] . " - genus: " . $fila['genus'] . " - specificEpithet: " . $fila['specificEpithet'] . " - taxonRank: " . $fila['taxonRank'] . " - scientificNameAuthorship: " . $fila['scientificNameAuthorship'] . "<br>";
    }
} else {
    echo "<h1>No se han encontrado usuarios.</h1>";
}

mysqli_close($enlace);

?>