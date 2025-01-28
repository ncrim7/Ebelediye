<?php
$title = "Arsalar";
include '../db.php';

function getFilteredArsalar($search = null) {
    $conn = connect();
    $query = "SELECT * FROM arsalar WHERE 1=1";
    
    if (!empty($search)) {
        $query .= " AND (arsa_no LIKE ? OR adres LIKE ?)";
    }
    
    $stmt = $conn->prepare($query);
    
    if (!empty($search)) {
        $searchTerm = "%$search%";
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $arsalar = [];
    while ($row = $result->fetch_assoc()) {
        $arsalar[] = $row;
    }
    $stmt->close();
    $conn->close();
    return $arsalar;
}

$search = $_GET['search'] ?? null;
$arsalar = getFilteredArsalar($search);


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
$arsalar = getArsalar();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsalar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-4 shadow-md">
        <h1 class="text-center text-2xl font-bold">Arsalar</h1>
    </header>
    
    <main class="container mx-auto mt-6">
        <form method="GET" action="" class="mb-6">
            <div class="flex space-x-4">
                <input type="text" name="search" placeholder="Arsa No veya Adres Ara" 
                    class="p-2 border border-gray-300 rounded-lg flex-1" 
                    value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800">
                    Ara
                </button>
            </div>
        </form>

        <ul class="space-y-4">
            <?php foreach ($arsalar as $arsa): ?>
                <li class="bg-white p-4 shadow-md rounded-lg">
                    <h2 class="text-lg font-semibold"><?php echo htmlspecialchars($arsa['arsa_no']); ?></h2>
                    <a href="arsa.php?id=<?php echo $arsa['id']; ?>" class="text-blue-600 hover:text-blue-800">
                        Detayları Gör
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
    
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <a href="../index.php" class="text-blue-600 hover:underline">Ana Sayfaya Dön</a>
    </footer>
</body>
</html>
