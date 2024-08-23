<?php 

require_once __DIR__ . '/../database_connection.php';

$dept_code = $_POST['dept_code'] ?? '';
$crs_title = $_POST['crs_title'] ?? '';
$crs_description = $_POST['crs_description'] ?? '';
$crs_credit = $_POST['crs_credit'] ?? '';


try {
    $pdo->beginTransaction();

    $statement = $pdo->prepare("INSERT INTO courses (dept_code, crs_title, crs_description, crs_credit) VALUES (:dept_code, :crs_title, :crs_description, :crs_credit)");

    $statement->bindParam(':dept_code', $dept_code, PDO::PARAM_INT);
    $statement->bindParam(':crs_title', $crs_title, PDO::PARAM_STR);
    $statement->bindParam(':crs_description', $crs_description, PDO::PARAM_STR);
    $statement->bindParam(':crs_credit', $crs_credit, PDO::PARAM_STR);
    
    $statement->execute();

    $pdo->commit();

    header('Location: index.php');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}