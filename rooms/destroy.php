<?php

require_once __DIR__ . '/../database/database_connection.php';

$room_code = $_GET['id'];

try {
  $statement = $pdo->prepare("DELETE FROM rooms WHERE ROOM_CODE = :room_code");
  $statement->bindParam(':room_code', $room_code);
  $statement->execute();

  header('Location: index.php');
} catch (PDOException $e) {
  echo "Error while deleting student: " . $e->getMessage();
}
