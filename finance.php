<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'grafino', '3307');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//  HANDLE FORM SUBMIT FIRST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['users'])) {

    foreach ($_POST['users'] as $user_id => $user_data) {

        $stmt = $conn->prepare("UPDATE users SET  
            program_fees=?, paid_fees=?
            WHERE user_id=?");

        $stmt->bind_param(
            "ssssdddi",
            $user_data['username'],
            $user_data['full_name'],
            $user_data['school'],
            $user_data['course'],
            $user_data['program_fees'],
            $user_data['paid_fees'],
            $user_data['balance'],
            $user_id
        );

        $stmt->execute();
    }

    header("Location: students.php");
    exit();
}

//  FETCH DATA
$result = $conn->query("SELECT * FROM users");

if (!$result) {
    die("Error fetching data: " . $conn->error);
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Students</title>
        <link rel="stylesheet" href="styles.css">

        <style>
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
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                background: #f4f6f9;
            }

            header {
                background: #284ca7;
                color: white;
                padding: 15px;
                text-align: center;
            }

            .main {
                padding: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                background: white;
            }

            th, td {
                padding: 10px;
                border: 1px solid #ddd;
            }

            th {
                background: #284ca7;
                color: white;
            }

            tr:nth-child(even) {
                background: #f2f2f2;
            }

            input {
                width: 100%;
                padding: 5px;
                box-sizing: border-box;
            }

            button {
                margin-top: 15px;
                padding: 10px 20px;
                background: #284ca7;
                color: white;
                border: none;
                cursor: pointer;
            }

            button:hover {
                background: #1d3a82;
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

        <div class="main">

            <h2>Manage Students</h2>

            <table>
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>School</th>
                    <th>Course</th>
                    <th>Program Fees</th>
                    <th>Paid Fees</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <form method="POST">



                            <td><?= htmlspecialchars($row['username'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['full_name'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['school'] ?? '') ?></td>
                            <td><?= htmlspecialchars($row['course'] ?? '') ?></td>

                            <td>
                                <input type="number" step="0.01" name="program_fees"
                                       value="<?= $row['program_fees'] ?>">
                            </td>

                            <td>
                                <input type="number" step="0.01" name="paid_fees"
                                       value="<?= $row['paid_fees'] ?>">
                            </td>
                            <td><?= htmlspecialchars($row['balance'] ?? '') ?></td>


                            <td>
                                <button type="submit" name="update">Save</button>
                            </td>

                        </form>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

        </div>

        <footer style="text-align:center; padding:10px;">
            &copy; <?= date("Y"); ?> University Clearance System
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

<?php $conn->close(); ?>