<?php
include '../db.php';

function getArsalar() {
    $conn = connect();
    $query = "SELECT * FROM arsalar";
    $result = $conn->query($query);
    $arsalar = [];
    while ($row = $result->fetch_assoc()) {
        $arsalar[] = $row;
    }
    $conn->close();
    return $arsalar;
}
$arsalar = getArsalar(); // getArsalar() fonksiyonunu ayrıca tanımlamalısınız.
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsalar</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Arsalar</h1>
    </header>
    
    <main>
        <ul>
            <?php foreach ($arsalar as $arsa): ?>
                <li><a href="arsa.php?id=<?php echo $arsa['id']; ?>"><?php echo $arsa['arsa_no']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
