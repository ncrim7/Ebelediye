<?php
include '../db.php';

function getGelirler() {
    $conn = connect();
    $query = "SELECT * FROM gelirler";
    $result = $conn->query($query);
    $gelirler = [];
    while ($row = $result->fetch_assoc()) {
        $gelirler[] = $row;
    }
    $conn->close();
    return $gelirler;
}

function getGiderler() {
    $conn = connect();
    $query = "SELECT * FROM giderler";
    $result = $conn->query($query);
    $giderler = [];
    while ($row = $result->fetch_assoc()) {
        $giderler[] = $row;
    }
    $conn->close();
    return $giderler;
}

$gelirler = getGelirler();
$giderler = getGiderler();

$totalGelir = !empty($gelirler) ? array_sum(array_column($gelirler, 'miktar')) : 0;
$totalGider = !empty($giderler) ? array_sum(array_column($giderler, 'miktar')) : 0;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelir ve Giderler</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Gelir ve Giderler</h1>
    </header>
    
    <main class="container mx-auto mt-6">

        <!-- Gelirler Bölümü -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Gelirler</h2>
            <ul class="space-y-4">
                <?php if (!empty($gelirler)): ?>
                    <?php foreach ($gelirler as $gelir): ?>
                        <li class="bg-white p-4 shadow-md rounded-lg">
                            <h3 class="text-lg font-medium"><?php echo htmlspecialchars($gelir['gelir_turu']); ?></h3>
                            <p class="text-gray-600 mt-2"><strong>Miktar:</strong> <?php echo number_format($gelir['miktar'], 2, ',', '.'); ?> ₺</p>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-red-600">Hiçbir gelir kaydı bulunamadı.</p>
                <?php endif; ?>
            </ul>
        </section>

        <!-- Giderler Bölümü -->
        <section>
            <h2 class="text-xl font-semibold mb-4">Giderler</h2>
            <ul class="space-y-4">
                <?php if (!empty($giderler)): ?>
                    <?php foreach ($giderler as $gider): ?>
                        <li class="bg-white p-4 shadow-md rounded-lg">
                            <h3 class="text-lg font-medium"><?php echo htmlspecialchars($gider['gider_turu']); ?></h3>
                            <p class="text-gray-600 mt-2"><strong>Miktar:</strong> <?php echo number_format($gider['miktar'], 2, ',', '.'); ?> ₺</p>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-red-600">Hiçbir gider kaydı bulunamadı.</p>
                <?php endif; ?>
            </ul>
        </section>

        <!-- Toplam Gelir ve Gider -->
        <div class="bg-blue-100 p-4 rounded-lg mb-6">
            <p class="text-lg font-medium text-blue-800">Toplam Gelir: <?php echo number_format($totalGelir, 2, ',', '.'); ?> ₺</p>
            <p class="text-lg font-medium text-red-800">Toplam Gider: <?php echo number_format($totalGider, 2, ',', '.'); ?> ₺</p>
        </div>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
