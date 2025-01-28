<?php
include '../db.php';

// Vatandaş bilgilerini ID'ye göre çekmek için bir fonksiyon
function getVatandasById($id) {
    $conn = connect();
    $query = "SELECT * FROM vatandaslar WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // ID'yi güvenli bir şekilde bağla
    $stmt->execute();
    $result = $stmt->get_result();
    $vatandas = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $vatandas;
}

// Gelen ID'yi al
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Geçersiz vatandaş ID'si."); // ID eksikse hata mesajı göster
}

$vatandas = getVatandasById($id);

if (!$vatandas) {
    die("Vatandaş bulunamadı."); // ID'ye ait vatandaş yoksa hata mesajı göster
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vatandaş Detayları</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Vatandaş Detayları</h1>
    </header>
    
    <main class="container mx-auto mt-6 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($vatandas['ad'] . ' ' . $vatandas['soyad']); ?></h2>
        <p class="text-gray-600 mt-2"><strong>TC No:</strong> <?php echo htmlspecialchars($vatandas['tc_no']); ?></p>
        <p class="text-gray-600"><strong>Cinsiyet:</strong> <?php echo htmlspecialchars($vatandas['cinsiyet']); ?></p>
        <p class="text-gray-600"><strong>Doğum Tarihi:</strong> <?php echo htmlspecialchars($vatandas['dogum_tarihi']); ?></p>
        <p class="text-gray-600"><strong>Şehir:</strong> <?php echo htmlspecialchars($vatandas['sehir']); ?></p>
        <p class="text-gray-600 mt-2"><strong>E-posta:</strong> <?php echo htmlspecialchars($vatandas['email']); ?></p>
        <p class="text-gray-600"><strong>Telefon:</strong> <?php echo htmlspecialchars($vatandas['telefon']); ?></p>
        <a href="vatandaslar.php" class="text-blue-600 hover:underline block mt-4">Geri Dön</a>
    </main>

    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
