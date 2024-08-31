<?php

require_once __DIR__ . '/../database/database_connection.php';

var_dump($_POST);
$dept_code = $_POST['dept_code'];
$dept_name = $_POST['dept_name'] ?? '';
$school_code = $_POST['school_code'] ?? '';
$prof_num = $_POST['prof_num'] ?? '';
try {
    $statement = $pdo->prepare("UPDATE departments SET DEPT_NAME = :dept_name, SCHOOL_CODE = :school_code , PROF_NUM = :prof_num WHERE DEPT_CODE = :dept_code");

    $statement->bindParam(':dept_code', $dept_code, PDO::PARAM_INT);
    $statement->bindParam(':dept_name', $dept_name, PDO::PARAM_STR);
    $statement->bindParam(':school_code', $school_code, PDO::PARAM_INT);
    $statement->bindParam(':prof_num', $prof_num, PDO::PARAM_INT);
    

    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
