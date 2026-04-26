<?php
session_start();

$config = include 'config.php'; // Ensure this file contains database credentials.

try {
    // Establish the database connection
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $config['username'], $config['password'], $options);
} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    die("A database error occurred. Please try again later.");
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

try {
    // Fetch user data using username
    $username = $_SESSION['username'];
    $stmt = $pdo->prepare("SELECT full_name, balance FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        error_log("User not found: username = " . $username);
        die("User not found.");
    }

    // Define data for HTML
    $data = [
        'full_name' => htmlspecialchars($user['full_name']),
        'balance' => number_format($user['balance'], 2),
    ];

    // Update estates status based on balance
    $estates_status = $user['balance'] == 0 ? 'Approved' : 'Pending';
    $stmt = $pdo->prepare("UPDATE estates SET status = ? WHERE username = ?");
    $stmt->execute([$estates_status, $username]);

    // Fetch clearance statuses
    $departments = ['estates', 'library', 'engineering', 'education', 'law', 'medicine', 'business', 'science', 'security', 'farm', 'comtech', 'transport', 'halls'];
    $statuses = [];

    foreach ($departments as $department) {
        $stmt = $pdo->prepare("SELECT status FROM {$department} WHERE username = ?");
        $stmt->execute([$username]);
        $status = $stmt->fetchColumn();
        $statuses[$department] = $status ?: 'Pending'; // Default to 'Pending' if no status is found
    }
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
    <title>Home - University Clearance System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles here... */
    </style>
</head>
<body>
<!-- Sidebar -->
<nav id="sidebar">
    <ul>
        <li><a href="home_page.php">Home</a></li>
        <li><a href="departments.php">Departments</a></li>
        <li><a href="upload-documents.php">Upload Documents</a></li>
        <li><a href="payment.php">Payment</a></li>
        <li><a href="help-support.php">Help & Support</a></li>
        <li><a href="settings.php">Settings</a></li>
    </ul>
</nav>

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

    <main>
        <!-- Welcome Section -->
        <section class="welcome-section">
            <h2>Welcome, <?php echo $data['full_name']; ?>!</h2>
            <p>Your Clearance Dashboard</p>
        </section>

        <!-- Balance Section -->
        <section class="balance-section">
            <h3>Your Balance: KSh <?php echo $data['balance']; ?></h3>
        </section>

        <!-- Clearance Progress Section -->
        <section class="progress-section">
            <h3>Clearance Progress</h3>
            <div class="progress-bar-container">
                <div class="progress-bar">
                    <div class="progress-bar-fill" style="width: 40%;"></div>
                </div>
            </div>
            <ul>
                <?php foreach ($statuses as $department => $status): ?>
                    <li><?php echo ucfirst($department); ?>: <?php echo htmlspecialchars($status); ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <!-- Notifications Section -->
        <section class="notifications-section">
            <h3>Notifications</h3>
            <ul>
                <li>Library clearance approved.</li>
                <li>Estates clearance <?php echo $statuses['estates']; ?>: Outstanding balance KSh <?php echo $data['balance']; ?>.</li>
                <li>Engineering clearance pending: Documents missing.</li>
            </ul>
        </section>

        <!-- Estates Section -->
        <section class="section-box">
            <h4>Estates</h4>
            <p><?php echo $statuses['estates'] === 'Approved' ? "All dues cleared." : "Outstanding fees: KSh {$data['balance']}"; ?></p>
        </section>

        <!-- Library Section -->
        <section class="section-box">
            <h4>Library</h4>
            <p><?php echo $statuses['library']; ?></p>
        </section>

        <!-- Academic Section -->
        <section class="section-box">
            <h4>Academic</h4>
            <p>Thesis submission pending.</p>
        </section>
    </main>
</div>

<footer>
    <p>&copy; 2024 University Clearance System. All rights reserved.</p>
</footer>

<script>
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const hamburger = document.getElementById('hamburger');

    hamburger.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
        mainContent.classList.toggle('expanded');
    });
</script>
</body>
</html>