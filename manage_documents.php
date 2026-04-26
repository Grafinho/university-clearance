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

// Check if user is non-student (admin-level access)
$sql_check = "SELECT * FROM non_students WHERE username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$is_non_student = ($result_check->num_rows > 0);

// ====================== HANDLE UPDATE ======================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $document_type = $_POST['document_type'];
    $title = $_POST['title'];

    $stmt_update = $conn->prepare("UPDATE uploaded_files SET document_type=?, title=? WHERE id=?");
    $stmt_update->bind_param("ssi", $document_type, $title, $id);

    if ($stmt_update->execute()) {
        $message = "Document updated successfully!";
    } else {
        $message = "Update failed: " . $conn->error;
    }
}

// ====================== FETCH RECORDS ======================
if ($is_non_student) {
    // Non-students see all uploaded documents
    $sql = "SELECT * FROM uploaded_files ORDER BY uploaded_at DESC";
    $stmt = $conn->prepare($sql);
} else {
    // Students see only their own documents
    $sql = "SELECT * FROM uploaded_files WHERE student_id = ? ORDER BY uploaded_at DESC";
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
        <title>Manage Documents - University Clearance System</title>
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
            .download-link {
                color: #0066cc;
                text-decoration: underline;
            }
            .download-link:hover {
                color: #004499;
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
            <h2>Manage Uploaded Documents</h2>

            <?php if (isset($message)): ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Document Type</th>
                        <th>Title</th>
                        <th>File Type</th>
                        <th>File Size (KB)</th>
                        <th>Uploaded At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['student_id']) ?></td>
                                <td><?= htmlspecialchars($row['student_name']) ?></td>

                                <td>
                                    <input type="text" name="document_type"
                                           value="<?= htmlspecialchars($row['document_type']) ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="title"
                                           value="<?= htmlspecialchars($row['title']) ?>" required>
                                </td>

                                <td><?= htmlspecialchars($row['file_type']) ?></td>
                                <td><?= number_format($row['file_size'] / 1024, 2) ?> KB</td>
                                <td><?= $row['uploaded_at'] ?></td>

                                <td>
                                    <!-- Download Link -->
                                    <a href="download.php?id=<?= $row['id'] ?>" class="download-link" target="_blank">Download</a><br><br>
                                    <button type="submit" name="update">Save</button>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No documents found.</p>
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