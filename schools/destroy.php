<?php 
require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../models/School.php';

$school_code = $_GET['id'];

$schools = new School($pdo);
$schools = $schools->read();

try{
    $statement = $pdo->prepare("DELETE FROM schools WHERE school_code = :school_code");
    $statement->bindParam(':school_code', $school_code);
    $statement->execute();
    header('Location: index.php');
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

?>