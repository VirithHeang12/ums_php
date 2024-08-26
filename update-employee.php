<?php

require_once 'database_connection.php';

$employeeId = $_POST['employee_id'] ?? '';
$firstName = $_POST['first_name'] ?? '';
$lastName = $_POST['last_name'] ?? '';
$email = $_POST['email'] ?? '';
$jobId = $_POST['job_id'] ?? '';

try {
    $statement = $pdo->prepare("UPDATE employees SET first_name = :first_name, last_name = :last_name, email = :email WHERE employee_id = :employee_id");

    $statement->bindParam(':employee_id', $employeeId, PDO::PARAM_INT);
    $statement->bindParam(':first_name', $firstName, PDO::PARAM_STR);
    $statement->bindParam(':last_name', $lastName, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    // $statement->bindParam(':job_id', $jobId, PDO::PARAM_STR);

    $statement->execute();

    header('Location: list-all-employees.php');
} catch (PDOException $e) {
    // echo "Error: " . $e->getMessage();
}
