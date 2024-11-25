<?php
session_start();
include("includes/db_connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $waste_type = $_POST['waste_type'];
    $waste_weight = $_POST['waste_weight'];

    // Atık türüne göre puan hesaplama
    $points = 0;
    switch ($waste_type) {
        case 'Kağıt/Karton':
            $points = $waste_weight * 10;
            break;
        case 'Plastik':
            $points = $waste_weight * 15;
            break;
        case 'Cam':
            $points = $waste_weight * 20;
            break;
        case 'Metal':
            $points = $waste_weight * 25;
            break;
        case 'Pil':
            $points = $waste_weight * 50;
            break;
    }

    // Puanı kullanıcının toplam puanına ekle
    $query = "UPDATE users SET total_points = total_points + $points WHERE user_id = '$user_id'";
    mysqli_query($conn, $query);

    // Atık kaydını veritabanına ekle
    $query = "INSERT INTO waste_submission (user_id, waste_type, waste_weight, points_earned) 
              VALUES ('$user_id', '$waste_type', '$waste_weight', '$points')";
    mysqli_query($conn, $query);

    $_SESSION['message'] = "Atık başarıyla gönderildi! Kazandığınız puan: $points";
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Atık Gönder</title>
</head>
<body>
    <h2>Atık Gönder</h2>
    <form method="POST" action="">
        <label for="waste_type">Atık Türü:</label>
        <select name="waste_type" required>
            <option value="Kağıt/Karton">Kağıt/Karton</option>
            <option value="Plastik">Plastik</option>
            <option value="Cam">Cam</option>
            <option value="Metal">Metal</option>
            <option value="Pil">Pil</option>
        </select><br><br>

        <label for="waste_weight">Atık Ağırlığı (kg):</label>
        <input type="number" name="waste_weight" step="0.1" required><br><br>

        <button type="submit">Atık Gönder</button>
    </form>
</body>
</html>
