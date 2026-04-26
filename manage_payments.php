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

// Check if user is admin (non_students table)
$sql_check = "SELECT * FROM non_students WHERE username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$is_admin = ($stmt_check->get_result()->num_rows > 0);
$stmt_check->close();

// ============================
// HANDLE UPDATE (Solo Admin)
// ============================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_payment']) && $is_admin) {

    $id                = intval($_POST['id']);
    $payment_method    = trim($_POST['payment_method']);
    $bank_name         = trim($_POST['bank_name']);
    $branch            = trim($_POST['branch']);
    $account_number    = trim($_POST['account_number']);
    $amount            = floatval($_POST['amount']);
    $transaction_id    = trim($_POST['transaction_id']);
    $confirmation_code = trim($_POST['confirmation_code']);
    $phone_number      = trim($_POST['phone_number']);
    $payment_status    = trim($_POST['payment_status']);

    $update_sql = "
        UPDATE payments 
        SET payment_method = ?, bank_name = ?, branch = ?, account_number = ?,
            amount = ?, transaction_id = ?, confirmation_code = ?, 
            phone_number = ?, payment_status = ?
        WHERE id = ?
    ";

    $stmt = $conn->prepare($update_sql);

    if ($stmt) {
        $stmt->bind_param(
            "ssssdssssi",
            $payment_method, $bank_name, $branch, $account_number,
            $amount, $transaction_id, $confirmation_code,
            $phone_number, $payment_status, $id
        );

        if ($stmt->execute()) {
            $success_msg = "Payment updated successfully!";
        } else {
            $error_msg = "Error updating payment: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_msg = "Prepare failed: " . $conn->error;
    }
}

// ============================
// FETCH PAYMENTS
// ============================
if ($is_admin) {
    $sql = "SELECT * FROM payments ORDER BY transaction_date DESC";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM payments WHERE username = ? ORDER BY transaction_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
}

$stmt->execute();
$result = $stmt->get_result();
?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Payments - University Clearance System</title>
        <link rel="stylesheet" href="styles.css">
        <style>

            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
            }
            .main-content {
                margin-left: 250px;
                padding: 20px;
            }
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
                padding: 6px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .btn-save {
                background-color: #28a745;
                color: white;
                border: none;
                padding: 8px 12px;
                border-radius: 4px;
                cursor: pointer;
            }
            .btn-save:hover {
                background-color: #218838;
            }

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
        <h1>University Clearance System - Payments</h1>
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

    <main>
        <h2>Payment Records</h2>

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
                    <th>Payment Method</th>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>Account Number</th>
                    <th>Amount</th>
                    <th>Transaction ID</th>
                    <th>Confirmation Code</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <?php if ($is_admin): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <form method="POST">
                            <td><?= htmlspecialchars($row['username']) ?></td>

                            <td>
                                <select name="payment_method" <?= !$is_admin ? 'disabled' : '' ?>>
                                    <option value="MPESA" <?= $row['payment_method'] === 'MPESA' ? 'selected' : '' ?>>MPESA</option>
                                    <option value="Credit Card" <?= $row['payment_method'] === 'Credit Card' ? 'selected' : '' ?>>Credit Card</option>
                                    <option value="Bank Transfer" <?= $row['payment_method'] === 'Bank Transfer' ? 'selected' : '' ?>>Bank Transfer</option>
                                </select>
                            </td>
                            <td><input type="text" name="bank_name" value="<?= htmlspecialchars($row['bank_name'] ?? '') ?>" <?= !$is_admin ? 'readonly' : '' ?>></td>
                            <td><input type="text" name="branch" value="<?= htmlspecialchars($row['branch'] ?? '') ?>" <?= !$is_admin ? 'readonly' : '' ?>></td>
                            <td><input type="text" name="account_number" value="<?= htmlspecialchars($row['account_number'] ?? '') ?>" <?= !$is_admin ? 'readonly' : '' ?>></td>
                            <td><input type="number" step="0.01" name="amount" value="<?= $row['amount'] ?>" <?= !$is_admin ? 'readonly' : '' ?>></td>
                            <td><input type="text" name="transaction_id" value="<?= htmlspecialchars($row['transaction_id'] ?? '') ?>" <?= !$is_admin ? 'readonly' : '' ?>></td>
                            <td><input type="text" name="confirmation_code" value="<?= htmlspecialchars($row['confirmation_code'] ?? '') ?>" <?= !$is_admin ? 'readonly' : '' ?>></td>
                            <td><input type="text" name="phone_number" value="<?= htmlspecialchars($row['phone_number'] ?? '') ?>" <?= !$is_admin ? 'readonly' : '' ?>></td>

                            <td>
                                <select name="payment_status" <?= !$is_admin ? 'disabled' : '' ?>>
                                    <option value="Pending" <?= $row['payment_status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Completed" <?= $row['payment_status'] === 'Completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="Failed" <?= $row['payment_status'] === 'Failed' ? 'selected' : '' ?>>Failed</option>
                                </select>
                            </td>

                            <?php if ($is_admin): ?>
                                <td>
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="update_payment" class="btn-save">Save</button>
                                </td>
                            <?php endif; ?>
                        </form>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No payment records found.</p>
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