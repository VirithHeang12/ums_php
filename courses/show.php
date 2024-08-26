<?php 
require_once __DIR__ . '/../config/database_connection.php';

try {
    $statement = $pdo->prepare("SELECT * FROM courses");
    $statement->execute();
    $courses = $statement->fetchAll();
} catch (PDOException $e) {
    echo "Error while retrieving courses: " . $e->getMessage();
}

?>   