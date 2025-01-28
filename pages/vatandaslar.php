<?php
include '../db.php';

function getFilteredVatandaslar($cinsiyet = null, $sehir = null, $yas_araligi = null) {
    $conn = connect();
    $query = "SELECT *, TIMESTAMPDIFF(YEAR, dogum_tarihi, CURDATE()) AS yas FROM vatandaslar WHERE 1=1";

    // Koşulları ekleme
    $params = [];
    $types = "";

    if (!empty($cinsiyet)) {
        $query .= " AND cinsiyet = ?";
        $params[] = $cinsiyet;
        $types .= "s";
    }

    if (!empty($sehir)) {
        $query .= " AND sehir = ?";
        $params[] = $sehir;
        $types .= "s";
    }

    if (!empty($yas_araligi)) {
        $yas_araliklari = explode("-", $yas_araligi);
        $query .= " AND TIMESTAMPDIFF(YEAR, dogum_tarihi, CURDATE()) BETWEEN ? AND ?";
        $params[] = (int)$yas_araliklari[0];
        $params[] = (int)$yas_araliklari[1];
        $types .= "ii";
    }

    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $vatandaslar = [];
    while ($row = $result->fetch_assoc()) {
        $vatandaslar[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $vatandaslar;
}

// Filtreleri almak
$cinsiyet = $_GET['cinsiyet'] ?? null;
$sehir = $_GET['sehir'] ?? null;
$yas_araligi = $_GET['yas_araligi'] ?? null;

// Filtreleme fonksiyonunu çağırma
$vatandaslar = getFilteredVatandaslar($cinsiyet, $sehir, $yas_araligi);

function getVatandaslar() {
    $conn = connect();
    $query = "SELECT * FROM vatandaslar";
    $result = $conn->query($query);
    $vatandaslar = [];
    while ($row = $result->fetch_assoc()) {
        $vatandaslar[] = $row;
    }
    $conn->close();
    return $vatandaslar;
}

$vatandaslar = getVatandaslar();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vatandaşlar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Vatandaşlar</h1>
    </header>
    
    <main class="container mx-auto mt-6">

    <form method="GET" action="" class="mb-6">
        <div class="flex space-x-4">
            <!-- Cinsiyet Filtreleme -->
            <select name="cinsiyet" class="p-2 border border-gray-300 rounded-lg">
                <option value="">Cinsiyet Seç</option>
                <option value="Erkek" <?php if ($cinsiyet == 'Erkek') echo 'selected'; ?>>Erkek</option>
                <option value="Kadın" <?php if ($cinsiyet == 'Kadın') echo 'selected'; ?>>Kadın</option>
            </select>

            <!-- Şehir Filtreleme -->
            <select name="sehir" class="p-2 border border-gray-300 rounded-lg">
                <option value="">Şehir Seç</option>
                <option value="İstanbul" <?php if ($sehir == 'İstanbul') echo 'selected'; ?>>İstanbul</option>
                <option value="Ankara" <?php if ($sehir == 'Ankara') echo 'selected'; ?>>Ankara</option>
                <option value="İzmir" <?php if ($sehir == 'İzmir') echo 'selected'; ?>>İzmir</option>
            </select>

            <!-- Yaş Aralığı Filtreleme -->
            <select name="yas_araligi" class="p-2 border border-gray-300 rounded-lg">
                <option value="">Yaş Aralığı Seç</option>
                <option value="18-25" <?php if ($yas_araligi == '18-25') echo 'selected'; ?>>18-25</option>
                <option value="26-35" <?php if ($yas_araligi == '26-35') echo 'selected'; ?>>26-35</option>
                <option value="36-50" <?php if ($yas_araligi == '36-50') echo 'selected'; ?>>36-50</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                Filtrele
            </button>
        </div>
    </form>


    <form method="GET" action="" class="mb-4">
        <input type="text" name="search" placeholder="Vatandaş Ara" class="p-2 border border-gray-300 rounded-lg w-full">
        <button type="submit" class="mt-2 bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-800">
            Ara
        </button>
    </form>
        <ul class="space-y-4">
            <?php foreach ($vatandaslar as $vatandas): ?>
                <li class="bg-white p-4 shadow-md rounded-lg">
                    <h2 class="text-lg font-semibold"><?php echo htmlspecialchars($vatandas['ad'] . ' ' . $vatandas['soyad']); ?></h2>
                    <a href="vatandas.php?id=<?php echo $vatandas['id']; ?>" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Detayları Gör
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
