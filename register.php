<?php
session_start();
include("includes/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $school = $_POST['school'];
    $city = $_POST['city'];
    $district = $_POST['district'];

    $query = "INSERT INTO users (name, email, password, school, city, district) VALUES ('$name', '$email', '$password', '$school', '$city', '$district')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Kayıt başarılı!";
        header("Location: login.php");
    } else {
        $_SESSION['message'] = "Kayıt sırasında hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
</head>
<body>
    <h2>Kayıt Ol</h2>
    <form method="POST" action="">
        <label for="name">Adınız:</label><br>
        <input type="text" name="name" required><br><br>

        <label for="email">E-posta:</label><br>
        <input type="email" name="email" required><br><br>

        <label for="password">Şifre:</label><br>
        <input type="password" name="password" required><br><br>

        <label for="school">Okul Adı:</label><br>
        <input type="text" name="school" required><br><br>

        <label for="city">İl:</label><br>
        <input type="text" name="city" required><br><br>

        <label for="district">İlçe:</label><br>
        <input type="text" name="district" required><br><br>

        <button type="submit">Kayıt Ol</button>
    </form>
</body>
</html>
