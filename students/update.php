<?php

require_once __DIR__ . '/../config/database_connection.php';

var_dump($_POST);
$stu_num = $_POST['stu_num'];
$dept_code = $_POST['dept_code'];
$stu_fname = $_POST['stu_fname'];
$stu_lname = $_POST['stu_lname'];
$stu_initial = $_POST['stu_initial'];
$stu_email = $_POST['stu_email'];

try {
    $statement = $pdo->prepare("UPDATE students SET DEPT_CODE = :dept_code, STU_FNAME = :stu_fname, STU_LNAME = :stu_lname, STU_INITIAL = :stu_initial, STU_EMAIL = :stu_email WHERE STU_NUM = :stu_num");

    $statement->bindParam(':dept_code', $dept_code);
    $statement->bindParam(':stu_fname', $stu_fname);
    $statement->bindParam(':stu_lname', $stu_lname);
    $statement->bindParam(':stu_initial', $stu_initial);
    $statement->bindParam(':stu_email', $stu_email);
    $statement->bindParam(':stu_num', $stu_num);

    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
