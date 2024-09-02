<?php

require_once __DIR__ . '/../database/database_connection.php';

$room_type = $_POST['room_type'] ?? '';
$bldg_code = $_POST['bldg_code'] ?? '';

try {
  $pdo->beginTransaction();

  $statement = $pdo->prepare("INSERT INTO rooms (room_type, bldg_code) VALUES (:room_type, :bldg_code)");

  $statement->bindParam(':room_type', $room_type, PDO::PARAM_STR);
  $statement->bindParam(':bldg_code', $bldg_code, PDO::PARAM_INT);

  $statement->execute();

  $pdo->commit();

  header('Location: index.php');
} catch (PDOException $e) {
  $pdo->rollBack();
  echo "Error: " . $e->getMessage();
}
