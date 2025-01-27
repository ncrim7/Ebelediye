<?php
include '../db.php';

function getImarPlanlari() {
    $conn = connect();
    $query = "SELECT * FROM imar_planlari";
    $result = $conn->query($query);
    $planlar = [];
    while ($row = $result->fetch_assoc()) {
        $planlar[] = $row;
    }
    $conn->close();
    return $planlar;
}

$imarPlanlari = getImarPlanlari();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İmar Planları</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">İmar Planları</h1>
    </header>
    
    <main class="container mx-auto mt-6">
        <ul class="space-y-4">
            <?php foreach ($imarPlanlari as $plan): ?>
                <li class="bg-white p-4 shadow-md rounded-lg">
                    <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($plan['plan_adi']); ?></h2>
                    <p class="text-sm text-gray-500">Tarih: <?php echo htmlspecialchars($plan['tarih']); ?></p>
                    <a href="imar_plan.php?id=<?php echo $plan['id']; ?>" class="text-blue-600 font-semibold hover:text-blue-800 hover:scale-105 transition-transform">
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

