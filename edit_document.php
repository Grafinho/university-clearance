<?php
require 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid document ID.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM documents WHERE id = :id");
$stmt->execute(['id' => $id]);
$document = $stmt->fetch();

if (!$document) {
    die("Document not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $document_type = $_POST['document_type'];
    $date_uploaded = $_POST['date_uploaded'];

    $updateStmt = $pdo->prepare("UPDATE documents SET student_name = :student_name, document_type = :document_type, date_uploaded = :date_uploaded WHERE id = :id");
    $updateStmt->execute([
        'student_name' => $student_name,
        'document_type' => $document_type,
        'date_uploaded' => $date_uploaded,
        'id' => $id
    ]);

    echo "<script>alert('Document updated successfully!'); window.location.href='adminpage.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h2>Edit Document</h2>
<form method="POST">
    <label>Student Name:</label>
    <input type="text" name="student_name" value="<?php echo $document['student_name']; ?>" required><br>

    <label>Document Type:</label>
    <input type="text" name="document_type" value="<?php echo $document['document_type']; ?>" required><br>

    <label>Date Uploaded:</label>
    <input type="date" name="date_uploaded" value="<?php echo $document['date_uploaded']; ?>" required><br>

    <button type="submit">Update</button>
</form>
</body>
</html>
