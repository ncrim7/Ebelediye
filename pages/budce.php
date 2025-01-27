<?php
include '../db.php';
function getButceler() {
    $conn = connect();
    $query = "SELECT * FROM butceler";
    $result = $conn->query($query);
    $butceler = [];
    while ($row = $result->fetch_assoc()) {
        $butceler[] = $row;
    }
    $conn->close();
    return $butceler;
}

$butceler = getButceler();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bütçeler</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Bütçeler</h1>
    </header>
    
    <main class="container mx-auto mt-6">
        <ul class="space-y-4">
            <?php foreach ($butceler as $butce): ?>
                <li class="bg-white p-6 shadow-md rounded-lg">
                    <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($butce['yili']); ?> Yılı Bütçesi</h2>
                    <p class="text-gray-600 mt-2"><strong>Toplam Bütçe:</strong> <?php echo number_format($butce['toplam_budce'], 2, ',', '.'); ?> ₺</p>
                    <p class="text-gray-500 mt-2"><?php echo htmlspecialchars($butce['aciklama']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
