<?php

require_once __DIR__ . '/../config/database_connection.php';

$type = $_POST['type'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$prefix = $_POST['prefix'] ?? '';

// search

try {
    $statement = $pdo->prepare("SELECT * FROM employees_copy WHERE first_name = :first_name AND last_name = :last_name");

    $statement->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $statement->bindParam(':last_name', $last_name, PDO::PARAM_STR);

    $statement->execute();

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        echo json_encode($results);
    } else {
        echo json_encode([]);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}