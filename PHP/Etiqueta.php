<?php
require '../fpdf/fpdf.php';
require 'conexionFUNTION.php'; // Conexión a la base de datos

if(isset($_GET['id'])) {
    $id_ejemplar = preg_replace('/[^0-9]/', '', $_GET['id']); 

    // Consulta para obtener los datos del ejemplar
    $Consulta = "SELECT recordedby, eventDate, country, stateProvince, county, scientificName, recordNumber, ocurrenceRemarks, family, locality, identifiedBy FROM ejemplar WHERE id_ejemplar = $id_ejemplar";
    $resultado = mysqli_query($enlace, $Consulta);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($enlace));
    }

    if (mysqli_num_rows($resultado) == 0) { // Verificar si no hay resultados
        die("No se encontraron datos para el ID: $id_ejemplar");
    }
} else {
    die("ID de ejemplar no proporcionado.");
}

// Crear el PDF
class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,utf8_decode('UNIVERSIDAD DE PAMPLONA - CORPONOR'),0,1,'C');
        $this->Ln(0);
        $this->Cell(0,10,utf8_decode('HERBARIO CATATUMBO-SARARE'),0,1,'C');
        $this->Ln(7);
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

// Definir el ancho de las columnas
$ancho_columna = 190; 

// Dibujar los datos
while($row = mysqli_fetch_assoc($resultado)) {
    $pdf->MultiCell($ancho_columna,10,'Familia: '.utf8_decode($row['family']),0,'L'); 
    $pdf->MultiCell($ancho_columna,10,'Nombre Cientifico: '.utf8_decode($row['scientificName']),0,'L');
    $pdf->MultiCell($ancho_columna,10,'Identificado por: '.utf8_decode($row['identifiedBy']),0,'L');
    $pdf->MultiCell($ancho_columna,10,'Caracteristicas: '.utf8_decode($row['ocurrenceRemarks']),0,'L');
    $pdf->Ln(3);
    $pdf->MultiCell($ancho_columna,10,'Pais: '.$row['country'],0,'L');
    $pdf->MultiCell($ancho_columna,10,'Departamento: '.$row['stateProvince'],0,'L');
    $pdf->MultiCell($ancho_columna,10,'Municipio: '.$row['county'],0,'L');
    $pdf->MultiCell($ancho_columna,10,'Localidad: '.utf8_decode($row['locality']),0,'L');
    $pdf->Ln(3);
    $pdf->MultiCell($ancho_columna,10,'Fecha: '.$row['eventDate'],0,'L');
    $pdf->MultiCell($ancho_columna,10,'No. Registro: '.$row['recordNumber'],0,'L');
    $pdf->MultiCell($ancho_columna,10,'Recolector: '.utf8_decode($row['recordedby']),0,'L');
    $pdf->Ln(10); // Espacio entre registros
}

$pdf->Output();
?>
