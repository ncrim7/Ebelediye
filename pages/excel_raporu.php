<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function getGelirGiderData() {
    $conn = connect();
    
    // Gelirleri çek
    $gelirQuery = "SELECT * FROM gelirler";
    $gelirResult = $conn->query($gelirQuery);
    $gelirler = $gelirResult->fetch_all(MYSQLI_ASSOC);

    // Giderleri çek
    $giderQuery = "SELECT * FROM giderler";
    $giderResult = $conn->query($giderQuery);
    $giderler = $giderResult->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    return ['gelirler' => $gelirler, 'giderler' => $giderler];
}

// Verileri al
$data = getGelirGiderData();

// Excel dosyasını oluştur
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Başlıkları ekle
$sheet->setCellValue('A1', 'Tür');
$sheet->setCellValue('B1', 'Tutar');
$sheet->setCellValue('C1', 'Tarih');

// Gelirleri ekle
$row = 2;
foreach ($data['gelirler'] as $gelir) {
    $sheet->setCellValue('A' . $row, 'Gelir');
    $sheet->setCellValue('B' . $row, $gelir['miktar']);
    $sheet->setCellValue('C' . $row, $gelir['tarih']);
    $row++;
}

// Giderleri ekle
foreach ($data['giderler'] as $gider) {
    $sheet->setCellValue('A' . $row, 'Gider');
    $sheet->setCellValue('B' . $row, $gider['miktar']);
    $sheet->setCellValue('C' . $row, $gider['tarih']);
    $row++;
}

// Excel dosyasını indir
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="GelirGiderRaporu.xlsx"');
$writer->save('php://output');
