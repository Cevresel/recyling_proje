<?php
session_start();
session_unset();  // Oturumu temizler
session_destroy(); // Oturumu sonlandırır
header("Location: index.php"); // Ana sayfaya yönlendir
exit();
?>
