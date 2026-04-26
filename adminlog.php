<?php
session_start();

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

    $pdo = new PDO($dsn, $db_username, $db_password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            die("Username and password are required.");
        }

        $stmt = $pdo->prepare("
            SELECT non_student_id, username, password, role_id
            FROM non_students
            WHERE username = ?
            LIMIT 1
        ");

        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // PASSWORD VERIFICATION (MUST MATCH password_hash)
        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id']  = $user['non_student_id'];
            $_SESSION['role_id']  = $user['role_id'];

            // Role → Page mapping
            $role_pages = [
                    1  => 'adminpage.php',
                    2  => 'library2.php',
                    3  => 'finance.php',
                    4  => 'engineering2.php',
                    5  => 'science2.php',
                    6  => 'law2.php',
                    7  => 'arts2.php',
                    8  => 'ict2.php',
                    9  => 'estates2.php',
                    10 => 'affairs.php',
                    11 => 'business2.php',
                    12 => 'halls2.php',
                    14 => 'transport2.php',
                    16 => 'security2.php',
                    17 => 'catering2.php',
                    19 => 'education2.php',
                    20 => 'medicine2.php',
                    21 => 'comtech2.php',
                    22 => 'laboratory2.php'
            ];

// Get role
            $role_id = (int)$user['role_id'];

// Redirect based on role
            if (array_key_exists($role_id, $role_pages)) {
                header("Location: " . $role_pages[$role_id]);
                exit();
            } else {
                // Default fallback
                header("Location: login.php");
                exit();
            }

        } else {
            echo "<h2>Login failed</h2>";
            echo "<p>Invalid username or password.</p>";
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
    <title>Staff Login - University Clearance System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your stylesheet -->
</head>
<body>
<img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<h1>University Clearance System - Staff Login</h1>
<main>
    <form id="login-form" action="adminlog.php" method="POST">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
        <p><a href="forgot_password2.php">Forgot Password?</a></p>
    </form>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
</footer>
</body>
</html>
