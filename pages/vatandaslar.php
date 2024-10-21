<?php
include '../db.php';
function getVatandaslar() {
    $conn = connect();
    $query = "SELECT * FROM vatandaslar";
    $result = $conn->query($query);
    $vatandaslar = [];
    while ($row = $result->fetch_assoc()) {
        $vatandaslar[] = $row;
    }
    $conn->close();
    return $vatandaslar;
}

$vatandaslar = getVatandaslar();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vatandaşlar</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>Vatandaşlar</h1>
    </header>
    
    <main>
        <ul>
            <?php foreach ($vatandaslar as $vatandas): ?>
                <li><a href="vatandas.php?id=<?php echo $vatandas['id']; ?>"><?php echo $vatandas['ad'] . ' ' . $vatandas['soyad']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer>
        <p><a href="../index.php">Ana Sayfaya Dön</a></p>
    </footer>
</body>
</html>
