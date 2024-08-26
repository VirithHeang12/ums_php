<?php

require_once __DIR__ . '/../config/database_connection.php';

$dept_code = $_POST['dept_code'] ?? '';
$stu_fname = $_POST['stu_fname'] ?? '';
$stu_lname = $_POST['stu_lname'] ?? '';
$stu_initial = $_POST['stu_initial'] ?? '';
$stu_email = $_POST['stu_email'] ?? '';
$prof_num = $_POST['prof_num'] ?? '';

try {
    $pdo->beginTransaction();

    $statement = $pdo->prepare("INSERT INTO students (dept_code, stu_fname, stu_lname, stu_initial, stu_email, prof_num) VALUES (:dept_code, :stu_fname, :stu_lname, :stu_initial, :stu_email, :prof_num)");

    $statement->bindParam(':dept_code', $dept_code, PDO::PARAM_INT);
    $statement->bindParam(':stu_fname', $stu_fname, PDO::PARAM_STR);
    $statement->bindParam(':stu_lname', $stu_lname, PDO::PARAM_STR);
    $statement->bindParam(':stu_initial', $stu_initial, PDO::PARAM_STR);
    $statement->bindParam(':stu_email', $stu_email, PDO::PARAM_STR);
    $statement->bindParam(':prof_num', $prof_num, PDO::PARAM_INT);

    $statement->execute();

    $pdo->commit();

    header('Location: index.php');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
