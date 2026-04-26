<?php
$pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=grafino;charset=utf8mb4","root","");

$token = $_GET['token'] ?? '';

if (!$token) {
    die("No token provided.");
}

// FIND TOKEN
$stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ?");
$stmt->execute([$token]);
$reset = $stmt->fetch();

if (!$reset) {
    die("Invalid token.");
}

// CHECK EXPIRY
if (strtotime($reset['expires_at']) < time()) {
    die("Token expired.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $new = $_POST['new'];
    $confirm = $_POST['confirm'];

    if ($new !== $confirm) {
        die("Passwords do not match");
    }

    $hash = password_hash($new, PASSWORD_DEFAULT);

    // UPDATE PASSWORD
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$hash, $reset['email']]);

    // DELETE TOKEN
    $pdo->prepare("DELETE FROM password_resets WHERE token = ?")->execute([$token]);

    echo "Password reset successful <a href='login.php'>Login</a>";
    exit();
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Reset Password</title>
</head>
<body>

<h2>Reset Password</h2>

<form method="POST">
    <input type="password" name="new" placeholder="New Password" required><br><br>
    <input type="password" name="confirm" placeholder="Confirm Password" required><br><br>
    <button type="submit">Reset Password</button>
</form>

</body>
</html>
