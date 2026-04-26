<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = '127.0.0.1';
$port = '3307';
$db_username = 'root';
$db_password = '';
$db_name = 'grafino';

try {
    $pdo = new PDO(
            "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4",
            $db_username,
            $db_password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username'];

    // FETCH USER
    $stmt = $pdo->prepare("SELECT full_name, email, theme FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        die("User not found.");
    }

    // UPDATE THEME
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
        $theme = $_POST['theme'];

        $stmt = $pdo->prepare("UPDATE users SET theme = ? WHERE username = ?");
        $stmt->execute([$theme, $username]);

        $user['theme'] = $theme;
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
    <title>Settings - University Clearance System</title>

    <link rel="stylesheet" href="styles.css">

    <style>
        body.light { background-color: #f4f4f4; color: black; }
        body.dark { background-color: #121212; color: white; }

        .sidebar.hidden { display: none; }

        .hamburger-menu {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 30px;
            height: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
            z-index: 1000;
        }

        .hamburger-menu div {
            width: 100%;
            height: 4px;
            background-color: #ffffff;
            border-radius: 2px;
        }

        .settings-section {
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            background: white;
        }

        body.dark .settings-section {
            background: #1e1e1e;
        }

        .settings-section input, .settings-section select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }

        button {
            margin-top: 10px;
            padding: 10px;
            background: #0056b3;
            color: white;
            border: none;
            cursor: pointer;
        }

        .logout-btn {
            background: red;
        }
    </style>

</head>

<body class="<?= htmlspecialchars($user['theme'] ?? 'light') ?>">

<img src="http://localhost/university/university-clearance/unilogo.png" style="height:80px;">

<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div><div></div><div></div>
</div>

<div class="main-content">

    <header>
        <h1>University Clearance System</h1>
    </header>

    <aside class="sidebar">
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="departments.html">Departments</a></li>
                <li><a href="requests.php">Requests</a></li>
                <li><a href="upload2.php">Upload Documents</a></li>
                <li><a href="payment.html">Payment</a></li>
                <li><a href="support.php">Help & Support</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </nav>
    </aside>

    <main>

        <h2>Settings</h2>

        <!-- PROFILE -->

        <section class="settings-section">
            <h3>Profile</h3>
            <p>Name: <?php echo htmlspecialchars($user['full_name']); ?></p>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        </section>

        <!-- DARK MODE -->

        <section class="settings-section">
            <h3>Dark Mode</h3>
            <form method="POST">
                <select name="theme">
                    <option value="light" <?php if($user['theme']=='light') echo 'selected'; ?>>Light</option>
                    <option value="dark" <?php if($user['theme']=='dark') echo 'selected'; ?>>Dark</option>
                </select>
                <button type="submit">Save Theme</button>
            </form>
        </section>

        <!-- CHANGE PASSWORD -->

        <section class="settings-section">
            <h3>Change Password</h3>
            <form action="change_password.php" method="POST">
                <input type="password" name="current" placeholder="Current Password" required>
                <input type="password" name="new" placeholder="New Password" required>
                <input type="password" name="confirm" placeholder="Confirm Password" required>
                <button type="submit">Update Password</button>
            </form>
        </section>

        <!-- LOGOUT -->

        <section class="settings-section">
            <h3>Account</h3>
            <a href="logout.php">
                <button class="logout-btn">Logout</button>
            </a>
        </section>

    </main>

</div>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('hidden');
    }
</script>

</body>
</html>
