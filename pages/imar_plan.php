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
    
    <main class="container mx-auto mt-6 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-lg font-semibold"><?php echo htmlspecialchars($plan['plan_adi']); ?></h2>
        <p class="text-gray-600 mt-2"><strong>Tarih:</strong> <?php echo htmlspecialchars($plan['tarih']); ?></p>
        <p class="text-gray-600"><strong>Tür:</strong> <?php echo htmlspecialchars($plan['plan_turu']); ?></p>
        <p class="text-gray-600 mt-2">
            <strong>Açıklama:</strong> 
            <?php echo !empty($plan['aciklama']) ? htmlspecialchars($plan['aciklama']) : 'Açıklama bulunmamaktadır.'; ?>
        </p>
        <a href="imar_planlari.php" class="text-blue-600 hover:underline block mt-4">Geri Dön</a>
    </main>
    <p class="text-gray-600 mt-2">
        <strong>Plan Belgesi:</strong>
        <?php if (!empty($plan['dosya']) && file_exists("uploads/" . $plan['dosya'])): ?>
            <a href="uploads/<?php echo htmlspecialchars($plan['dosya']); ?>" target="_blank" class="text-blue-600 hover:underline">
                PDF Görüntüle
            </a>
        <?php else: ?>
            Belge bulunmamaktadır.
        <?php endif; ?>
    </p>



    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>

