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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        #map { height: 400px; width: 100%; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Arsa Detayları</h1>
    </header>
    
    <main class="container mx-auto mt-6 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-lg font-semibold"><?php echo htmlspecialchars($arsa['arsa_no']); ?></h2>
        <p class="text-gray-600 mt-2"><strong>Adres:</strong> <?php echo htmlspecialchars($arsa['adres']); ?></p>
        <p class="text-gray-600"><strong>Boyut:</strong> <?php echo htmlspecialchars($arsa['boyut']); ?> m²</p>
        <p class="text-gray-600"><strong>Fiyat:</strong> <?php echo number_format($arsa['fiyat'], 2, ',', '.'); ?> ₺</p>
        <p class="text-gray-600"><strong>İmar Durumu:</strong> <?php echo htmlspecialchars($arsa['imar_durumu']); ?></p>
        <div id="map" class="mt-4" style="width: 100%; height: 400px;"></div>
        <a href="arsalar.php" class="text-blue-600 hover:underline block mt-4">Geri Dön</a>
    </main>

    <script>
        const map = L.map('map').setView([<?php echo $arsa['latitude']; ?>, <?php echo $arsa['longitude']; ?>], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([<?php echo $arsa['latitude']; ?>, <?php echo $arsa['longitude']; ?>])
            .addTo(map)
            .bindPopup("<?php echo htmlspecialchars($arsa['arsa_no']); ?>")
            .openPopup();
    </script>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
