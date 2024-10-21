<?php

function connect() {
    $servername = "localhost";
    $username = "root"; // Kullanıcı adınızı değiştirin
    $password = ""; // Parolanızı değiştirin
    $dbname = "create_tables"; // Veritabanı adınızı değiştirin

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    return $conn;
}
?>
