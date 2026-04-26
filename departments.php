<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set("log_errors", 1);
ini_set("error_log", "C:/xampp/php/php_error.log"); // Replace with your path

$host = 'localhost';
$db_username = 'root';
$db_password = 'kobifora';
$db_name = 'grafinho';

try {
    $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $db_username, $db_password, $options); // Correctly initialize $pdo

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fullName = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $requestCode = filter_input(INPUT_POST, 'Request-code', FILTER_SANITIZE_NUMBER_INT);
        $requestDescription = filter_input(INPUT_POST, 'Request-Description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $comments = filter_input(INPUT_POST, 'Comments', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($username) || empty($fullName) || empty($department) || empty($requestCode) || empty($requestDescription)) {
            die("Please fill in all required fields.");
        }

        $stmt = $pdo->prepare("INSERT INTO requests (username, full_name, department, request_code, request_description, comments) 
                                VALUES (:username, :full_name, :department, :request_code, :request_description, :comments)");

        if (!$stmt) {
            $errorInfo = $pdo->errorInfo();
            error_log("Prepare statement error: " . $errorInfo[2] . " (SQLSTATE: " . $errorInfo[0] . ")");
            http_response_code(500);
            die("A database error occurred. Please check the logs.");
        }

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':full_name', $fullName, PDO::PARAM_STR);
        $stmt->bindValue(':department', $department, PDO::PARAM_STR);
        $stmt->bindValue(':request_code', $requestCode, PDO::PARAM_INT);
        $stmt->bindValue(':request_description', $requestDescription, PDO::PARAM_STR);
        $stmt->bindValue(':comments', $comments, PDO::PARAM_STR);

        $result = $stmt->execute();

        if (!$result) {
            $errorInfo = $stmt->errorInfo();
            error_log("Execute statement error: " . $errorInfo[2] . " (SQLSTATE: " . $errorInfo[0] . ")");
            http_response_code(500);
            die("A database error occurred. Please check the logs.");
        } else {
            header("Location: departments.html?success=1");
            exit();
        }
    }
} catch (PDOException $e) {
    error_log("PDO Exception: " . $e->getMessage());
    http_response_code(500);
    die("A database error occurred. Please check the logs.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your stylesheet -->
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
</head>
<body>
<img src="http://localhost/university/university-clearance/unilogo.png" alt="University Logo" style="height: 80px;">

<!-- Hamburger Menu for Toggling Sidebar -->
<div class="hamburger-menu" onclick="toggleSidebar()">
    <div></div>
    <div></div>
    <div></div>
</div>

<!-- Header -->
<header style="text-align: center;">
    <h1>University Clearance System</h1>
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

<!-- Main Content -->
<main>
    <h2>Departments Clearance</h2>
    <p>Please Click on the departments below to see your details to proceed to clearance requests.</p>


    <!-- Departments Section -->
    <section class="departments-section">
        <h3>Select a Department</h3>
        <div class="departments-grid">
            <a href="arts.php"><button>Arts</button></a>
            <a href="business.php"><button>Business</button></a>
            <a href="catering.php"><button>Catering</button></a>
            <a href="computing.php"><button>Computing</button></a>
            <a href="comtech.php"><button>Comtech</button></a>
            <a href="education.php"><button>Education</button></a>
            <a href="engineering.php"><button>Engineering</button></a>
            <a href="estates.php"><button>Estates</button></a>
            <a href="farm.php"><button>Farm</button></a>
            <a href="halls.php"><button>Halls</button></a>
            <a href="ict.php"><button>ICT</button></a>
            <a href="laboratory.php"><button>Laboratory</button></a>
            <a href="law.php"><button>Law</button></a>
            <a href="library.php"><button>Library</button></a>
            <a href="medicine.php"><button>Medicine</button></a>
            <a href="science.php"><button>Science</button></a>
            <a href="security.php"><button>Security</button></a>
            <a href="transport.php"><button>Transport</button></a>
        </div>
    </section>

</main>

<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> University Clearance System</p>
</footer>

<script src="departments.js"></script> <!-- JavaScript for dynamic behavior -->

<script>

    // Function to toggle the sidebar visibility
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('hidden');
    }
</script>
</body>
</html>
