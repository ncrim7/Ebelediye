<?php
include '../db.php';

if (isset($_GET['id'])) {
    $conn = connect();
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM imar_planlari WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $plan = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if (!$plan) {
        die("Geçerli bir imar planı bulunamadı.");
    }
} else {
    die("ID parametresi eksik.");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($plan['plan_adi']); ?> - Detay</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">İmar Planı Detayı</h1>
    </header>
    
    <main class="container mx-auto mt-6 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4"><?php echo htmlspecialchars($plan['plan_adi']); ?></h2>
        <p class="text-gray-600"><strong>Tarih:</strong> <?php echo htmlspecialchars($plan['tarih']); ?></p>
        <p class="text-gray-600 mt-2"><strong>Plan Açıklaması:</strong> Bu plana ait detaylı açıklamalar buraya eklenebilir.</p>
        <a href="imar_planlari.php" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-semibold">
            Geri Dön
        </a>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>

