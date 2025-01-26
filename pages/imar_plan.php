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
    <title>İmar Planı Detayı</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>İmar Planı Detayı: <?php echo htmlspecialchars($plan['plan_adi']); ?></h1>
    </header>
    
    <main>
        <p><strong>Plan Adı:</strong> <?php echo htmlspecialchars($plan['plan_adi']); ?></p>
        <p><strong>Tarih:</strong> <?php echo htmlspecialchars($plan['tarih']); ?></p>
        <a href="imar_planlari.php">Geri Dön</a>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
