<?php

require_once __DIR__ . '/../database/database_connection.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$entity_type = $_POST['entity_type'] ?? '';
$entity_id = $_POST['entity_id'] ?? '';
$role_id = $_POST['role_id'] ?? '';

try {
    $pdo->beginTransaction();

    $statement = $pdo->prepare("INSERT INTO users (username, password, entity_type, entity_id, role_id) VALUES (:username, :password, :entity_type, :entity_id, :role_id)");

    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':entity_type', $entity_type, PDO::PARAM_STR);
    $statement->bindParam(':entity_id', $entity_id, PDO::PARAM_INT);
    $statement->bindParam(':role_id', $role_id, PDO::PARAM_INT);

    $statement->execute();

    $pdo->commit();

    header('Location: /ums_php/index.php');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}


