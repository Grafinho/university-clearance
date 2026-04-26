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

// Create connection
$conn = new mysqli($host, $db_username, $db_password, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Check if user is non-student (has broader access)
$sql_check_non_student = "SELECT * FROM non_students WHERE username = ?";
$stmt_check = $conn->prepare($sql_check_non_student);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$is_non_student = ($result_check->num_rows > 0);

// ====================== HANDLE UPDATE ======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $request_code = (int)$_POST['request_code'];
    $request_description = $_POST['request_description'];
    $comments = $_POST['comments'];
    $status = $_POST['status'];

    $stmt_update = $conn->prepare("UPDATE requests SET request_code=?, request_description=?, comments=?, status=? WHERE id=?");
    $stmt_update->bind_param("isssi", $request_code, $request_description, $comments, $status, $id);

    if ($stmt_update->execute()) {
        $message = "Request updated successfully!";
    } else {
        $message = "Update failed: " . $conn->error;
    }
}

// ====================== FETCH RECORDS ======================
if ($is_non_student) {
    // Non-students see all requests
    $sql = "SELECT * FROM requests ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
} else {
    // Regular users see only their own requests
    $sql = "SELECT * FROM requests WHERE username = ? ORDER BY created_at DESC";
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
        <title>Manage Requests - University Clearance System</title>
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
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
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
            tr:nth-child(even) { background-color: #f2f2f2; }
            tr:hover { background-color: #ddd; }
            input, select, textarea {
                width: 100%;
                padding: 6px;
                box-sizing: border-box;
            }
            .message {
                padding: 10px;
                margin: 10px 0;
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
                border-radius: 4px;
            }
        </style>
    </head>
    <body>
    <img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

    <!-- Hamburger Menu -->
    <div class="hamburger-menu" onclick="toggleSidebar()">
        <div></div><div></div><div></div>
    </div>

    <div class="main-content" id="main-content">
        <header>
            <div class="header-content">
                <h1>University Clearance System</h1>
            </div>
        </header>

        <!-- Sidebar Navigation -->
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
            <h2>Manage Requests</h2>

            <?php if (isset($message)): ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Request Code</th>
                        <th>Description</th>
                        <th>Comments</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= htmlspecialchars($row['full_name']) ?></td>
                                <td><?= htmlspecialchars($row['department']) ?></td>

                                <td>
                                    <input type="number" name="request_code" value="<?= htmlspecialchars($row['request_code']) ?>" required>
                                </td>
                                <td>
                                    <textarea name="request_description" rows="2"><?= htmlspecialchars($row['request_description']) ?></textarea>
                                </td>
                                <td>
                                    <textarea name="comments" rows="2"><?= htmlspecialchars($row['comments'] ?? '') ?></textarea>
                                </td>
                                <td>
                                    <select name="status">
                                        <option value="Pending" <?= ($row['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                                        <option value="Approved" <?= ($row['status'] == 'Approved') ? 'selected' : '' ?>>Approved</option>
                                        <option value="Rejected" <?= ($row['status'] == 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                                        <option value="Cleared" <?= ($row['status'] == 'Cleared') ? 'selected' : '' ?>>Cleared</option>
                                    </select>
                                </td>
                                <td><?= $row['created_at'] ?></td>
                                <td>
                                    <button type="submit" name="update">Save</button>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No requests found.</p>
            <?php endif; ?>
        </main>
    </div>

    <footer>
        <p>&copy; <?= date("Y") ?> University Clearance System</p>
    </footer>

    <script src="script.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>
    </body>
    </html>

<?php
$conn->close();
?>