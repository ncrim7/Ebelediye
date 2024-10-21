<?php
include '../db.php';
if (isset($_GET['id'])) {
    $conn = connect();
    $id = intval($_GET['id']);
    $query = "SELECT * FROM imar_planlari WHERE id = $id";
    $result = $conn->query($query);
    $plan = $result->fetch_assoc();
    $conn->close();
} else {
    die("İmar planı bulunamadı.");
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
        <h1>İmar Planı Detayı: <?php echo $plan['plan_adi']; ?></h1>
    </header>
    
    <main>
        <p>Plan Adı: <?php echo $plan['plan_adi']; ?></p>
        <p>Tarih: <?php echo $plan['tarih']; ?></p>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
