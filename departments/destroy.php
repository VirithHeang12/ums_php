<?php 
require_once __DIR__ . '/../database/database_connection.php';
require_once __DIR__ . '/../authentication/student_authorization_check.php';

$dept_code = $_GET['id'] ?? '';

try {
    $statement = $pdo->prepare("DELETE FROM departments WHERE dept_code = :dept_code");

    $statement->bindParam(':dept_code', $dept_code, PDO::PARAM_INT);

    $statement->execute();

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
