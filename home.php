<?php
session_start(); // Start session

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

    //  CHECK LOGIN
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    //  SESSION VALUE
    $username = $_SESSION['username'];

    //  FETCH USER DATA
    $stmt = $pdo->prepare("
        SELECT full_name, program_fees, paid_fees 
        FROM users 
        WHERE username = ?
    ");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user) {
        die("User not found.");
    }
    $stmt = $pdo->prepare("SELECT theme FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $theme = $stmt->fetchColumn() ?? 'light';
    //  CALCULATE BALANCE
    $balance = $user['program_fees'] - $user['paid_fees'];

    $data = [
            'full_name' => htmlspecialchars($user['full_name']),
            'balance' => number_format($balance, 2),
    ];

    //  UPDATE ESTATES STATUS
    $estates_status = ($balance == 0) ? 'Approved' : 'Pending';

    $stmt = $pdo->prepare("UPDATE estates SET status = ? WHERE username = ?");
    $stmt->execute([$estates_status, $username]);

    //  FETCH DEPARTMENT STATUSES
    $departments = [
            'estates', 'library', 'engineering', 'education',
            'law', 'medicine', 'business', 'science',
            'security', 'farm', 'comtech', 'transport', 'halls'
    ];

    $statuses = [];

    foreach ($departments as $department) {
        $stmt = $pdo->prepare("SELECT status FROM {$department} WHERE username = ?");
        $stmt->execute([$username]);
        $status = $stmt->fetchColumn();

        $statuses[$department] = $status ?: 'Approved';
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
$stmt = $pdo->query("SELECT * FROM affairs_events ORDER BY event_date ASC");
$events = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - University Clearance System</title>
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
                <li><a href="home.php">Home</a></li>
                <li><a href="departments.html">Departments</a></li>
                <li><a href="requests.php">Requests</a></li>
                <li><a href="upload2.php">Upload Documents</a></li>
                <li><a href="payment.html">Payment</a></li>
                <li><a href="support.php">Help & Support</a></li>
                <li><a href="settings.php">Settings</a></li>
            </ul>
        </nav>
    </aside>

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
        <h3>Clearance Progress</h3>

        <?php
        $approvedCount = count(array_filter($statuses, fn($status) => $status === 'Approved'));
        $totalCount = count($statuses);
        $progressPercentage = ($totalCount > 0) ? ($approvedCount / $totalCount) * 100 : 0;
        ?>

        <div style="background:#e0e0e0; border-radius:10px; width:100%; height:18px; overflow:hidden;">
            <div style="
                    width:<?= $progressPercentage ?>%;
                    height:100%;
                    background:linear-gradient(90deg,#007BFF,#00c6ff);
                    transition:0.5s;
                    "></div>
        </div>

        <p style="margin-top:5px; font-weight:600;">
            <?= round($progressPercentage) ?>% clearance completed
        </p>
        <ul style="list-style:none; padding:0; margin:0;">

            <?php foreach ($statuses as $department => $status): ?>

                <?php
                $pages = [
                        'estates' => 'estates.php',
                        'library' => 'library.php',
                        'engineering' => 'engineering.php',
                        'education' => 'education.php',
                        'law' => 'law.php',
                        'medicine' => 'medicine.php',
                        'business' => 'business.php',
                        'science' => 'science.php',
                        'security' => 'security.php',
                        'farm' => 'farm.php',
                        'comtech' => 'comtech.php',
                        'transport' => 'transport.php',
                        'halls' => 'halls.php'
                ];

                $link = $pages[$department] ?? '#';
                $color = ($status === 'Approved') ? '#1e7e34' : '#c82333';
                ?>

                <li style="margin:2px 0;">

                    <a href="<?= $link ?>" style="
                            display:flex;
                            justify-content:flex-start;
                            gap:10px;
                            padding:6px 10px;
                            text-decoration:none;
                            border-left:4px solid <?= $color ?>;
                            background: rgba(0,0,0,0.03);
                            font-weight:700;
                            font-size:14px;
                            color:#222;
                            border-radius:4px;
                            ">

            <span style="min-width:120px;">
                <?= ucfirst($department); ?>
            </span>

                        <span style="color:<?= $color ?>; font-weight:800;">
                <?= htmlspecialchars($status); ?>
            </span>

                    </a>

                </li>

            <?php endforeach; ?>

        </ul>
        <!-- Notifications Section -->
        <section class="notifications-section">
            <h3>Notifications</h3>
            <ul>

                <li>
                    Estates clearance <?php echo $statuses['estates'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Library clearance <?php echo $statuses['library'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Engineering clearance <?php echo $statuses['engineering'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Education clearance <?php echo $statuses['education'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Law clearance <?php echo $statuses['law'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Medicine clearance <?php echo $statuses['medicine'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Business clearance <?php echo $statuses['business'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Science clearance <?php echo $statuses['science'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Security clearance <?php echo $statuses['security'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Farm clearance <?php echo $statuses['farm'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Comtech clearance <?php echo $statuses['comtech'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Transport clearance <?php echo $statuses['transport'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

                <li>
                    Halls clearance <?php echo $statuses['halls'] ?? 'Pending'; ?>:
                    Fines Due KSh <?php echo $data['fine'] ?? 0; ?>.
                </li>

            </ul>
        </section>

        <!-- Events Section -->
        <section class="section-box">
            <h4>University Affairs Events</h4>

            <?php if (empty($events)): ?>
                <p>No events available at the moment.</p>
            <?php else: ?>

                <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:15px;">

                    <?php foreach ($events as $event): ?>

                        <a href="affairs2.php?id=<?php echo $event['id']; ?>"
                           style="text-decoration:none; color:inherit;">

                            <div style="
                        background:#ffffff;
                        border:1px solid #e0e0e0;
                        border-radius:12px;
                        padding:15px;
                        box-shadow:0 2px 8px rgba(0,0,0,0.08);
                        transition:0.3s;
                        cursor:pointer;
                    "
                                 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.15)'"
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.08)'"
                            >

                                <h3 style="margin:0 0 8px; color:#0056b3;">
                                    <?php echo htmlspecialchars($event['title']); ?>
                                </h3>

                                <p style="font-size:14px; color:#555; margin-bottom:10px;">
                                    <?php echo htmlspecialchars(substr($event['description'], 0, 80)); ?>...
                                </p>

                                <p style="font-size:13px; margin:5px 0;">
                                    📅 <?php echo $event['event_date']; ?>
                                </p>

                                <span style="
                            display:inline-block;
                            padding:5px 10px;
                            font-size:12px;
                            border-radius:20px;
                            background:#e6f0ff;
                            color:#0056b3;
                        ">
                            <?php echo htmlspecialchars($event['status']); ?>
                        </span>

                            </div>

                        </a>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </section>
    </main>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
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
