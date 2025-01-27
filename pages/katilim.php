<?php
include '../db.php';

function getKatilimTalepleri() {
    $conn = connect();
    $query = "SELECT * FROM katilim_talepleri";
    $result = $conn->query($query);
    $talepler = [];
    while ($row = $result->fetch_assoc()) {
        $talepler[] = $row;
    }
    $conn->close();
    return $talepler;
}

$talepler = getKatilimTalepleri();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katılım Talepleri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Katılım Talepleri</h1>
    </header>
    
    <main class="container mx-auto mt-6">


    <form method="GET" action="" class="mb-6">
    <div class="flex space-x-4">
        <input type="text" name="search" placeholder="Talep Türü Ara" class="p-2 border border-gray-300 rounded-lg flex-1">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
            Ara
        </button>
    </div>
</form>

        <ul class="space-y-4">
            <?php if (!empty($talepler)): ?>
                <?php foreach ($talepler as $talep): ?>
                    <li class="bg-white p-4 shadow-md rounded-lg">
                        <h2 class="text-lg font-semibold text-blue-800">
                            <?php echo htmlspecialchars($talep['talep_turu']); ?>
                        </h2>
                        <p class="text-gray-600 mt-2">
                            <strong>Açıklama:</strong> <?php echo htmlspecialchars($talep['aciklama']); ?>
                        </p>
                        <p class="text-gray-500 mt-2">
                            <strong>Tarih:</strong> <?php echo htmlspecialchars($talep['tarih']); ?>
                        </p>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-red-600">Henüz hiçbir katılım talebi bulunmamaktadır.</p>
            <?php endif; ?>
        </ul>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
