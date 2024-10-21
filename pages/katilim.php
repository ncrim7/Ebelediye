<?php
include '../db.php';

function getKatilimTalepleri() {
    $conn = connect();
    $query = "SELECT * FROM katilim_talepleri";
    $result = $conn->query($query);
    $talepler = [];
    while ($row = $result->fetch_assoc()) {
        $talepler[] = $row;
    }
    $conn->close();
    return $talepler;
}

$talepler = getKatilimTalepleri();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katılım Talepleri</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Katılım Talepleri</h1>
    </header>
    
    <main>
        <ul>
            <?php foreach ($talepler as $talep): ?>
                <li>
                    <strong><?php echo $talep['talep_turu']; ?></strong> - 
                    <?php echo $talep['aciklama']; ?> (Tarih: <?php echo $talep['tarih']; ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
