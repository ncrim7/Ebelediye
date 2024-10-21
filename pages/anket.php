<?php
include '../db.php';

function getAnketler() {
    $conn = connect();
    $query = "SELECT * FROM anketler";
    $result = $conn->query($query);
    $anketler = [];
    while ($row = $result->fetch_assoc()) {
        $anketler[] = $row;
    }
    $conn->close();
    return $anketler;
}

$anketler = getAnketler();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anketler</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Anketler</h1>
    </header>
    
    <main>
        <ul>
            <?php foreach ($anketler as $anket): ?>
                <li><?php echo $anket['soru']; ?> (Tarih: <?php echo $anket['tarih']; ?>)</li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
