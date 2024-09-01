<?php

require_once __DIR__ . '/../database/database_connection.php';

$semester_year = $_POST['semester_year'] ?? '';
$semester_term = $_POST['semester_term'] ?? '';
$semester_start_date = $_POST['semester_start_date'] ?? '';
$semester_end_date = $_POST['semester_end_date'] ?? '';

try {
    $pdo->beginTransaction();
    $statement = $pdo->prepare("INSERT INTO semesters (semester_year, semester_term, semester_start_date, semester_end_date) 
    VALUES (:semester_year, :semester_term, (TO_DATE(:semester_start_date, 'YYYY-MM-DD')), (TO_DATE(:semester_end_date, 'YYYY-MM-DD')))");

    $statement->bindParam(':semester_year', $semester_year, PDO::PARAM_INT);
    $statement->bindParam(':semester_term', $semester_term, PDO::PARAM_INT);
    $statement->bindParam(':semester_start_date', $semester_start_date, PDO::PARAM_STR);
    $statement->bindParam(':semester_end_date', $semester_end_date, PDO::PARAM_STR);

    $statement->execute();
    $pdo->commit();
    header('Location: index.php?');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}

?>