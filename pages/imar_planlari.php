<?php
include '../db.php';

function getFilteredImarPlanlari($planTuru = null) {
    $conn = connect();
    $query = "SELECT * FROM imar_planlari WHERE 1=1";
    
    if (!empty($planTuru)) {
        $query .= " AND plan_turu = ?";
    }
    
    $stmt = $conn->prepare($query);
    
    if (!empty($planTuru)) {
        $stmt->bind_param("s", $planTuru);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $imarPlanlari = [];
    while ($row = $result->fetch_assoc()) {
        $imarPlanlari[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $imarPlanlari;
}

$planTuru = $_GET['plan_turu'] ?? null;
$imarPlanlari = getFilteredImarPlanlari($planTuru);


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
    <form method="GET" action="" class="mb-6">
        <div class="flex space-x-4">
            <select name="plan_turu" class="p-2 border border-gray-300 rounded-lg flex-1">
                <option value="">Tüm Plan Türleri</option>
                <option value="imar" <?php if ($planTuru == 'imar') echo 'selected'; ?>>İmar Planı</option>
                <option value="kentsel" <?php if ($planTuru == 'kentsel') echo 'selected'; ?>>Kentsel Plan</option>
                <option value="çevre" <?php if ($planTuru == 'çevre') echo 'selected'; ?>>Çevre Planı</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                Filtrele
            </button>
        </div>
    </form>

    <main class="container mx-auto mt-6">
    <ul class="space-y-4">
        <?php foreach ($imarPlanlari as $plan): ?>
            <li class="bg-white p-4 shadow-md rounded-lg">
                <h2 class="text-lg font-semibold"><?php echo htmlspecialchars($plan['plan_adi']); ?></h2>
                <p class="text-gray-600 mt-2"><strong>Tarih:</strong> <?php echo htmlspecialchars($plan['tarih']); ?></p>
                <p class="text-gray-600"><strong>Tür:</strong> <?php echo htmlspecialchars($plan['plan_turu']); ?></p>
                <a href="imar_plan.php?id=<?php echo $plan['id']; ?>" class="text-blue-600 hover:text-blue-800">
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

