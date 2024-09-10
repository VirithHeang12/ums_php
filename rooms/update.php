<?php

require_once __DIR__ . '/../database/database_connection.php';

var_dump($_POST);
$room_code = $_POST['room_code'];
$room_type = $_POST['room_type'];
$bldg_code = $_POST['bldg_code'];

try {

  $statement = $pdo->prepare("UPDATE rooms SET ROOM_TYPE = :room_type, BLDG_CODE = :bldg_code WHERE ROOM_CODE = :room_code");
  $statement->bindParam(':room_code', $room_code);
  $statement->bindParam(':room_type', $room_type);
  $statement->bindParam(':bldg_code', $bldg_code);
  $statement->execute();

  header('Location: index.php');
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
