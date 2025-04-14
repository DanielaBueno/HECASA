<?php
ob_start(); // Iniciar buffer de salida para evitar errores de salida antes del PDF

require('conexionFUNTION.php'); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!class_exists('FPDF')) {
    require_once '../fpdf/fpdf.php';
}

// Conectar y capturar los filtros de búsqueda
$id_ejemplar = isset($_GET['id_ejemplar']) ? trim($_GET['id_ejemplar']) : "";
$scientificName = isset($_GET['scientificName']) ? trim($_GET['scientificName']) : "";
$county = isset($_GET['county']) ? trim($_GET['county']) : "";
$recordedby = isset($_GET['recordedby']) ? trim($_GET['recordedby']) : "";

// Construcción de consulta dinámica con filtros
$where = "WHERE 1=1"; // Garantiza que la consulta sea válida incluso sin filtros

$params = [];
$types = "";

if (!empty($id_ejemplar)) {
    $where .= " AND id_ejemplar LIKE ?";
    $params[] = "%$id_ejemplar%";
    $types .= "s";
}
if (!empty($scientificName)) {
    $where .= " AND scientificName LIKE ?";
    $params[] = "%$scientificName%";
    $types .= "s";
}
if (!empty($county)) {
    $where .= " AND county LIKE ?";
    $params[] = "%$county%";
    $types .= "s";
}
if (!empty($recordedby)) {
    $where .= " AND recordedby LIKE ?";
    $params[] = "%$recordedby%";
    $types .= "s";
}

// Preparar la consulta SQL con los filtros aplicados
$sql = "SELECT * FROM ejemplar $where";
$stmt = $enlace->prepare($sql);

// Si hay parámetros, se vinculan a la consulta
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("No se encontraron ejemplares con los filtros aplicados.");
}

// Crear PDF
$pdf = new FPDF();
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetMargins(10, 10, 10);

while ($fila = $resultado->fetch_assoc()) {
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(190, 10, "Ejemplar - ID: " . $fila['id_ejemplar'], 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 12);

    $campos = [
        "Institution Code" => $fila['institutionCode'],
        "Collection Code" => $fila['collectionCode'],
        "Record Number" => $fila['recordNumber'],
        "Recorded By" => $fila['recordedby'],
        "Event Date" => $fila['eventDate'],
        "Habitat" => $fila['habitat'],
        "Country" => $fila['country'],
        "State Province" => $fila['stateProvince'],
        "County" => $fila['county'],
        "Municipality" => $fila['municipality'],
        "Locality" => $fila['locality'],
        "Min Elevation (m)" => $fila['minimumElevationInMeters'],
        "Max Elevation (m)" => $fila['maximumElevationInMeters'],
        "Verbatim Latitude" => $fila['verbatimLatitude'],
        "Verbatim Longitude" => $fila['verbatimLongitude'],
        "Decimal Latitude" => $fila['decimalLatitude'],
        "Decimal Longitude" => $fila['decimalLongitude'],
        "Geodetic Datum" => $fila['geodeticDatum'],
        "Identified By" => $fila['identifiedBy'],
        "Date Identified" => $fila['dateIdentified'],
        "Scientific Name" => $fila['scientificName'],
        "Identification Qualifier" => $fila['identificationQualifier'],
        "Reproductive Condition" => $fila['reproductiveCondition'],
        "Occurrence Remarks" => $fila['ocurrenceRemarks'],
        "Kingdom" => $fila['kingdom'],
        "Class" => $fila['class'],
        "Order" => $fila['orderr'],
        "Family" => $fila['family'],
        "Genus" => $fila['genus'],
        "Specific Epithet" => $fila['specificEpithet'],
        "Taxon Rank" => $fila['taxonRank'],
        "Scientific Name Authorship" => $fila['scientificNameAuthorship'],
        "ID Usuario" => $fila['id_usuario'],
    ];

    // Establecer un ancho fijo para la columna A
    $columnWidthA = 55;
    // Establecer un ancho fijo para la columna B 
    $columnWidthB = 135;  

    foreach ($campos as $nombreCampo => $valorCampo) {
        $pdf->Cell($columnWidthA, 7, mb_convert_encoding($nombreCampo . ":", 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');

        $pdf->MultiCell($columnWidthB, 7, mb_convert_encoding($valorCampo, 'ISO-8859-1', 'UTF-8'), 1, 'L');
    }

    $pdf->Ln(0);
}

ob_end_clean(); // Limpia cualquier salida previa
$pdf->Output("I", "reporte_ejemplares.pdf");
exit();
?>
