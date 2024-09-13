<?php 
require_once __DIR__ . '/../database/database_connection.php';

$crs_code = $_GET['id'] ?? '';

try {
    $statement = $pdo->prepare("DELETE FROM courses WHERE crs_code = :crs_code");

    $statement->bindParam(':crs_code', $crs_code, PDO::PARAM_INT);

    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
