<?php
require '../vendor/fpdf/fpdf.php';

function getGelirGiderData() {
    $conn = connect();
    
    $gelirQuery = "SELECT * FROM gelirler";
    $gelirResult = $conn->query($gelirQuery);
    $gelirler = $gelirResult->fetch_all(MYSQLI_ASSOC);

    $giderQuery = "SELECT * FROM giderler";
    $giderResult = $conn->query($giderQuery);
    $giderler = $giderResult->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    return ['gelirler' => $gelirler, 'giderler' => $giderler];
}

$data = getGelirGiderData();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Gelir ve Gider Raporu', 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
foreach ($data['gelirler'] as $gelir) {
    $pdf->Cell(0, 10, 'Gelir - Tutar: ' . $gelir['miktar'] . ' ₺ - Tarih: ' . $gelir['tarih'], 0, 1);
}

foreach ($data['giderler'] as $gider) {
    $pdf->Cell(0, 10, 'Gider - Tutar: ' . $gider['miktar'] . ' ₺ - Tarih: ' . $gider['tarih'], 0, 1);
}

$pdf->Output('D', 'GelirGiderRaporu.pdf');
