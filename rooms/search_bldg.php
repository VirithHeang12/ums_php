<?php

require_once __DIR__ . '/../database/database_connection.php';


try {
  $statement = $pdo->prepare("SELECT * FROM buildings");
  $statement->execute();
  $buidling = $statement->fetchAll();
} catch (PDOException $e) {
  echo "Error while retrieving professors: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

</body>

</html>