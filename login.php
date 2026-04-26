<?php
session_start(); // Start the session at the very beginning of the PHP script

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = '127.0.0.1';
$port = '3307';
$db_username = 'root';
$db_password = '';
$db_name = 'grafino';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $db_username, $db_password, $options);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($username) || empty($password)) {
            die("Username and password are required.");
        }

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $stmt = $pdo->prepare("SELECT username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['username'];

            header("Location: home.php");
            exit();

        } else {
            echo "<h2>Login failed</h2>";
            echo "<p>Invalid registration number or password.</p>";
        }
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - University Clearance System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<h1>University Clearance System</h1>
<main>
    <form id="login-form" action="login.php" method="POST">
        <h2>Login</h2>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>

        <p><a href="forgot_password.php">Forgot Password?</a></p>
    </form>

    <div class="admin-login">
        <p>Admin? <a href="adminlog.php"><button type="button">Admin Login</button></a></p>
    </div>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
</footer>
<script src="script.js"></script>
</body>
</html>