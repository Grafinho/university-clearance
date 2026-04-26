<?php
require 'config.php'; // Database connection

// Check if student ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid student ID.");
}

$id = $_GET['id'];

// Fetch student data
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute(['id' => $id]);
$student = $stmt->fetch();

if (!$student) {
    die("Student not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];

    // Update student details
    $updateStmt = $pdo->prepare("UPDATE students SET name = :name, student_id = :student_id, email = :email WHERE id = :id");
    $updateStmt->execute([
        'name' => $name,
        'student_id' => $student_id,
        'email' => $email,
        'id' => $id
    ]);

    echo "<script>alert('Student updated successfully!'); window.location.href='adminpage.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Edit Student</h2>
<form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br>

    <label>Student ID:</label>
    <input type="text" name="student_id" value="<?php echo $student['student_id']; ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>

    <button type="submit">Update</button>
</form>
</body>
</html>
