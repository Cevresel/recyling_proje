<?php
$servername = "localhost";
$username = "root";  // Veritabanı kullanıcı adı
$password = "";  // Veritabanı şifresi
$dbname = "katki_puanlama";  // Veritabanı adı

// Veritabanına bağlanıyoruz
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}
?>
