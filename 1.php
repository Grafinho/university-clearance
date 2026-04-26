<?php
session_start();

ini_set('display_errors', 1);
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

// ✅ FETCH DATA (THIS WAS MISSING)
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching data: " . $conn->error);
}

// ✅ HANDLE FORM SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['users'])) {

    foreach ($_POST['users'] as $user_id => $user_data) {

        $stmt = $conn->prepare("UPDATE users SET 
            username=?, 
            full_name=?, 
            email=?, 
            school=?, 
            course=?, 
            program_fees=?, 
            paid_fees=?, 
            hostel_name=?, 
            room_no=? 
            WHERE user_id=?");

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // ✅ FIXED TYPES (room_no is string now)
        $stmt->bind_param("sssssddssi",
                $user_data['username'],
                $user_data['full_name'],
                $user_data['email'],
                $user_data['school'],
                $user_data['course'],
                $user_data['program_fees'],
                $user_data['paid_fees'],
                $user_data['hostel_name'],
                $user_data['room_no'],
                $user_id
        );

        $stmt->execute();
    }

    header("Location: students.php");
    exit();
}
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
                <li><a href="home.php">Home</a></li>
                <li><a href="departments.html">Departments</a></li>
                <li><a href="requests.php">Requests</a></li>
                <li><a href="upload2.php">Upload Documents</a></li>
                <li><a href="payment.html">Payment</a></li>
                <li><a href="support.php">Help & Support</a></li>
                <li><a href="settings.html">Settings</a></li>
            </ul>
        </nav>
    </aside>

    <h2>Manage Students</h2>
    <form method="post">
        <table>
            <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>School</th>
                <th>Course</th>
                <th>Program Fees</th>
                <th>Paid Fees</th>
                <th>Hostel</th>
                <th>Room No</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><input type="text" name="users[<?php echo $row['user_id']; ?>][username]" value="<?php echo htmlspecialchars($row['username']); ?>" required></td>
                    <td><input type="text" name="users[<?php echo $row['user_id']; ?>][full_name]" value="<?php echo htmlspecialchars($row['full_name']); ?>"></td>
                    <td><input type="email" name="users[<?php echo $row['user_id']; ?>][email]" value="<?php echo htmlspecialchars($row['email']); ?>"></td>
                    <td><input type="text" name="users[<?php echo $row['user_id']; ?>][school]" value="<?php echo htmlspecialchars($row['school']); ?>"></td>
                    <td><input type="text" name="users[<?php echo $row['user_id']; ?>][course]" value="<?php echo htmlspecialchars($row['course']); ?>"></td>
                    <td><input type="number" step="0.01" name="users[<?php echo $row['user_id']; ?>][program_fees]" value="<?php echo htmlspecialchars($row['program_fees']); ?>"></td>
                    <td><input type="number" step="0.01" name="users[<?php echo $row['user_id']; ?>][paid_fees]" value="<?php echo htmlspecialchars($row['paid_fees']); ?>"></td>
                    <td><input type="text" name="users[<?php echo $row['user_id']; ?>][hostel_name]" value="<?php echo htmlspecialchars($row['hostel_name']); ?>"></td>
                    <td><input type="text" name="users[<?php echo $row['user_id']; ?>][room_no]" value="<?php echo htmlspecialchars($row['room_no']); ?>"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit">Save Changes</button>

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
