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

    $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $db_username, $db_password, $options);

} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("A database error occurred. Please try again later.");
}


if (!isset($_SESSION['username'])) {
    header("Location: adminlog.php");
    exit();
}

try {


    $username = $_SESSION['username'];


    $stmt = $pdo->prepare("
        SELECT full_name, department
        FROM non_students
        WHERE username = ?
        LIMIT 1
    ");

    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        error_log("User not found: username = " . $username);
        die("User not found.");
    }


    $data = [
            'full_name'  => htmlspecialchars($user['full_name']),
            'department' => htmlspecialchars($user['department']),
    ];

} catch (PDOException $e) {
    error_log("Database query error: " . $e->getMessage());
    die("A database error occurred. Please try again later.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - University Clearance System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your stylesheet -->
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #284ca7;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        footer {
            background-color: #284ca7;
            color: white;
            text-align: center;
            padding: 10px 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

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
        .main-content h2 {
            color: #284ca7;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            text-align: center;
        }
        header, footer {
            background-color: #284ca7;
            color: white;
            padding: 10px 20px;
        }
        .container {
            margin-top: 20px;
        }
        .btn {
            display: block;
            width: 200px;
            padding: 15px;
            margin: 10px auto;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<!-- Hamburger Menu for Toggling Sidebar -->
<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
</div>

<!-- Header -->
<header>
    <h1>Admin Dashboard</h1>
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
<section class="welcome-section">
    <h2>Welcome, <?php echo $data['full_name']; ?>!</h2>
</section>
<!-- Balance Section -->
<section class="balance-section">
    <h3>Department: Department of  <?php echo $data['department']; ?></h3>
</section>
<!-- Main Content -->
<div class="main-content">
    <a href="students.php" class="btn">Manage Students</a>
    <a href="staff.php" class="btn">Manage Staff</a>
    <a href="manage_payments.php" class="btn">Manage Payments</a>
    <a href="manage_documents.php" class="btn">Manage Documents</a>
    <a href="affairs.php" class="btn">Manage Notifications</a>
    <a href="manage_messages.php" class="btn">Manage Messages</a>
    <a href="manage_requests.php" class="btn">Manage Requests</a>
</div>

<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
</footer>
<script src="departments.js"></script> <!-- JavaScript for dynamic behavior -->

<script>

    // Function to toggle the sidebar visibility
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('hidden');
    }
</script>
</body>
</html>
