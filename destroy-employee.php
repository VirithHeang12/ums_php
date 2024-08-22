<?php 
require_once 'database_connection.php';

$employeeId = $_GET['id'] ?? '';

try {
    $statement = $pdo->prepare("DELETE FROM employees_copy WHERE employee_id = :employee_id");

    $statement->bindParam(':employee_id', $employeeId, PDO::PARAM_INT);

    $statement->execute();

    header('Location: list-all-employees.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>