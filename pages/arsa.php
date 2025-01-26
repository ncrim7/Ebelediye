<?php
include '../db.php'; // Veritabanı bağlantısı için db.php dosyasını dahil et

function getArsaById($id) {
    $conn = connect(); // Veritabanına bağlan
    $query = "SELECT * FROM arsalar WHERE id = ?"; // Arsa bilgilerini çek
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // Güvenli bir şekilde ID'yi bağla
    $stmt->execute();
    $result = $stmt->get_result();
    $arsa = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $arsa;
}

// Gelen ID'yi al
if (isset($_GET['id'])) {
    $arsaId = intval($_GET['id']); // Gelen ID'yi güvenli bir şekilde al
    $arsa = getArsaById($arsaId);

    if (!$arsa) {
        die("Arsa bulunamadı."); // ID yanlışsa hata ver
    }
} else {
    die("Geçersiz arsa ID'si.");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($arsa['arsa_no']); ?> - Detay</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Arsa Detayları</h1>
    </header>
    
    <main>
        <h2>Arsa No: <?php echo htmlspecialchars($arsa['arsa_no']); ?></h2>
        <p><strong>Adres:</strong> <?php echo htmlspecialchars($arsa['adres']); ?></p>
        <a href="arsalar.php">Geri Dön</a>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
