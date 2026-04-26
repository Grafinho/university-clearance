<?php
require 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid payment ID.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM payments WHERE id = :id");
$stmt->execute(['id' => $id]);
$payment = $stmt->fetch();

if (!$payment) {
    die("Payment not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $service = $_POST['service'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $updateStmt = $pdo->prepare("UPDATE payments SET student_name = :student_name, service = :service, amount = :amount, date = :date WHERE id = :id");
    $updateStmt->execute([
        'student_name' => $student_name,
        'service' => $service,
        'amount' => $amount,
        'date' => $date,
        'id' => $id
    ]);

    echo "<script>alert('Payment updated successfully!'); window.location.href='adminpage.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Payment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Edit Payment</h2>
<form method="POST">
    <label>Student Name:</label>
    <input type="text" name="student_name" value="<?php echo $payment['student_name']; ?>" required><br>

    <label>Service:</label>
    <input type="text" name="service" value="<?php echo $payment['service']; ?>" required><br>

    <label>Amount:</label>
    <input type="number" name="amount" value="<?php echo $payment['amount']; ?>" required><br>

    <label>Date:</label>
    <input type="date" name="date" value="<?php echo $payment['date']; ?>" required><br>

    <button type="submit">Update</button>
</form>
</body>
</html>
