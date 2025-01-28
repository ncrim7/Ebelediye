<?php
include '../db.php';

function getAnketById($id) {
    $conn = connect();
    $query = "SELECT * FROM anketler WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $anket = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $anket;
}

function saveCevap($anketId, $cevap) {
    $conn = connect();
    $query = "INSERT INTO anket_cevaplari (anket_id, cevap) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $anketId, $cevap);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

if (isset($_GET['id'])) {
    $anketId = intval($_GET['id']);
    $anket = getAnketById($anketId);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cevap = $_POST['cevap'];
        saveCevap($anketId, $cevap);
        header("Location: anket.php?success=1");
        exit;
    }

    if (!$anket) {
        die("Anket bulunamadı.");
    }
} else {
    die("Geçersiz anket ID'si.");
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anket Cevapla</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Anket Cevapla</h1>
    </header>
    
    <main class="container mx-auto mt-6">
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-lg font-semibold text-blue-800">
                <?php echo htmlspecialchars($anket['soru']); ?>
            </h2>
            <form method="POST" class="mt-4">
                <label for="cevap" class="block text-gray-700 font-medium mb-2">Cevabınız:</label>
                <textarea id="cevap" name="cevap" rows="4" 
                          class="w-full p-2 border border-gray-300 rounded-lg" 
                          placeholder="Cevabınızı buraya yazın..." required></textarea>
                <button type="submit" 
                        class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                    Gönder
                </button>
            </form>
        </div>
        <a href="anket.php" class="block text-blue-600 hover:underline mt-4">Geri Dön</a>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
