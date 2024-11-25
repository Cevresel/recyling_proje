<?php
session_start();

// Veritabanı bağlantısı
include('includes/db_connection.php');

// Kullanıcının giriş yapıp yapmadığını kontrol et
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Giriş yapmamış kullanıcıyı login sayfasına yönlendir
    exit();
}

// Kullanıcıyı veritabanından al
$user_id = $_SESSION['user_id'];
$sql_user = "SELECT * FROM users WHERE user_id = '$user_id'";
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Atık geçmişi verilerini al
$sql_waste = "SELECT * FROM waste_submission WHERE user_id = '$user_id' ORDER BY submission_date DESC";
$result_waste = mysqli_query($conn, $sql_waste);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Profili</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <h1>ÇEVRESEL KATKI PUANLAMA SİSTEMİ</h1>
</header>

<div class="content">
    <h2>Hoşgeldiniz, <?php echo $user['name']; ?>!</h2>
    <h3>Toplam Puanınız: <?php echo $user['total_points']; ?></h3>

    <h3>Geçmiş Atık Gönderimleriniz:</h3>
    <table>
        <thead>
            <tr>
                <th>Atık Türü</th>
                <th>Atık Ağırlığı (kg)</th>
                <th>Kazandığınız Puan</th>
                <th>Tarih</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($waste = mysqli_fetch_assoc($result_waste)) {
                echo "<tr>
                        <td>" . $waste['waste_type'] . "</td>
                        <td>" . $waste['waste_weight'] . "</td>
                        <td>" . $waste['points_earned'] . "</td>
                        <td>" . $waste['submission_date'] . "</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="logout.php">Çıkış Yap</a>
</div>

</body>
</html>

<?php
mysqli_close($conn); // Veritabanı bağlantısını kapat
?>
