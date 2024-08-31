<?php 

require_once __DIR__ . '/../database/database_connection.php';

$dept_name = $_POST['dept_name'] ?? '';
$school_code = $_POST['school_code'] ??'';
$prof_num = $_POST['prof_num'] ?? '';
try {
    $pdo->beginTransaction();

    $statement = $pdo->prepare("INSERT INTO departments (dept_name, school_code , prof_num) VALUES (:dept_name, :school_code,:prof_num)");

    $statement->bindParam(':dept_name', $dept_name, PDO::PARAM_STR);
    $statement->bindParam(':school_code', $school_code, PDO::PARAM_INT);
    $statement->bindParam(':prof_num', $prof_num, PDO::PARAM_INT);

    $statement->execute();

    $pdo->commit();

    header('Location: index.php');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}