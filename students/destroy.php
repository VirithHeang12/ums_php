<?php

require_once __DIR__ . '/../database/database_connection.php';

$student_number = $_GET['id'];

try {
    $statement = $pdo->prepare("DELETE FROM students WHERE STU_NUM = :student_number");
    $statement->bindParam(':student_number', $student_number);
    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error while deleting student: " . $e->getMessage();
}
