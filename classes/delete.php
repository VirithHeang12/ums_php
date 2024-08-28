<?php 
require_once __DIR__ . '/../database/database_connection.php';

$class_code = $_GET['id'] ?? '';

try {
    $statement = $pdo->prepare("DELETE FROM classes WHERE class_code = :class_code");

    $statement->bindParam(':class_code', $class_code, PDO::PARAM_INT);

    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>