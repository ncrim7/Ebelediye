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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>İmar Planları</h1>
    </header>
    
    <main>
        <ul>
            <?php foreach ($imarPlanlari as $plan): ?>
                <li><a href="imar_plan.php?id=<?php echo $plan['id']; ?>"><?php echo $plan['plan_adi']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
