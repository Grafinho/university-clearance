<?php
session_start();
$config = include 'config1.php';

try {
    $pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4", $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['type'])) {
    $id = intval($_POST['id']);
    $type = $_POST['type'];

    $table = "";
    switch ($type) {
        case "student":
            $table = "students";
            break;
        case "document":
            $table = "documents";
            break;
        case "payment":
            $table = "payments";
            break;
        default:
            die("Invalid request");
    }

    $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
