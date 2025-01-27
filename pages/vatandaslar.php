<?php
include '../db.php';
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
