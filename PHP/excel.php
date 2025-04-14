<?php
include("conexionFUNTION.php");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte.xls");

$id_ejemplar = isset($_GET['id_ejemplar']) ? trim($_GET['id_ejemplar']) : "";
$scientificName = isset($_GET['scientificName']) ? trim($_GET['scientificName']) : "";
$county = isset($_GET['county']) ? trim($_GET['county']) : "";
$recordedby = isset($_GET['recordedby']) ? trim($_GET['recordedby']) : "";

$where = "WHERE 1=1"; 

if (!empty($id_ejemplar)) {
    $where .= " AND id_ejemplar LIKE '%" . mysqli_real_escape_string($enlace, $id_ejemplar) . "%'";
}
if (!empty($scientificName)) {
    $where .= " AND scientificName LIKE '%" . mysqli_real_escape_string($enlace, $scientificName) . "%'";
}
if (!empty($county)) {
    $where .= " AND county LIKE '%" . mysqli_real_escape_string($enlace, $county) . "%'";
}
if (!empty($recordedby)) {
    $where .= " AND recordedby LIKE '%" . mysqli_real_escape_string($enlace, $recordedby) . "%'";
}

$query = "SELECT id_ejemplar, institutionCode, collectionCode, recordNumber, recordedby, 
                eventDate, habitat, country, stateProvince, county, municipality, locality, 
                minimumElevationInMeters, maximumElevationInMeters, verbatimLatitude, verbatimLongitude,
                decimalLatitude, DecimalLongitude, geodeticDatum, identifiedBy, dateIdentified, 
                scientificName, identificationQualifier, reproductiveCondition, ocurrenceRemarks, 
                kingdom, class, orderr, family, genus, specificEpithet, taxonRank, 
                scientificNameAuthorship, id_usuario 
          FROM ejemplar $where";

$result = mysqli_query($enlace, $query);
if (!$result) {
    die("Error en la consulta: " . mysqli_error($enlace));
}

echo "<table border='1'>";
echo "<tr>
        <th>ID Ejemplar</th>
        <th>Institution Code</th>
        <th>Collection Code</th>
        <th>Record Number</th>
        <th>Recorded By</th>
        <th>Event Date</th>
        <th>Habitat</th>
        <th>Country</th>
        <th>State Province</th>
        <th>County</th>
        <th>Municipality</th>
        <th>Locality</th>
        <th>Min Elevation (m)</th>
        <th>Max Elevation (m)</th>
        <th>Verbatim Latitude</th>
        <th>Verbatim Longitude</th>
        <th>Decimal Latitude</th>
        <th>Decimal Longitude</th>
        <th>Geodetic Datum</th>
        <th>Identified By</th>
        <th>Date Identified</th>
        <th>Scientific Name</th>
        <th>Identification Qualifier</th>
        <th>Reproductive Condition</th>
        <th>Occurrence Remarks</th>
        <th>Kingdom</th>
        <th>Class</th>
        <th>Order</th>
        <th>Family</th>
        <th>Genus</th>
        <th>Specific Epithet</th>
        <th>Taxon Rank</th>
        <th>Scientific Name Authorship</th>
        <th>ID Usuario</th>
    </tr>";


while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>" . htmlspecialchars($row['id_ejemplar']) . "</td>
            <td>" . htmlspecialchars($row['institutionCode']) . "</td>
            <td>" . htmlspecialchars($row['collectionCode']) . "</td>
            <td>" . htmlspecialchars($row['recordNumber']) . "</td>
            <td>" . htmlspecialchars($row['recordedby']) . "</td>
            <td>" . htmlspecialchars($row['eventDate']) . "</td>
            <td>" . htmlspecialchars($row['habitat']) . "</td>
            <td>" . htmlspecialchars($row['country']) . "</td>
            <td>" . htmlspecialchars($row['stateProvince']) . "</td>
            <td>" . htmlspecialchars($row['county']) . "</td>
            <td>" . htmlspecialchars($row['municipality']) . "</td>
            <td>" . htmlspecialchars($row['locality']) . "</td>
            <td>" . htmlspecialchars($row['minimumElevationInMeters']) . "</td>
            <td>" . htmlspecialchars($row['maximumElevationInMeters']) . "</td>
            <td>" . htmlspecialchars($row['verbatimLatitude']) . "</td>
            <td>" . htmlspecialchars($row['verbatimLongitude']) . "</td>
            <td>" . htmlspecialchars($row['decimalLatitude']) . "</td>
            <td>" . htmlspecialchars($row['DecimalLongitude']) . "</td>
            <td>" . htmlspecialchars($row['geodeticDatum']) . "</td>
            <td>" . htmlspecialchars($row['identifiedBy']) . "</td>
            <td>" . htmlspecialchars($row['dateIdentified']) . "</td>
            <td>" . htmlspecialchars($row['scientificName']) . "</td>
            <td>" . htmlspecialchars($row['identificationQualifier']) . "</td>
            <td>" . htmlspecialchars($row['reproductiveCondition']) . "</td>
            <td>" . htmlspecialchars($row['ocurrenceRemarks']) . "</td>
            <td>" . htmlspecialchars($row['kingdom']) . "</td>
            <td>" . htmlspecialchars($row['class']) . "</td>
            <td>" . htmlspecialchars($row['orderr']) . "</td>
            <td>" . htmlspecialchars($row['family']) . "</td>
            <td>" . htmlspecialchars($row['genus']) . "</td>
            <td>" . htmlspecialchars($row['specificEpithet']) . "</td>
            <td>" . htmlspecialchars($row['taxonRank']) . "</td>
            <td>" . htmlspecialchars($row['scientificNameAuthorship']) . "</td>
            <td>" . htmlspecialchars($row['id_usuario']) . "</td>
          </tr>";
}
echo "</table>";

mysqli_close($enlace);
?>
