<?php

include "PHP/conexionFUNTION.php"; // Conectar a la base de datos


// Verificar si se pasó un ID de ejemplar en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>window.location = 'coleccion-general-ad.php';</script>";
    exit();
}

$id_ejemplar = $_GET['id'];

// Consulta segura para obtener los datos del ejemplar
$sql = "SELECT * FROM ejemplar WHERE id_ejemplar = ?";
$stmt = $enlace->prepare($sql);
$stmt->bind_param("i", $id_ejemplar);
$stmt->execute();
$resultado = $stmt->get_result();
$ejemplar = $resultado->fetch_assoc();

// Verificar si el ejemplar existe
if (!$ejemplar) {
    echo "<script>alert('El ejemplar no existe'); window.location = 'coleccion-general-ad.php';</script>";
    exit();
}

// Procesar la edición del ejemplar
if (isset($_POST['editar'])) {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo "<script>alert('Error: No se recibió el ID del ejemplar.'); window.location='coleccion-general-ad.php';</script>";
        exit();
    }

    $id = $_POST['id'];
    $institutionCode = $_POST['institutionCode'] ?? '';
    $collectionCode = $_POST['collectionCode'] ?? '';
    $recordNumber = $_POST['recordNumber'] ?? '';
    $recordedBy = $_POST['recordedby'] ?? '';
    $stateProvince = $_POST['stateProvince'] ?? '';
    $eventDate = $_POST['eventDate'] ?? '';
    $habitat = $_POST['habitat'] ?? '';
    $country = $_POST['country'] ?? '';
    $county = $_POST['county'] ?? '';
    $municipality = $_POST['municipality'] ?? '';
    $locality = $_POST['locality'] ?? '';
    $minimumElevationInMeters = isset($_POST['minimumElevationInMeters']) ? (int) $_POST['minimumElevationInMeters'] : NULL;
    $maximumElevationInMeters = isset($_POST['maximumElevationInMeters']) ? (int) $_POST['maximumElevationInMeters'] : NULL;
    $verbatimLatitude = $_POST['verbatimLatitude'] ?? '';
    $verbatimLongitude = $_POST['verbatimLongitude'] ?? '';
    $decimalLatitude = isset($_POST['decimalLatitude']) ? (float) $_POST['decimalLatitude'] : NULL;
    $decimalLongitude = isset($_POST['decimalLongitude']) ? (float) $_POST['decimalLongitude'] : NULL;
    $geodeticDatum = $_POST['geodeticDatum'] ?? '';
    $identifiedBy = $_POST['identifiedBy'] ?? '';
    $dateIdentified = $_POST['dateIdentified'] ?? '';
    $scientificName = $_POST['scientificName'] ?? '';
    $identificationQualifier = $_POST['identificationQualifier'] ?? '';
    $reproductiveCondition = $_POST['reproductiveCondition'] ?? '';
    $ocurrenceRemarks = $_POST['ocurrenceRemarks'] ?? ''; 
    $kingdom = $_POST['kingdom'] ?? '';
    $class = $_POST['class'] ?? '';
    $orderr = $_POST['orderr'] ?? '';
    $family = $_POST['family'] ?? '';
    $genus = $_POST['genus'] ?? '';
    $specificEpithet = $_POST['specificEpithet'] ?? '';
    $taxonRank = $_POST['taxonRank'] ?? '';
    $scientificNameAuthorship = $_POST['scientificNameAuthorship'] ?? '';

    // Consulta segura de actualización
    $sql = "UPDATE ejemplar SET 
        institutionCode=?, collectionCode=?, recordNumber=?, recordedby=?, stateProvince=?, 
        eventDate=?, habitat=?, country=?, county=?, municipality=?, locality=?, 
        minimumElevationInMeters=?, maximumElevationInMeters=?, verbatimLatitude=?, verbatimLongitude=?, 
        decimalLatitude=?, decimalLongitude=?, geodeticDatum=?, identifiedBy=?, dateIdentified=?, 
        scientificName=?, identificationQualifier=?, reproductiveCondition=?, ocurrenceRemarks=?, 
        kingdom=?, class=?, orderr=?, family=?, genus=?, specificEpithet=?, taxonRank=?, 
        scientificNameAuthorship=?
        WHERE id_ejemplar=?";

    $stmt = $enlace->prepare($sql);
    $stmt->bind_param("ssssssssssssddsddssssssssssssssss",
        $institutionCode, $collectionCode, $recordNumber, $recordedBy, $stateProvince, 
        $eventDate, $habitat, $country, $county, $municipality, $locality, 
        $minimumElevationInMeters, $maximumElevationInMeters, $verbatimLatitude, $verbatimLongitude, 
        $decimalLatitude, $decimalLongitude, $geodeticDatum, $identifiedBy, $dateIdentified, 
        $scientificName, $identificationQualifier, $reproductiveCondition, $ocurrenceRemarks, 
        $kingdom, $class, $orderr, $family, $genus, $specificEpithet, $taxonRank, 
        $scientificNameAuthorship, $id
    );

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) { 
            echo "<script>alert('Ejemplar actualizado correctamente'); window.location='detalles-ejemplar-ad.php?id=$id';</script>";
        } else {
            echo "<script>alert('No se realizaron cambios en el ejemplar.'); window.location='detalles-ejemplar-ad.php?id=$id';</script>";
        }
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }
}

// Procesar la eliminación del ejemplar
if (isset($_POST['eliminar'])) {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo "<script>alert('Error: No se recibió el ID del ejemplar.'); window.location='coleccion-general-ad.php';</script>";
        exit();
    }

    $id = $_POST['id'];
    $sql = "DELETE FROM ejemplar WHERE id_ejemplar=?";
    $stmt = $enlace->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Ejemplar eliminado correctamente'); window.location='coleccion-general-ad.php';</script>";
    } else {
        echo "Error al eliminar: " . $stmt->error;
    }
}

// Cerrar conexión a la base de datos
$enlace->close();
?>
