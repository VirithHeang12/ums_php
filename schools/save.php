<?php 

require_once __DIR__ . '/../config/database_connection.php';

$school_name = $_POST['school_name'] ?? '';
$prof_num = $_POST['prof_num'] ?? '';

try {
    $pdo->beginTransaction();

    $statement = $pdo->prepare("INSERT INTO schools (school_name, prof_num) VALUES (:school_name, :prof_num)");

    $statement->bindParam(':school_name', $school_name, PDO::PARAM_STR);
    $statement->bindParam(':prof_num', $prof_num, PDO::PARAM_INT);

    $statement->execute();

    $pdo->commit();

    header('Location: index.php');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}