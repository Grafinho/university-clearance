<?php
global $result;
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
    // CREATE CONNECTION
    $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4";

    $pdo = new PDO($dsn, $db_username, $db_password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // FETCH DATA
    $stmt = $pdo->query("SELECT * FROM non_students");
    $rows = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<?php
// assume $rows is already fetched from database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Records - University Clearance System</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        .sidebar.hidden {
            display: none;
        }

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

        .hamburger-menu:hover div {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #284ca7;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>

<img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<!-- Hamburger Menu -->
<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
</div>

<div class="main-content">

    <header>
        <h1>University Clearance System</h1>
    </header>

    <!-- Sidebar -->
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

    <h2>Staff Records</h2>

    <?php if (!empty($rows)): ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Department</th>
                <th>Position</th>
                <th>Email</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['non_student_id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['username'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['full_name'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['role_id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['department'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['position'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['contact_email'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['created_at'] ?? '') ?></td>
                    <td>
                        <a href="edit_staff.php?id=<?= $row['non_student_id'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>No records found.</p>
    <?php endif; ?>

    <footer>
        <p>&copy; <?= date("Y"); ?> University Clearance System</p>
    </footer>

</div>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('hidden');
    }
</script>

</body>
</html>
