<?php 

require_once __DIR__ . '/../config/database_connection.php';

$crs_code = $_POST['crs_code'] ?? '';
$dept_code = $_POST['dept_code'] ?? '';
$crs_title = $_POST['crs_title'] ?? '';    
$crs_description= $_POST['crs_description'] ?? '';
$crs_credit = $_POST['crs_credit'] ?? '';


try {
    $statement = $pdo->prepare("UPDATE courses SET dept_code = :dept_code, crs_title = :crs_title, crs_description = :crs_description, crs_credit = :crs_credit WHERE crs_code = :crs_code");

    $statement->bindParam(':crs_code', $crs_code, PDO::PARAM_INT); 
    $statement->bindParam(':dept_code', $dept_code, PDO::PARAM_STR);
    $statement->bindParam(':crs_title', $crs_title, PDO::PARAM_STR);
    $statement->bindParam(':crs_description', $crs_description, PDO::PARAM_STR);
    $statement->bindParam(':crs_credit', $crs_credit, PDO::PARAM_STR);
    

    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
