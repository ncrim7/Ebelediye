<?php
include '../db.php';
function getButceler() {
    $conn = connect();
    $query = "SELECT * FROM butceler";
    $result = $conn->query($query);
    $butceler = [];
    while ($row = $result->fetch_assoc()) {
        $butceler[] = $row;
    }
    $conn->close();
    return $butceler;
}

$butceler = getButceler();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bütçeler</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Bütçeler</h1>
    </header>
    
    <main>
        <ul>
            <?php foreach ($butceler as $butce): ?>
                <li>
                    <strong><?php echo $butce['yili']; ?></strong> - Toplam Bütçe: <?php echo $butce['toplam_budce']; ?>
                    <p><?php echo $butce['aciklama']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
