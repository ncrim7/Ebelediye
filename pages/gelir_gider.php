<?php
include '../db.php';

function getGelirler() {
    $conn = connect();
    $query = "SELECT * FROM gelirler";
    $result = $conn->query($query);
    $gelirler = [];
    while ($row = $result->fetch_assoc()) {
        $gelirler[] = $row;
    }
    $conn->close();
    return $gelirler;
}

function getGiderler() {
    $conn = connect();
    $query = "SELECT * FROM giderler";
    $result = $conn->query($query);
    $giderler = [];
    while ($row = $result->fetch_assoc()) {
        $giderler[] = $row;
    }
    $conn->close();
    return $giderler;
}

$gelirler = getGelirler();
$giderler = getGiderler();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelir ve Giderler</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Gelir ve Giderler</h1>
    </header>
    
    <main>
        <h2>Gelirler</h2>
        <ul>
            <?php foreach ($gelirler as $gelir): ?>
                <li><?php echo $gelir['gelir_turu'] . ': ' . $gelir['miktar']; ?></li>
            <?php endforeach; ?>
        </ul>
        
        <h2>Giderler</h2>
        <ul>
            <?php foreach ($giderler as $gider): ?>
                <li><?php echo $gider['gider_turu'] . ': ' . $gider['miktar']; ?></li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
