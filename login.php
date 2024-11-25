<?php
session_start();
include("includes/db_connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['message'] = "Giriş başarılı!";
        header("Location: profile.php");
    } else {
        $_SESSION['message'] = "E-posta veya şifre hatalı.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <form method="POST" action="">
        <label for="email">E-posta:</label><br>
        <input type="email" name="email" required><br><br>

        <label for="password">Şifre:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Giriş Yap</button>
    </form>
</body>
</html>
