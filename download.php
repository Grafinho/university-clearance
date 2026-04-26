<?php
// download.php
$host = '127.0.0.1';
$port = '3307';
$db_username = 'root';
$db_password = '';
$db_name = 'grafino';

$conn = new mysqli($host, $db_username, $db_password, $db_name, $port);

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = $conn->prepare("SELECT title, file_data, file_type FROM uploaded_files WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        header("Content-Type: " . $row['file_type']);
        header("Content-Disposition: attachment; filename=\"" . $row['title'] . "\"");
        echo $row['file_data'];
        exit();
    }
}

echo "File not found.";
$conn->close();
?>