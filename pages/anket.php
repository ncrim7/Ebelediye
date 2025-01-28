<?php
include '../db.php';

function getAnketler() {
    $conn = connect();
    $query = "SELECT * FROM anketler";
    $result = $conn->query($query);
    $anketler = [];
    while ($row = $result->fetch_assoc()) {
        $anketler[] = $row;
    }
    $conn->close();
    return $anketler;
}

$anketler = getAnketler();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anketler</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Anketler</h1>
    </header>
    
    <main class="container mx-auto mt-6">

    <form method="GET" action="" class="mb-6">
        <div class="flex space-x-4">
            <input type="date" name="filter_date" class="p-2 border border-gray-300 rounded-lg flex-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                Filtrele
            </button>
        </div>
    </form>

        <ul class="space-y-4">
            <?php if (!empty($anketler)): ?>
                <?php foreach ($anketler as $anket): ?>
                    <li class="bg-white p-4 shadow-md rounded-lg">
                        <h2 class="text-lg font-semibold text-blue-800">
                            <?php echo htmlspecialchars($anket['soru']); ?>
                        </h2>
                        <p class="text-gray-600 mt-2">
                            <strong>Tarih:</strong> <?php echo htmlspecialchars($anket['tarih']); ?>
                        </p>
                        <a href="anket_cevapla.php?id=<?php echo $anket['id']; ?>" 
                        class="text-blue-600 hover:underline mt-2 block">
                            Cevap Ver
                        </a>
                    </li>
                <?php endforeach; ?>

            <?php else: ?>
                <p class="text-red-600">Henüz hiçbir anket bulunmamaktadır.</p>
            <?php endif; ?>
        </ul>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
