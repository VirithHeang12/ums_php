<?php 
require_once __DIR__ . '/../database/database_connection.php';
$semester_code = $_GET['id'];

try{
    $statement = $pdo->prepare("DELETE FROM semesters WHERE semester_code = :semester_code");
    $statement->bindParam(':semester_code', $semester_code);
    $statement->execute();
    header('Location: index.php');
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}