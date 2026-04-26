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

// ✅ CREATE CONNECTION (MISSING FIX)
$conn = new mysqli($host, $db_username, $db_password, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ CHECK ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request. No ID provided.");
}

$non_student_id = intval($_GET['id']);

// ✅ FETCH DATA
$sql = "SELECT * FROM non_students WHERE non_student_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $non_student_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    die("Record not found.");
}

$row = $result->fetch_assoc();

// ✅ HANDLE UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prevent undefined index errors
    $full_name = $_POST['full_name'] ?? '';
    $department = $_POST['department'] ?? '';
    $position = $_POST['position'] ?? '';
    $contact_email = $_POST['contact_email'] ?? '';

    $update_sql = "UPDATE non_students 
                   SET full_name=?, department=?, position=?, contact_email=? 
                   WHERE non_student_id=?";

    $update_stmt = $conn->prepare($update_sql);

    if (!$update_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $update_stmt->bind_param(
            "ssssi",
            $full_name,
            $department,
            $position,
            $contact_email,
            $non_student_id
    );

    if ($update_stmt->execute()) {
        echo "<script>
                alert('Record updated successfully!');
                window.location.href='staff.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Error updating record: " . $conn->error . "');
              </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Non-Student</title>
</head>
<body>

<h2>Edit Non-Student</h2>

<form method="POST" action="">
    <label>Full Name:</label>
    <input type="text" name="full_name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required><br>

    <label>Department:</label>
    <input type="text" name="department" value="<?php echo htmlspecialchars($row['department']); ?>"><br>

    <label>Position:</label>
    <input type="text" name="position" value="<?php echo htmlspecialchars($row['position']); ?>"><br>

    <label>Contact Email:</label>
    <input type="email" name="contact_email" value="<?php echo htmlspecialchars($row['contact_email']); ?>" required><br>

    <button type="submit">Update</button>
</form>

</body>
</html>

<?php
$conn->close();
?>
