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

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username'];

    $stmt = $pdo->prepare("SELECT full_name FROM non_students WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        die("User not found.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
        $event_id = $_POST['event_id'];

        $stmt = $pdo->prepare("
            INSERT IGNORE INTO affairs_registrations (username, event_id)
            VALUES (?, ?)
        ");
        $stmt->execute([$username, $event_id]);

        $message = "Successfully registered for the event!";
    }

    $stmt = $pdo->query("SELECT * FROM affairs_events ORDER BY event_date ASC");
    $events = $stmt->fetchAll();

    $stmt = $pdo->prepare("SELECT event_id FROM affairs_registrations WHERE username = ?");
    $stmt->execute([$username]);
    $registeredEvents = $stmt->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$data = [
        'full_name' => htmlspecialchars($user['full_name']),
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_event'])) {
    $stmt = $pdo->prepare("
        UPDATE affairs_events
        SET title=?, description=?, event_date=?, status=?
        WHERE id=?
    ");
    $stmt->execute([
            $_POST['title'],
            $_POST['description'],
            $_POST['event_date'],
            $_POST['status'],
            $_POST['event_id']
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_event'])) {
    $stmt = $pdo->prepare("DELETE FROM affairs_events WHERE id=?");
    $stmt->execute([$_POST['event_id']]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_event'])) {
    $stmt = $pdo->prepare("
        INSERT INTO affairs_events (title, description, event_date, status)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([
            $_POST['title'],
            $_POST['description'],
            $_POST['event_date'],
            $_POST['status']
    ]);
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
        body.light {
            background: #f4f4f4;
            color: #000;
        }

        body.dark {
            background: #121212;
            color: #fff;
        }

    </style>
</head>
<body class="<?= $theme ?>">
<img src="http://localhost/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
</div>

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
        <section class="welcome-section">
            <h2>Welcome, <?php echo $data['full_name']; ?>!</h2>
            <p>Student Affairs - Events & Planning</p>
        </section>

        <?php if (!empty($message)): ?>
            <p style="color: green;"><?php echo $message; ?></p>
        <?php endif; ?>

        <section class="progress-section">
            <h3>Manage Events</h3>
            <h4>Add New Event</h4>
            <form method="POST">
                <input type="text" name="title" placeholder="Title" required>
                <input type="text" name="description" placeholder="Description" required>
                <input type="date" name="event_date" required>

                <select name="status">
                    <option value="Upcoming">Upcoming</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Completed">Completed</option>
                </select>

                <button name="add_event">Add Event</button>
            </form>
            <table border="1" width="100%" cellpadding="10">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($events as $event): ?>
                    <tr>
                        <form method="POST">
                            <td>
                                <input type="text" name="title" value="<?php echo htmlspecialchars($event['title']); ?>">
                            </td>
                            <td>
                                <input type="text" name="description" value="<?php echo htmlspecialchars($event['description']); ?>">
                            </td>
                            <td>
                                <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>">
                            </td>
                            <td>
                                <select name="status">
                                    <option value="Upcoming" <?php if($event['status']=='Upcoming') echo 'selected'; ?>>Upcoming</option>
                                    <option value="Ongoing" <?php if($event['status']=='Ongoing') echo 'selected'; ?>>Ongoing</option>
                                    <option value="Completed" <?php if($event['status']=='Completed') echo 'selected'; ?>>Completed</option>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                <button name="update_event">Update</button>
                                <button name="delete_event" onclick="return confirm('Delete this event?')">Delete</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section class="notifications-section">
            <h3>Affairs Notifications</h3>
            <ul>
                <li>Check out upcoming student activities.</li>
                <li>Register early to secure your slot.</li>
                <li>Stay updated on campus events.</li>
            </ul>
        </section>
    </main>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
</footer>

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('hidden');
    }
</script>
</body>
</html>