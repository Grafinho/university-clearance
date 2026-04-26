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
    $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4";
    $pdo = new PDO($dsn, $db_username, $db_password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // SESSION CHECK
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username'];

    // FETCH USER
    $stmt = $pdo->prepare("SELECT full_name FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        die("User not found.");
    }

    // FETCH EVENTS (READ ONLY)
    $stmt = $pdo->query("SELECT * FROM affairs_events ORDER BY event_date ASC");
    $events = $stmt->fetchAll();

    // FETCH USER REGISTRATIONS (optional)
    $stmt = $pdo->prepare("SELECT event_id FROM affairs_registrations WHERE username = ?");
    $stmt->execute([$username]);
    $registeredEvents = $stmt->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$data = [
        'full_name' => htmlspecialchars($user['full_name']),
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - University Clearance System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Sidebar hidden class */
        .sidebar.hidden {
            display: none;
        }

        /* Hamburger menu button */
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

        /* Hamburger menu lines */
        .hamburger-menu div {
            width: 100%;
            height: 4px;
            background-color: #ffffff;
            border-radius: 2px;
        }

        /* Hover effect for the hamburger menu */
        .hamburger-menu:hover div {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<img src="http://localhost/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<!-- Hamburger Menu for Toggling Sidebar -->
<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
</div>
<!-- Main Content -->
<div class="main-content" id="main-content">
    <header>
        <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="header-content">
            <h1>University Clearance System</h1>
        </div>
    </header>
    <!-- Navigation Sidebar -->
    <aside class="sidebar">
        <nav>
            <ul>
                <li><a href="adminpage.php">Home</a></li>
                <li><a href="manage_requests.php">View Requests</a></li>
                <li><a href="manage_documents.php">View Documents</a></li>
                <li><a href="departments2.html">View Departments</a></li>
                <li><a href="manage_paymentS.php">View Payment</a></li>
                <li><a href="manage_messages.php">View Messages</a></li>
                <li><a href="affairs.php">Manage Notifications</a></li>
                <li><a href="support2.php">Help & Support</a></li>
                <li><a href="settings2.php">Settings</a></li>
            </ul>
        </nav>
    </aside>

    <main>

        <!-- Welcome -->
        <section class="welcome-section">
            <h2>Welcome, <?php echo $data['full_name']; ?>!</h2>
            <p>Student Affairs - Events & Planning</p>
        </section>

        <!-- MESSAGE -->
        <?php if (!empty($message)): ?>
            <p style="color: green;"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- EVENTS SECTION -->
        <section class="progress-section">
            <table border="1" width="100%" cellpadding="10">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>

                <?php foreach ($events as $event): ?>
                    <tr>

                        <td>
                            <?= htmlspecialchars($event['title']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($event['description']) ?>
                        </td>

                        <td>
                            <?= $event['event_date'] ?>
                        </td>

                        <td>
        <span style="
            padding:4px 8px;
            border-radius:5px;
            background:#0056b3;
            color:white;
            font-size:12px;
        ">
            <?= htmlspecialchars($event['status']) ?>
        </span>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </section>

        <!-- NOTIFICATIONS -->
        <section class="notifications-section">
            <h3>Affairs Notifications</h3>
            <ul>
                <li>Check out upcoming student activities.</li>
                <li>Register early to secure your slot.</li>
                <li>Stay updated on campus events.</li>
            </ul>
        </section>

    </main>
    ```
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
</footer>
<script>

    // Function to toggle the sidebar visibility
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('hidden');
    }
</script>
</body>
</html>
