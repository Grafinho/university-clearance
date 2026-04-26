<?php
session_start();

$pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=grafino;charset=utf8mb4","root","");

$username = $_SESSION['username'];

$current = $_POST['current'];
$new = $_POST['new'];
$confirm = $_POST['confirm'];

if ($new !== $confirm) {
    die("Passwords do not match");
}

$stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!password_verify($current, $user['password'])) {
    die("Current password incorrect");
}

$newHash = password_hash($new, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
$stmt->execute([$newHash, $username]);

echo "Password updated successfully <a href='settings.php'>Back</a>";
