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

if (!isset($_GET['id'], $_GET['type'])) {
    die("Invalid request");
}

$id = intval($_GET['id']);
$type = $_GET['type'];

switch ($type) {
    case "document":
        $stmt = $pdo->prepare("SELECT * FROM documents WHERE id = ?");
        break;
    case "payment":
        $stmt = $pdo->prepare("SELECT * FROM payments WHERE id = ?");
        break;
    default:
        die("Invalid type");
}

$stmt->execute([$id]);
$record = $stmt->fetch();

if (!$record) {
    die("Record not found");
}

echo "<h2>Details</h2>";
foreach ($record as $key => $value) {
    echo "<p><strong>$key:</strong> $value</p>";
}
?>
<?php
