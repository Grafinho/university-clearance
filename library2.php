<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$host = '127.0.0.1';
$port = '3306';
$db_username = 'root';
$db_password = '';
$db_name = 'grafino';

//  CREATE CONNECTION (THIS WAS MISSING)
$conn = new mysqli($host, $db_username, $db_password, $db_name, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch logged-in username
$username = $_SESSION['username'];

//  CHECK IF USER IS NON-STUDENT
$sql_check_non_student = "SELECT * FROM non_students WHERE username = ?";
$stmt_check = $conn->prepare($sql_check_non_student);

if (!$stmt_check) {
    die("Prepare failed: " . $conn->error);
}

$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

$is_non_student = ($result_check && $result_check->num_rows > 0);
//  HANDLE UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {

    $id = $_POST['id'];
    $item_name = $_POST['item_name'];
    $quantity_lost = $_POST['quantity_lost'];
    $cost_of_item = $_POST['cost_of_item'];
    $fine = $_POST['fine'];
    $status = $_POST['status'];
    $comments = $_POST['comments'];

    $update_sql = "UPDATE library 
                   SET item_name=?, quantity_lost=?, cost_of_item=?, fine=?, status=?, comments=? 
                   WHERE id=?";

    $stmt_update = $conn->prepare($update_sql);

    $stmt_update->bind_param(
            "siddssi",
            $item_name,
            $quantity_lost,
            $cost_of_item,
            $fine,
            $status,
            $comments,
            $id
    );

    if ($stmt_update->execute()) {
        echo "<p style='color:green;'>Record updated successfully</p>";
    } else {
        echo "<p style='color:red;'>Update failed</p>";
    }
}
//  FETCH RECORDS
if ($is_non_student) {
    // Non-students: view all
    $sql = "SELECT * FROM library";
    $stmt = $conn->prepare($sql);
} else {
    // Students: view only theirs
    $sql = "SELECT * FROM library WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
}

// Execute query
$stmt->execute();
$result = $stmt->get_result();

// Check query success
if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records - University Clearance System</title>
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
    <style>
        table {
            width: 100%;
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
        <h2>Student Records</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Department</th>
                    <th>Item Name</th>
                    <th>Quantity Lost</th>
                    <th>Cost of Item</th>
                    <th>Fine</th>
                    <th>Status</th>
                    <th>Comments</th>
                </tr>
                </thead>

                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <form method="POST">

                            <input type="hidden" name="id" value="<?= $row['id']; ?>">

                            <td><?= htmlspecialchars($row['username'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['full_name'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['department'] ?? '') ?></td>

                            <td>
                                <input type="text" name="item_name" value="<?= htmlspecialchars($row['item_name'] ?? '') ?>">
                            </td>

                            <td>
                                <input type="number" name="quantity_lost" value="<?= $row['quantity_lost'] ?>">
                            </td>

                            <td>
                                <input type="number" step="0.01" name="cost_of_item" value="<?= $row['cost_of_item'] ?>">
                            </td>

                            <td>
                                <input type="number" step="0.01" name="fine" value="<?= $row['fine'] ?>">
                            </td>

                            <td>
                                <select name="status">
                                    <option value="Pending" <?= ($row['status']=='Pending')?'selected':'' ?>>Pending</option>
                                    <option value="Cleared" <?= ($row['status']=='Cleared')?'selected':'' ?>>Cleared</option>
                                    <option value="Not Cleared" <?= ($row['status']=='Not Cleared')?'selected':'' ?>>Not Cleared</option>
                                </select>
                            </td>

                            <td>
                                <input type="text" name="comments" value="<?= htmlspecialchars($row['comments'] ?? '') ?>">
                            </td>

                            <td>
                                <button type="submit" name="update">Save</button>
                            </td>

                        </form>
                    </tr>
                <?php endwhile; ?>
                </tbody>

            </table>
        <?php else: ?>
            <p>No student records found.</p>
        <?php endif; ?>
    </main>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
</footer>


<script src="script.js"></script>
<script>

    // Function to toggle the sidebar visibility
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
