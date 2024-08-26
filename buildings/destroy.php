<?php

require_once __DIR__ . '/../database_connection.php';

$bldg_code = $_GET['id'];

try {
  $statement = $pdo->prepare("DELETE FROM buildings WHERE BLDG_CODE = :bldg_code");
  $statement->bindParam(':bldg_code', $bldg_code);
  $statement->execute();

  header('Location: index.php');
} catch (PDOException $e) {
  echo "Error while deleting buidling: " . $e->getMessage();
}
