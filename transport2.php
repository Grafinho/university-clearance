<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$host = '127.0.0.1';
$port = '3307';
$db_username = 'root';
$db_password = '';
$db_name = 'grafino';

$conn = new mysqli($host, $db_username, $db_password, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login check
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Check if user is non-student (admin/staff)
$sql_check = "SELECT * FROM non_students WHERE username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$is_non_student = ($stmt_check->get_result()->num_rows > 0);
$stmt_check->close();

// ============================
// HANDLE UPDATE (Solo para non-students)
// ============================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']) && $is_non_student) {

    $id            = intval($_POST['id']);
    $route         = trim($_POST['route']);
    $pending_fare  = floatval($_POST['pending_fare']);
    $status        = trim($_POST['status']);
    $comments      = trim($_POST['comments']);

    $update_sql = "
        UPDATE transport 
        SET route = ?, pending_fare = ?, status = ?, comments = ? 
        WHERE id = ?
    ";

    $stmt = $conn->prepare($update_sql);

    if ($stmt) {
        $stmt->bind_param("sdssi", $route, $pending_fare, $status, $comments, $id);

        if ($stmt->execute()) {
            $success_msg = "Record updated successfully!";
        } else {
            $error_msg = "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_msg = "Prepare failed: " . $conn->error;
    }
}

// ============================
// FETCH RECORDS
// ============================
if ($is_non_student) {
    // Non-students see all records
    $sql = "SELECT * FROM transport ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
} else {
    // Students see only their own records
    $sql = "SELECT * FROM transport WHERE username = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
}

$stmt->execute();
$result = $stmt->get_result();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transport Records - University Clearance System</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            body { font-family: Arial, sans-serif; background-color: #f8f9fa; }
            .main-content { margin-left: 250px; padding: 20px; }

            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                background: white;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            th, td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: #284ca7;
                color: white;
            }
            tr:nth-child(even) { background-color: #f9f9f9; }
            tr:hover { background-color: #f1f1f1; }

            input[type="text"], input[type="number"], select {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .btn-save {
                background-color: #28a745;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 4px;
                cursor: pointer;
            }
            .btn-save:hover { background-color: #218838; }

            .alert {
                padding: 12px;
                margin: 15px 0;
                border-radius: 4px;
            }
            .alert-success { background-color: #d4edda; color: #155724; }
            .alert-danger  { background-color: #f8d7da; color: #721c24; }

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

<img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<!-- Hamburger Menu -->
<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
</div>

<div class="main-content" id="main-content">
    <header>
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
        <h2>Transport Records</h2>

        <?php if (isset($success_msg)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success_msg) ?></div>
        <?php endif; ?>

        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_msg) ?></div>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Department</th>
                    <th>Route</th>
                    <th>Pending Fare</th>
                    <th>Status</th>
                    <th>Comments</th>
                    <?php if ($is_non_student): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">

                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['full_name'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['department'] ?? '') ?></td>

                            <td>
                                <input type="text" name="route"
                                       value="<?= htmlspecialchars($row['route'] ?? '') ?>"
                                        <?= !$is_non_student ? 'readonly' : '' ?>>
                            </td>

                            <td>
                                <input type="number" step="0.01" name="pending_fare"
                                       value="<?= $row['pending_fare'] ?? 0 ?>"
                                        <?= !$is_non_student ? 'readonly' : '' ?>>
                            </td>

                            <td>
                                <select name="status" <?= !$is_non_student ? 'disabled' : '' ?>>
                                    <option value="Pending" <?= ($row['status'] ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Cleared" <?= ($row['status'] ?? '') === 'Cleared' ? 'selected' : '' ?>>Cleared</option>
                                </select>
                            </td>

                            <td>
                                <input type="text" name="comments"
                                       value="<?= htmlspecialchars($row['comments'] ?? '') ?>"
                                        <?= !$is_non_student ? 'readonly' : '' ?>>
                            </td>

                            <?php if ($is_non_student): ?>
                                <td>
                                    <button type="submit" name="update" class="btn-save">Save</button>
                                </td>
                            <?php endif; ?>
                        </form>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No transport records found.</p>
        <?php endif; ?>
    </main>
</div>

<footer>
    <p>&copy; <?= date("Y") ?> University Clearance System</p>
</footer>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('hidden');
    }
</script>

<?php
$conn->close();
?>