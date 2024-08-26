<?php

require_once __DIR__ . '/../database_connection.php';

$bldg_code = $_POST['bldg_code'];
$bldg_name = $_POST['bldg_name'];
$bldg_location = $_POST['bldg_location'];

try {
  $statement = $pdo->prepare("UPDATE buildings SET BLDG_NAME = :bldg_name, BLDG_LOCATION = :bldg_location");

  $statement->bindParam(':bldg_name', $bldg_name);
  $statement->bindParam(':bldg_location', $bldg_location);

  $statement->execute();

  header('Location: index.php');
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
