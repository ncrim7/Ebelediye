<?php
$title = "Arsa Detayları";
include '../db.php'; // Veritabanı bağlantısı için db.php dosyasını dahil et

function getArsaById($id) {
    $conn = connect();
    $query = "SELECT * FROM arsalar WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $arsa = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $arsa;
}

if (isset($_GET['id'])) {
    $arsaId = intval($_GET['id']);
    $arsa = getArsaById($arsaId);

    if (!$arsa) {
        die("Arsa bulunamadı.");
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Arsa Detayları</h1>
    </header>
    
    <main class="container mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Arsa No: <?php echo htmlspecialchars($arsa['arsa_no']); ?></h2>
        <p class="text-gray-600 mb-2"><strong>Adres:</strong> <?php echo htmlspecialchars($arsa['adres']); ?></p>
        <a href="arsalar.php" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-semibold">
            Geri Dön
        </a>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
